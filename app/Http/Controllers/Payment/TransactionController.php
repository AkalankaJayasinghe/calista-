<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\Payment\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    /**
     * Display a listing of transactions.
     */
    public function index()
    {
        $user = Auth::user();
        
        if ($user->role === 'customer') {
            $transactions = Transaction::whereHas('payment', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
                ->with('payment')
                ->latest()
                ->paginate(20);
        } else {
            $transactions = Transaction::with('payment.user')
                ->latest()
                ->paginate(20);
        }

        return response()->json($transactions);
    }

    /**
     * Display the specified transaction.
     */
    public function show($id)
    {
        $transaction = Transaction::with('payment.order')->findOrFail($id);

        // Authorization check
        if (Auth::user()->role === 'customer' && $transaction->payment->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        return response()->json($transaction);
    }

    /**
     * Get transactions by payment.
     */
    public function getByPayment($paymentId)
    {
        $payment = \App\Models\Payment\Payment::findOrFail($paymentId);

        // Authorization check
        if (Auth::user()->role === 'customer' && $payment->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $transactions = Transaction::where('payment_id', $paymentId)
            ->latest()
            ->get();

        return response()->json($transactions);
    }

    /**
     * Create a new transaction record.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'payment_id' => 'required|exists:payments,id',
            'transaction_type' => 'required|in:payment,refund,chargeback,reversal',
            'amount' => 'required|numeric|min:0',
            'gateway' => 'nullable|string|max:100',
            'gateway_transaction_id' => 'nullable|string|max:255',
            'status' => 'required|in:pending,processing,completed,failed,cancelled',
            'response_code' => 'nullable|string|max:50',
            'response_message' => 'nullable|string',
            'metadata' => 'nullable|json',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $transaction = Transaction::create([
            'payment_id' => $request->payment_id,
            'transaction_number' => 'TXN-' . strtoupper(uniqid()),
            'transaction_type' => $request->transaction_type,
            'amount' => $request->amount,
            'gateway' => $request->gateway,
            'gateway_transaction_id' => $request->gateway_transaction_id,
            'status' => $request->status,
            'response_code' => $request->response_code,
            'response_message' => $request->response_message,
            'metadata' => $request->metadata,
            'processed_at' => $request->status === 'completed' ? now() : null,
        ]);

        return response()->json([
            'message' => 'Transaction created successfully',
            'data' => $transaction
        ], 201);
    }

    /**
     * Update transaction status.
     */
    public function updateStatus(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'status' => 'required|in:pending,processing,completed,failed,cancelled',
            'response_code' => 'nullable|string|max:50',
            'response_message' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $updateData = [
            'status' => $request->status,
            'response_code' => $request->response_code,
            'response_message' => $request->response_message,
        ];

        if ($request->status === 'completed' && !$transaction->processed_at) {
            $updateData['processed_at'] = now();
        }

        $transaction->update($updateData);

        return response()->json([
            'message' => 'Transaction status updated successfully',
            'data' => $transaction
        ]);
    }

    /**
     * Get transaction statistics.
     */
    public function statistics()
    {
        $query = Transaction::query();

        if (Auth::user()->role === 'customer') {
            $query->whereHas('payment', function ($q) {
                $q->where('user_id', Auth::id());
            });
        }

        $stats = [
            'total_transactions' => $query->count(),
            'completed_transactions' => (clone $query)->where('status', 'completed')->count(),
            'failed_transactions' => (clone $query)->where('status', 'failed')->count(),
            'pending_transactions' => (clone $query)->where('status', 'pending')->count(),
            'total_amount' => (clone $query)->where('status', 'completed')->where('transaction_type', 'payment')->sum('amount'),
            'total_refunded' => (clone $query)->where('status', 'completed')->where('transaction_type', 'refund')->sum('amount'),
        ];

        return response()->json($stats);
    }

    /**
     * Search transactions.
     */
    public function search(Request $request)
    {
        $query = Transaction::with('payment');

        if (Auth::user()->role === 'customer') {
            $query->whereHas('payment', function ($q) {
                $q->where('user_id', Auth::id());
            });
        }

        if ($request->has('transaction_number')) {
            $query->where('transaction_number', 'like', '%' . $request->transaction_number . '%');
        }

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        if ($request->has('transaction_type')) {
            $query->where('transaction_type', $request->transaction_type);
        }

        if ($request->has('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }

        if ($request->has('to_date')) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        $transactions = $query->latest()->paginate(20);

        return response()->json($transactions);
    }
}
