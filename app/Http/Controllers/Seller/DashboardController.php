<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Seller\Seller;
use App\Models\Marketplace\Order;
use App\Models\Marketplace\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'seller']);
    }

    /**
     * Display seller dashboard
     */
    public function index()
    {
        $seller = Auth::user()->seller;

        // Statistics
        $stats = [
            'total_products' => $seller->products()->count(),
            'active_products' => $seller->products()->active()->count(),
            'total_orders' => $seller->orders()->count(),
            'pending_orders' => $seller->orders()->where('status', 'pending')->count(),
            'total_sales' => $seller->total_sales ?? 0,
            'rating' => $seller->rating ?? 0,
        ];

        // Recent orders
        $recentOrders = Order::whereHas('items', function($query) use ($seller) {
                $query->where('seller_id', $seller->id);
            })
            ->with(['user', 'items'])
            ->latest()
            ->limit(10)
            ->get();

        // Low stock products
        $lowStockProducts = $seller->inventory()
            ->with('product')
            ->lowStock()
            ->limit(5)
            ->get();

        return view('seller.dashboard', compact('seller', 'stats', 'recentOrders', 'lowStockProducts'));
    }
}
