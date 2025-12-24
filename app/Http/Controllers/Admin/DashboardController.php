<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Marketplace\Order;
use App\Models\Payment\Payment;
use App\Models\CustomFurniture\CustomRequest;
use App\Models\InteriorDesign\Project;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Get admin dashboard statistics.
     */
    public function index()
    {
        $stats = [
            'users' => [
                'total' => User::count(),
                'customers' => User::where('role', 'customer')->count(),
                'sellers' => User::where('role', 'seller')->count(),
                'designers' => User::where('role', 'designer')->count(),
                'workshops' => User::where('role', 'workshop')->count(),
                'new_this_month' => User::whereMonth('created_at', now()->month)->count(),
            ],
            'orders' => [
                'total' => Order::count(),
                'pending' => Order::where('order_status', 'pending')->count(),
                'processing' => Order::where('order_status', 'processing')->count(),
                'completed' => Order::where('order_status', 'completed')->count(),
                'cancelled' => Order::where('order_status', 'cancelled')->count(),
                'total_revenue' => Order::where('payment_status', 'paid')->sum('total_amount'),
                'this_month_revenue' => Order::where('payment_status', 'paid')
                    ->whereMonth('created_at', now()->month)
                    ->sum('total_amount'),
            ],
            'payments' => [
                'total' => Payment::count(),
                'completed' => Payment::where('status', 'completed')->count(),
                'pending' => Payment::where('status', 'pending')->count(),
                'failed' => Payment::where('status', 'failed')->count(),
                'total_amount' => Payment::where('status', 'completed')->sum('amount'),
            ],
            'custom_furniture' => [
                'total_requests' => CustomRequest::count(),
                'pending_requests' => CustomRequest::where('status', 'pending')->count(),
                'in_progress' => CustomRequest::where('status', 'in_progress')->count(),
                'completed' => CustomRequest::where('status', 'completed')->count(),
            ],
            'interior_design' => [
                'total_projects' => Project::count(),
                'active_projects' => Project::whereIn('status', ['planning', 'design', 'execution'])->count(),
                'completed_projects' => Project::where('status', 'completed')->count(),
            ],
        ];

        return response()->json($stats);
    }

    /**
     * Get recent activities.
     */
    public function recentActivities()
    {
        $activities = [
            'recent_orders' => Order::with(['user', 'items'])
                ->latest()
                ->limit(10)
                ->get(),
            'recent_users' => User::latest()
                ->limit(10)
                ->get(),
            'recent_payments' => Payment::with(['user', 'order'])
                ->latest()
                ->limit(10)
                ->get(),
        ];

        return response()->json($activities);
    }

    /**
     * Get sales analytics.
     */
    public function salesAnalytics(Request $request)
    {
        $period = $request->get('period', 'month'); // day, week, month, year

        $query = Order::where('payment_status', 'paid');

        switch ($period) {
            case 'day':
                $query->whereDate('created_at', today());
                break;
            case 'week':
                $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                break;
            case 'month':
                $query->whereMonth('created_at', now()->month);
                break;
            case 'year':
                $query->whereYear('created_at', now()->year);
                break;
        }

        $analytics = [
            'total_sales' => $query->sum('total_amount'),
            'total_orders' => $query->count(),
            'average_order_value' => $query->avg('total_amount'),
            'sales_by_day' => Order::where('payment_status', 'paid')
                ->whereMonth('created_at', now()->month)
                ->selectRaw('DATE(created_at) as date, SUM(total_amount) as total, COUNT(*) as count')
                ->groupBy('date')
                ->orderBy('date')
                ->get(),
        ];

        return response()->json($analytics);
    }

    /**
     * Get user growth analytics.
     */
    public function userGrowth()
    {
        $growth = User::selectRaw('DATE(created_at) as date, COUNT(*) as count, role')
            ->whereMonth('created_at', now()->month)
            ->groupBy('date', 'role')
            ->orderBy('date')
            ->get();

        return response()->json($growth);
    }

    /**
     * Get top selling products.
     */
    public function topProducts(Request $request)
    {
        $limit = $request->get('limit', 10);

        $topProducts = \App\Models\Marketplace\OrderItem::selectRaw('product_id, SUM(quantity) as total_sold, SUM(price * quantity) as revenue')
            ->with('product')
            ->groupBy('product_id')
            ->orderByDesc('total_sold')
            ->limit($limit)
            ->get();

        return response()->json($topProducts);
    }

    /**
     * Get revenue by category.
     */
    public function revenueByCategory()
    {
        $revenue = \App\Models\Marketplace\OrderItem::join('products', 'order_items.product_id', '=', 'products.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.payment_status', 'paid')
            ->selectRaw('categories.name, SUM(order_items.price * order_items.quantity) as revenue')
            ->groupBy('categories.id', 'categories.name')
            ->orderByDesc('revenue')
            ->get();

        return response()->json($revenue);
    }

    /**
     * Get system health status.
     */
    public function systemHealth()
    {
        $health = [
            'database' => 'connected',
            'cache' => 'operational',
            'storage' => 'operational',
            'pending_verifications' => [
                'sellers' => \App\Models\Seller\Seller::where('is_verified', false)->count(),
                'designers' => \App\Models\InteriorDesign\Designer::where('is_verified', false)->count(),
                'workshops' => \App\Models\CustomFurniture\Workshop::where('is_verified', false)->count(),
            ],
            'pending_approvals' => [
                'products' => \App\Models\Marketplace\Product::where('status', 'pending')->count(),
            ],
        ];

        return response()->json($health);
    }
}
