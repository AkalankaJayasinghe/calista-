<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Marketplace\Order;
use App\Models\Marketplace\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'seller']);
    }

    /**
     * Display seller's orders
     */
    public function index(Request $request)
    {
        $seller = Auth::user()->seller;

        $query = Order::whereHas('items', function($q) use ($seller) {
            $q->where('seller_id', $seller->id);
        })->with(['user', 'items' => function($q) use ($seller) {
            $q->where('seller_id', $seller->id);
        }]);

        // Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Date range filter
        if ($request->has('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->has('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $orders = $query->latest()->paginate(20);

        return view('seller.orders.index', compact('orders'));
    }

    /**
     * Display order details
     */
    public function show($id)
    {
        $seller = Auth::user()->seller;

        $order = Order::whereHas('items', function($q) use ($seller) {
                $q->where('seller_id', $seller->id);
            })
            ->with(['user', 'items' => function($q) use ($seller) {
                $q->where('seller_id', $seller->id)->with('product');
            }, 'shippingAddress', 'billingAddress'])
            ->findOrFail($id);

        return view('seller.orders.show', compact('order'));
    }

    /**
     * Update order status
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:processing,shipped,delivered',
        ]);

        $seller = Auth::user()->seller;

        $order = Order::whereHas('items', function($q) use ($seller) {
            $q->where('seller_id', $seller->id);
        })->findOrFail($id);

        if ($request->status === 'shipped') {
            $order->markAsShipped();
        } elseif ($request->status === 'delivered') {
            $order->markAsDelivered();
        } else {
            $order->update(['status' => $request->status]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Order status updated successfully!'
        ]);
    }
}
