<?php

namespace App\Http\Controllers\CustomFurniture;

use App\Http\Controllers\Controller;
use App\Models\CustomFurniture\CustomOrder;
use App\Models\CustomFurniture\CustomQuotation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CustomOrderController extends Controller
{
    /**
     * Display a listing of custom orders.
     */
    public function index()
    {
        $user = Auth::user();
        
        if ($user->role === 'customer') {
            $orders = CustomOrder::where('customer_id', $user->id)
                ->with(['quotation.customRequest', 'quotation.workshop'])
                ->latest()
                ->paginate(10);
        } elseif ($user->role === 'workshop') {
            $orders = CustomOrder::whereHas('quotation', function ($query) use ($user) {
                $query->where('workshop_id', $user->id);
            })
                ->with(['quotation.customRequest', 'customer'])
                ->latest()
                ->paginate(10);
        } else {
            $orders = CustomOrder::with(['quotation.customRequest', 'customer', 'quotation.workshop'])
                ->latest()
                ->paginate(10);
        }

        return response()->json($orders);
    }

    /**
     * Create an order from an accepted quotation.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'quotation_id' => 'required|exists:custom_quotations,id',
            'delivery_address' => 'required|string',
            'delivery_notes' => 'nullable|string',
            'payment_method' => 'required|in:cash,card,bank_transfer,installment',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $quotation = CustomQuotation::with('customRequest')->findOrFail($request->quotation_id);

        // Verify the quotation is accepted
        if ($quotation->status !== 'accepted') {
            return response()->json(['error' => 'Quotation must be accepted before creating order'], 400);
        }

        // Verify the user is the customer who made the request
        if ($quotation->customRequest->customer_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Check if order already exists for this quotation
        $existingOrder = CustomOrder::where('quotation_id', $request->quotation_id)->first();
        if ($existingOrder) {
            return response()->json(['error' => 'Order already exists for this quotation'], 400);
        }

        $order = CustomOrder::create([
            'quotation_id' => $request->quotation_id,
            'customer_id' => Auth::id(),
            'order_number' => 'CFO-' . strtoupper(uniqid()),
            'total_amount' => $quotation->estimated_price,
            'delivery_address' => $request->delivery_address,
            'delivery_notes' => $request->delivery_notes,
            'payment_method' => $request->payment_method,
            'status' => 'pending',
            'payment_status' => 'pending',
        ]);

        // Update custom request status
        $quotation->customRequest->update(['status' => 'in_progress']);

        return response()->json([
            'message' => 'Order created successfully',
            'data' => $order->load(['quotation.customRequest', 'quotation.workshop'])
        ], 201);
    }

    /**
     * Display the specified order.
     */
    public function show($id)
    {
        $order = CustomOrder::with(['quotation.customRequest', 'quotation.workshop', 'customer'])
            ->findOrFail($id);

        // Authorization check
        $user = Auth::user();
        if ($user->role === 'customer' && $order->customer_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        if ($user->role === 'workshop' && $order->quotation->workshop_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        return response()->json($order);
    }

    /**
     * Update order status (by workshop).
     */
    public function updateStatus(Request $request, $id)
    {
        $order = CustomOrder::with('quotation')->findOrFail($id);

        // Authorization check
        if (Auth::user()->role === 'workshop' && $order->quotation->workshop_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $validator = Validator::make($request->all(), [
            'status' => 'required|in:pending,confirmed,in_production,quality_check,ready_for_delivery,in_transit,delivered,completed,cancelled',
            'progress_notes' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $order->update([
            'status' => $request->status,
            'progress_notes' => $request->progress_notes,
        ]);

        // Update expected delivery if status is confirmed
        if ($request->status === 'confirmed' && !$order->expected_delivery_date) {
            $order->update([
                'expected_delivery_date' => now()->addDays($order->quotation->estimated_days)
            ]);
        }

        // Update custom request status if order is completed
        if ($request->status === 'completed') {
            $order->quotation->customRequest->update(['status' => 'completed']);
        }

        return response()->json([
            'message' => 'Order status updated successfully',
            'data' => $order
        ]);
    }

    /**
     * Update payment status.
     */
    public function updatePaymentStatus(Request $request, $id)
    {
        $order = CustomOrder::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'payment_status' => 'required|in:pending,partial,paid,refunded',
            'paid_amount' => 'nullable|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $order->update([
            'payment_status' => $request->payment_status,
            'paid_amount' => $request->paid_amount ?? $order->paid_amount,
        ]);

        return response()->json([
            'message' => 'Payment status updated successfully',
            'data' => $order
        ]);
    }

    /**
     * Cancel an order.
     */
    public function cancel(Request $request, $id)
    {
        $order = CustomOrder::with('quotation')->findOrFail($id);

        // Authorization check
        $user = Auth::user();
        if ($user->role === 'customer' && $order->customer_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Can't cancel if already in production or delivered
        if (in_array($order->status, ['in_production', 'delivered', 'completed', 'cancelled'])) {
            return response()->json(['error' => 'Cannot cancel order in current status'], 400);
        }

        $validator = Validator::make($request->all(), [
            'cancellation_reason' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $order->update([
            'status' => 'cancelled',
            'cancellation_reason' => $request->cancellation_reason,
            'cancelled_at' => now(),
        ]);

        return response()->json([
            'message' => 'Order cancelled successfully',
            'data' => $order
        ]);
    }

    /**
     * Complete an order (mark as delivered and received).
     */
    public function complete($id)
    {
        $order = CustomOrder::with('quotation')->findOrFail($id);

        // Authorization check - customer confirms delivery
        if ($order->customer_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        if ($order->status !== 'delivered') {
            return response()->json(['error' => 'Order must be delivered before completion'], 400);
        }

        $order->update([
            'status' => 'completed',
            'delivery_date' => now(),
        ]);

        // Update custom request status
        $order->quotation->customRequest->update(['status' => 'completed']);

        return response()->json([
            'message' => 'Order completed successfully',
            'data' => $order
        ]);
    }
}
