<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Marketplace\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerDashboardController extends Controller
{
    /**
     * Get customer dashboard overview.
     */
    public function index()
    {
        $user = Auth::user();

        $stats = [
            'orders' => [
                'total' => $user->orders()->count(),
                'pending' => $user->orders()->where('order_status', 'pending')->count(),
                'processing' => $user->orders()->where('order_status', 'processing')->count(),
                'completed' => $user->orders()->where('order_status', 'completed')->count(),
            ],
            'wishlist_count' => $user->wishlists()->count(),
            'cart_count' => $user->cart?->items()->count() ?? 0,
            'total_spent' => $user->orders()->where('payment_status', 'paid')->sum('total_amount'),
            'pending_reviews' => $user->orders()
                ->where('order_status', 'completed')
                ->whereDoesntHave('items.product.reviews', function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                })
                ->count(),
        ];

        return response()->json($stats);
    }

    /**
     * Get recent orders.
     */
    public function recentOrders()
    {
        $orders = Auth::user()->orders()
            ->with(['items.product', 'items.variant'])
            ->latest()
            ->limit(5)
            ->get();

        return response()->json($orders);
    }

    /**
     * Get order history.
     */
    public function orderHistory(Request $request)
    {
        $query = Auth::user()->orders()->with(['items.product']);

        if ($request->has('status')) {
            $query->where('order_status', $request->status);
        }

        if ($request->has('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }

        if ($request->has('to_date')) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        $orders = $query->latest()->paginate(10);

        return response()->json($orders);
    }

    /**
     * Get wishlist items.
     */
    public function wishlist()
    {
        $wishlist = Auth::user()->wishlists()
            ->with('product')
            ->latest()
            ->paginate(12);

        return response()->json($wishlist);
    }

    /**
     * Get saved addresses.
     */
    public function addresses()
    {
        $addresses = Auth::user()->addresses()
            ->orderBy('is_default', 'desc')
            ->get();

        return response()->json($addresses);
    }

    /**
     * Get payment history.
     */
    public function paymentHistory()
    {
        $payments = Auth::user()->payments()
            ->with(['order', 'paymentMethod'])
            ->latest()
            ->paginate(15);

        return response()->json($payments);
    }

    /**
     * Get reviews given by customer.
     */
    public function myReviews()
    {
        $reviews = Auth::user()->reviews()
            ->with('product')
            ->latest()
            ->paginate(10);

        return response()->json($reviews);
    }

    /**
     * Get custom furniture requests.
     */
    public function customRequests()
    {
        $requests = \App\Models\CustomFurniture\CustomRequest::where('customer_id', Auth::id())
            ->with(['material', 'quotations'])
            ->latest()
            ->paginate(10);

        return response()->json($requests);
    }

    /**
     * Get interior design projects.
     */
    public function designProjects()
    {
        $projects = \App\Models\InteriorDesign\Project::where('customer_id', Auth::id())
            ->with(['designer.user', 'images'])
            ->latest()
            ->paginate(10);

        return response()->json($projects);
    }

    /**
     * Get consultations.
     */
    public function consultations()
    {
        $consultations = \App\Models\InteriorDesign\Consultation::where('customer_id', Auth::id())
            ->with('designer.user')
            ->latest()
            ->paginate(10);

        return response()->json($consultations);
    }

    /**
     * Get notifications.
     */
    public function notifications()
    {
        $notifications = Auth::user()->notifications()
            ->latest()
            ->paginate(20);

        return response()->json($notifications);
    }

    /**
     * Get account summary.
     */
    public function accountSummary()
    {
        $user = Auth::user();

        $summary = [
            'profile' => [
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'member_since' => $user->created_at->format('F Y'),
            ],
            'activity' => [
                'total_orders' => $user->orders()->count(),
                'total_reviews' => $user->reviews()->count(),
                'wishlist_items' => $user->wishlists()->count(),
            ],
            'spending' => [
                'total_spent' => $user->orders()->where('payment_status', 'paid')->sum('total_amount'),
                'this_year' => $user->orders()
                    ->where('payment_status', 'paid')
                    ->whereYear('created_at', now()->year)
                    ->sum('total_amount'),
                'this_month' => $user->orders()
                    ->where('payment_status', 'paid')
                    ->whereMonth('created_at', now()->month)
                    ->sum('total_amount'),
            ],
        ];

        return response()->json($summary);
    }
}
