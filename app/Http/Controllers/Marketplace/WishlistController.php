<?php

namespace App\Http\Controllers\Marketplace;

use App\Http\Controllers\Controller;
use App\Models\Marketplace\Wishlist;
use App\Models\Marketplace\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display wishlist
     */
    public function index()
    {
        $wishlists = Wishlist::with(['product.images'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('marketplace.wishlist.index', compact('wishlists'));
    }

    /**
     * Toggle product in wishlist
     */
    public function toggle(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        $result = Wishlist::toggle(Auth::id(), $request->product_id);

        return response()->json([
            'success' => true,
            'message' => $result['action'] === 'added'
                ? 'Added to wishlist!'
                : 'Removed from wishlist!',
            'in_wishlist' => $result['status']
        ]);
    }

    /**
     * Remove from wishlist
     */
    public function remove($id)
    {
        $wishlist = Wishlist::where('user_id', Auth::id())
            ->where('id', $id)
            ->firstOrFail();

        $wishlist->delete();

        return response()->json([
            'success' => true,
            'message' => 'Removed from wishlist!'
        ]);
    }

    /**
     * Check if product is in wishlist (AJAX)
     */
    public function check($productId)
    {
        $exists = Wishlist::check(Auth::id(), $productId);

        return response()->json([
            'in_wishlist' => $exists
        ]);
    }
}
