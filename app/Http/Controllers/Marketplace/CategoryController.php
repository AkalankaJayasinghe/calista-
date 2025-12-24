<?php

namespace App\Http\Controllers\Marketplace;

use App\Http\Controllers\Controller;
use App\Models\Marketplace\Category;
use App\Models\Marketplace\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display all categories
     */
    public function index()
    {
        $categories = Category::with('children')
            ->active()
            ->parent()
            ->ordered()
            ->get();

        return view('marketplace.categories.index', compact('categories'));
    }

    /**
     * Display category with products
     */
    public function show(Request $request, $slug)
    {
        $category = Category::with('children')
            ->where('slug', $slug)
            ->active()
            ->firstOrFail();

        // Get category IDs (include children)
        $categoryIds = [$category->id];
        if ($category->has_children) {
            $categoryIds = array_merge(
                $categoryIds,
                $category->children->pluck('id')->toArray()
            );
        }

        // Query products
        $query = Product::with(['images', 'category'])
            ->active()
            ->inStock()
            ->whereIn('category_id', $categoryIds);

        // Price range filter
        if ($request->has('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->has('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Sorting
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $products = $query->paginate(12);

        return view('marketplace.categories.show', compact('category', 'products'));
    }
}
