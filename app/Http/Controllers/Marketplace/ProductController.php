<?php

namespace App\Http\Controllers\Marketplace;

use App\Http\Controllers\Controller;
use App\Models\Marketplace\Product;
use App\Models\Marketplace\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of products
     */
    public function index(Request $request)
    {
        $query = Product::with(['category', 'images'])
            ->active()
            ->inStock();

        // Search
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Category filter
        if ($request->filled('category')) {
            $query->byCategory($request->category);
        }

        // Price range filter
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Rating filter
        if ($request->filled('rating')) {
            $query->where('average_rating', '>=', $request->rating);
        }

        // Sorting
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');

        // Validate sort column to prevent SQL injection
        $allowedSortColumns = ['created_at', 'price', 'name', 'average_rating'];
        if (!in_array($sortBy, $allowedSortColumns)) {
            $sortBy = 'created_at';
        }

        $query->orderBy($sortBy, $sortOrder === 'asc' ? 'asc' : 'desc');

        $products = $query->paginate(12);
        $categories = Category::active()->parent()->get();

        return view('marketplace.index', compact('products', 'categories'));
    }

    /**
     * Display the specified product
     */
    public function show($slug)
    {
        $product = Product::with(['images', 'category', 'reviews.user', 'seller'])
            ->where('slug', $slug)
            ->active()
            ->firstOrFail();

        // Related products
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->active()
            ->inStock()
            ->limit(4)
            ->get();

        return view('marketplace.products.show', compact('product', 'relatedProducts'));
    }

    /**
     * Quick view for product (AJAX)
     */
    public function quickView($id)
    {
        $product = Product::with(['images', 'category'])
            ->active()
            ->findOrFail($id);

        return response()->json([
            'success' => true,
            'product' => $product,
            'html' => view('marketplace.products.quick-view', compact('product'))->render()
        ]);
    }

    /**
     * Search products (AJAX)
     */
    public function search(Request $request)
    {
        $term = $request->get('term', '');

        $products = Product::active()
            ->search($term)
            ->limit(10)
            ->get(['id', 'name', 'slug', 'price', 'sale_price']);

        return response()->json([
            'success' => true,
            'products' => $products
        ]);
    }
}
