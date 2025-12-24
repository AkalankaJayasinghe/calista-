<?php

namespace App\Http\Controllers\Marketplace;

use App\Http\Controllers\Controller;
use App\Models\Marketplace\Cart;
use App\Models\Marketplace\Order;
use App\Models\Marketplace\OrderItem;
use App\Models\Common\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display checkout page
     */
    public function index()
    {
        $cart = Cart::where('user_id', Auth::id())
            ->with(['items.product.images'])
            ->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Your cart is empty!');
        }

        $addresses = Address::where('user_id', Auth::id())->get();

        return view('marketplace.checkout.index', compact('cart', 'addresses'));
    }

    /**
     * Process checkout
     */
    public function process(Request $request)
    {
        $request->validate([
            'shipping_address_id' => 'required|exists:addresses,id',
            'billing_address_id' => 'required|exists:addresses,id',
            'payment_method' => 'required|in:card,bank_transfer,cash_on_delivery',
        ]);

        $cart = Cart::where('user_id', Auth::id())
            ->with(['items.product'])
            ->first();

        if (!$cart || $cart->items->isEmpty()) {
            return back()->with('error', 'Your cart is empty!');
        }

        // Verify stock availability
        foreach ($cart->items as $item) {
            if ($item->product->stock_quantity < $item->quantity) {
                return back()->with('error', "Insufficient stock for {$item->product->name}");
            }
        }

        DB::beginTransaction();
        try {
            // Create order
            $order = Order::create([
                'user_id' => Auth::id(),
                'status' => 'pending',
                'payment_status' => 'pending',
                'payment_method' => $request->payment_method,
                'subtotal' => $cart->subtotal,
                'tax' => $cart->tax,
                'shipping_cost' => 0, // Calculate based on location
                'discount' => 0,
                'total' => $cart->total,
                'currency' => 'LKR',
                'shipping_address_id' => $request->shipping_address_id,
                'billing_address_id' => $request->billing_address_id,
                'notes' => $request->notes,
            ]);

            // Create order items
            foreach ($cart->items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'seller_id' => $item->product->seller_id,
                    'product_name' => $item->product->name,
                    'product_sku' => $item->product->sku,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'subtotal' => $item->subtotal,
                ]);

                // Update product stock
                $item->product->decrement('stock_quantity', $item->quantity);
            }

            // Clear cart
            $cart->clear();

            DB::commit();

            // Send order confirmation email
            // Mail::to(Auth::user()->email)->send(new OrderConfirmation($order));

            return redirect()->route('checkout.success', $order->id)
                ->with('success', 'Order placed successfully!');

        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Failed to process order. Please try again.');
        }
    }

    /**
     * Order success page
     */
    public function success($orderId)
    {
        $order = Order::with(['items.product', 'shippingAddress'])
            ->where('user_id', Auth::id())
            ->findOrFail($orderId);

        return view('marketplace.checkout.success', compact('order'));
    }
}
