<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Marketplace\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderManagementController extends Controller
{
    /**
     * Display a listing of orders.
     */
    public function index(Request $request)
    {
        $query = Order::with(['user', 'items.product']);

        if ($request->has('status')) {
            $query->where('order_status', $request->status);
        }

        if ($request->has('payment_status')) {
            $query->where('payment_status', $request->payment_status);
        }

        if ($request->has('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('order_number', 'like', '%' . $request->search . '%')
                  ->orWhereHas('user', function ($uq) use ($request) {
                      $uq->where('name', 'like', '%' . $request->search . '%');
                  });
            });
        }

        if ($request->has('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }

        if ($request->has('to_date')) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        $orders = $query->latest()->paginate(20);

        return response()->json($orders);
    }

    /**
     * Display the specified order.
     */
    public function show($id)
    {
        $order = Order::with([
            'user',
            'items.product',
            'items.variant',
            'payments',
            'shippingAddress'
        ])->findOrFail($id);

        return response()->json($order);
    }

    /**
     * Update order status.
     */
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'order_status' => 'required|in:pending,confirmed,processing,shipped,delivered,completed,cancelled,refunded',
            'notes' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $order->update([
            'order_status' => $request->order_status,
            'status_notes' => $request->notes,
        ]);

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
        $order = Order::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'payment_status' => 'required|in:pending,processing,paid,failed,refunded',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $order->update([
            'payment_status' => $request->payment_status,
        ]);

        return response()->json([
            'message' => 'Payment status updated successfully',
            'data' => $order
        ]);
    }

    /**
     * Cancel order.
     */
    public function cancel(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'cancellation_reason' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $order->update([
            'order_status' => 'cancelled',
            'cancellation_reason' => $request->cancellation_reason,
            'cancelled_at' => now(),
        ]);

        return response()->json([
            'message' => 'Order cancelled successfully',
            'data' => $order
        ]);
    }

    /**
     * Get order statistics.
     */
    public function statistics()
    {
        $stats = [
            'total_orders' => Order::count(),
            'pending_orders' => Order::where('order_status', 'pending')->count(),
            'processing_orders' => Order::where('order_status', 'processing')->count(),
            'completed_orders' => Order::where('order_status', 'completed')->count(),
            'cancelled_orders' => Order::where('order_status', 'cancelled')->count(),
            'total_revenue' => Order::where('payment_status', 'paid')->sum('total_amount'),
            'today_orders' => Order::whereDate('created_at', today())->count(),
            'today_revenue' => Order::where('payment_status', 'paid')->whereDate('created_at', today())->sum('total_amount'),
        ];

        return response()->json($stats);
    }

    /**
     * Export orders.
     */
    public function export(Request $request)
    {
        $query = Order::with(['user', 'items.product']);

        if ($request->has('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }

        if ($request->has('to_date')) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        $orders = $query->get();

        // Return data for export (CSV/Excel generation would be handled by frontend or export library)
        return response()->json([
            'message' => 'Orders data ready for export',
            'data' => $orders,
            'count' => $orders->count()
        ]);
    }
}
