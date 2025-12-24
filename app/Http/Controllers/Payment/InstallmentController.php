<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\Payment\Installment;
use App\Models\Payment\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class InstallmentController extends Controller
{
    /**
     * Display a listing of installments.
     */
    public function index()
    {
        $user = Auth::user();
        
        if ($user->role === 'customer') {
            $installments = Installment::whereHas('payment', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
                ->with('payment.order')
                ->latest()
                ->paginate(15);
        } else {
            $installments = Installment::with(['payment.user', 'payment.order'])
                ->latest()
                ->paginate(15);
        }

        return response()->json($installments);
    }

    /**
     * Create installment plan for a payment.
     */
    public function createPlan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'payment_id' => 'required|exists:payments,id',
            'number_of_installments' => 'required|integer|min:2|max:12',
            'frequency' => 'required|in:weekly,bi-weekly,monthly',
            'first_payment_date' => 'required|date|after:today',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $payment = Payment::with('order')->findOrFail($request->payment_id);

        // Verify payment belongs to user
        if ($payment->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Check if installments already exist
        if ($payment->installments()->count() > 0) {
            return response()->json(['error' => 'Installment plan already exists for this payment'], 400);
        }

        $totalAmount = $payment->amount;
        $installmentAmount = $totalAmount / $request->number_of_installments;
        $installments = [];

        $dueDate = new \DateTime($request->first_payment_date);

        for ($i = 1; $i <= $request->number_of_installments; $i++) {
            $installments[] = Installment::create([
                'payment_id' => $payment->id,
                'installment_number' => $i,
                'due_amount' => round($installmentAmount, 2),
                'due_date' => $dueDate->format('Y-m-d'),
                'status' => 'pending',
            ]);

            // Calculate next due date
            switch ($request->frequency) {
                case 'weekly':
                    $dueDate->modify('+1 week');
                    break;
                case 'bi-weekly':
                    $dueDate->modify('+2 weeks');
                    break;
                case 'monthly':
                    $dueDate->modify('+1 month');
                    break;
            }
        }

        return response()->json([
            'message' => 'Installment plan created successfully',
            'data' => $installments
        ], 201);
    }

    /**
     * Display installments for a specific payment.
     */
    public function getByPayment($paymentId)
    {
        $payment = Payment::findOrFail($paymentId);

        // Authorization check
        if (Auth::user()->role === 'customer' && $payment->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $installments = Installment::where('payment_id', $paymentId)
            ->orderBy('installment_number')
            ->get();

        return response()->json($installments);
    }

    /**
     * Display the specified installment.
     */
    public function show($id)
    {
        $installment = Installment::with('payment.order')->findOrFail($id);

        // Authorization check
        if (Auth::user()->role === 'customer' && $installment->payment->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        return response()->json($installment);
    }

    /**
     * Pay an installment.
     */
    public function pay(Request $request, $id)
    {
        $installment = Installment::with('payment')->findOrFail($id);

        // Authorization check
        if ($installment->payment->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        if ($installment->status !== 'pending') {
            return response()->json(['error' => 'Installment already processed'], 400);
        }

        $validator = Validator::make($request->all(), [
            'payment_details' => 'nullable|json',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $installment->update([
            'status' => 'paid',
            'paid_amount' => $installment->due_amount,
            'paid_date' => now(),
            'payment_details' => $request->payment_details,
        ]);

        // Check if all installments are paid
        $allPaid = !Installment::where('payment_id', $installment->payment_id)
            ->where('status', '!=', 'paid')
            ->exists();

        if ($allPaid) {
            $installment->payment->update(['status' => 'completed']);
        }

        return response()->json([
            'message' => 'Installment paid successfully',
            'data' => $installment
        ]);
    }

    /**
     * Mark installment as overdue (automated process).
     */
    public function markOverdue($id)
    {
        $installment = Installment::findOrFail($id);

        if ($installment->status === 'pending' && $installment->due_date < now()) {
            $installment->update(['status' => 'overdue']);
        }

        return response()->json([
            'message' => 'Installment status updated',
            'data' => $installment
        ]);
    }

    /**
     * Get overdue installments.
     */
    public function overdue()
    {
        $user = Auth::user();
        
        $query = Installment::where('status', 'pending')
            ->where('due_date', '<', now());

        if ($user->role === 'customer') {
            $query->whereHas('payment', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            });
        }

        $installments = $query->with('payment.order')->get();

        return response()->json($installments);
    }

    /**
     * Get upcoming installments.
     */
    public function upcoming()
    {
        $user = Auth::user();
        
        $query = Installment::where('status', 'pending')
            ->where('due_date', '>=', now())
            ->where('due_date', '<=', now()->addDays(30));

        if ($user->role === 'customer') {
            $query->whereHas('payment', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            });
        }

        $installments = $query->with('payment.order')
            ->orderBy('due_date')
            ->get();

        return response()->json($installments);
    }

    /**
     * Get installment statistics.
     */
    public function statistics()
    {
        $userId = Auth::id();

        $stats = [
            'total_installments' => Installment::whereHas('payment', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })->count(),
            'paid_installments' => Installment::whereHas('payment', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })->where('status', 'paid')->count(),
            'pending_installments' => Installment::whereHas('payment', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })->where('status', 'pending')->count(),
            'overdue_installments' => Installment::whereHas('payment', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })->where('status', 'overdue')->count(),
            'total_due' => Installment::whereHas('payment', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })->where('status', 'pending')->sum('due_amount'),
        ];

        return response()->json($stats);
    }
}
