<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\Payment\Payment;
use App\Models\Marketplace\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    /**
     * Display a listing of payments.
     */
    public function index()
    {
        $user = Auth::user();
        
        if ($user->role === 'customer') {
            $payments = Payment::where('user_id', $user->id)
                ->with(['order', 'paymentMethod'])
                ->latest()
                ->paginate(15);
        } else {
            $payments = Payment::with(['user', 'order', 'paymentMethod'])
                ->latest()
                ->paginate(15);
        }

        return response()->json($payments);
    }

    /**
     * Create a new payment.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => 'required|exists:orders,id',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'amount' => 'required|numeric|min:0',
            'currency' => 'required|string|size:3',
            'payment_type' => 'required|in:full,partial,installment,refund',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $order = Order::findOrFail($request->order_id);

        // Verify order belongs to user
        if ($order->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $payment = Payment::create([
            'user_id' => Auth::id(),
            'order_id' => $request->order_id,
            'payment_method_id' => $request->payment_method_id,
            'transaction_number' => 'PAY-' . strtoupper(uniqid()),
            'amount' => $request->amount,
            'currency' => $request->currency,
            'payment_type' => $request->payment_type,
            'status' => 'pending',
        ]);

        return response()->json([
            'message' => 'Payment initiated successfully',
            'data' => $payment->load(['order', 'paymentMethod'])
        ], 201);
    }

    /**
     * Display the specified payment.
     */
    public function show($id)
    {
        $payment = Payment::with(['user', 'order', 'paymentMethod', 'transaction'])
            ->findOrFail($id);

        // Authorization check
        if (Auth::user()->role === 'customer' && $payment->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        return response()->json($payment);
    }

    /**
     * Process payment (simulated).
     */
    public function process(Request $request, $id)
    {
        $payment = Payment::with('order')->findOrFail($id);

        // Authorization check
        if ($payment->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        if ($payment->status !== 'pending') {
            return response()->json(['error' => 'Payment already processed'], 400);
        }

        $validator = Validator::make($request->all(), [
            'payment_details' => 'nullable|json',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Simulate payment processing
        $payment->update([
            'status' => 'completed',
            'payment_details' => $request->payment_details,
            'processed_at' => now(),
        ]);

        // Update order payment status
        $order = $payment->order;
        $totalPaid = $order->payments()->where('status', 'completed')->sum('amount');
        
        if ($totalPaid >= $order->total_amount) {
            $order->update(['payment_status' => 'paid']);
        } elseif ($totalPaid > 0) {
            $order->update(['payment_status' => 'partial']);
        }

        return response()->json([
            'message' => 'Payment processed successfully',
            'data' => $payment
        ]);
    }

    /**
     * Cancel a payment.
     */
    public function cancel(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);

        // Authorization check
        if ($payment->user_id !== Auth::id() && Auth::user()->role !== 'admin') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        if ($payment->status !== 'pending') {
            return response()->json(['error' => 'Only pending payments can be cancelled'], 400);
        }

        $validator = Validator::make($request->all(), [
            'cancellation_reason' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $payment->update([
            'status' => 'cancelled',
            'cancellation_reason' => $request->cancellation_reason,
            'cancelled_at' => now(),
        ]);

        return response()->json([
            'message' => 'Payment cancelled successfully',
            'data' => $payment
        ]);
    }

    /**
     * Process refund.
     */
    public function refund(Request $request, $id)
    {
        $payment = Payment::with('order')->findOrFail($id);

        if ($payment->status !== 'completed') {
            return response()->json(['error' => 'Only completed payments can be refunded'], 400);
        }

        $validator = Validator::make($request->all(), [
            'refund_amount' => 'required|numeric|min:0|max:' . $payment->amount,
            'refund_reason' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $payment->update([
            'status' => 'refunded',
            'refund_amount' => $request->refund_amount,
            'refund_reason' => $request->refund_reason,
            'refunded_at' => now(),
        ]);

        // Update order payment status
        $order = $payment->order;
        $totalPaid = $order->payments()->where('status', 'completed')->sum('amount');
        $totalRefunded = $order->payments()->where('status', 'refunded')->sum('refund_amount');
        
        $netPaid = $totalPaid - $totalRefunded;
        
        if ($netPaid <= 0) {
            $order->update(['payment_status' => 'refunded']);
        } elseif ($netPaid < $order->total_amount) {
            $order->update(['payment_status' => 'partial']);
        }

        return response()->json([
            'message' => 'Payment refunded successfully',
            'data' => $payment
        ]);
    }

    /**
     * Get payment statistics for user.
     */
    public function statistics()
    {
        $userId = Auth::id();

        $stats = [
            'total_payments' => Payment::where('user_id', $userId)->count(),
            'completed_payments' => Payment::where('user_id', $userId)->where('status', 'completed')->count(),
            'pending_payments' => Payment::where('user_id', $userId)->where('status', 'pending')->count(),
            'total_amount_paid' => Payment::where('user_id', $userId)->where('status', 'completed')->sum('amount'),
            'total_refunded' => Payment::where('user_id', $userId)->where('status', 'refunded')->sum('refund_amount'),
        ];

        return response()->json($stats);
    }

    /**
     * Get payments by order.
     */
    public function getByOrder($orderId)
    {
        $order = Order::findOrFail($orderId);

        // Authorization check
        if (Auth::user()->role === 'customer' && $order->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $payments = Payment::where('order_id', $orderId)
            ->with('paymentMethod')
            ->latest()
            ->get();

        return response()->json($payments);
    }
}
