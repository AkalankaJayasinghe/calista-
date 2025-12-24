<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Marketplace\Product;
use App\Models\Marketplace\ProductImage;
use App\Models\Marketplace\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'seller']);
    }

    /**
     * Display seller's products
     */
    public function index(Request $request)
    {
        $seller = Auth::user()->seller;

        $query = Product::where('seller_id', $seller->id)
            ->with(['category', 'images']);

        // Filter by status
        if ($request->has('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        // Search
        if ($request->has('search')) {
            $query->search($request->search);
        }

        $products = $query->latest()->paginate(20);

        return view('seller.products.index', compact('products'));
    }

    /**
     * Show create product form
     */
    public function create()
    {
        $categories = Category::active()->get();
        return view('seller.products.create', compact('categories'));
    }

    /**
     * Store new product
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0|lt:price',
            'sku' => 'required|string|unique:products,sku',
            'stock_quantity' => 'required|integer|min:0',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $seller = Auth::user()->seller;

        $product = Product::create([
            'seller_id' => $seller->id,
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'short_description' => $request->short_description,
            'price' => $request->price,
            'sale_price' => $request->sale_price,
            'sku' => $request->sku,
            'stock_quantity' => $request->stock_quantity,
            'min_order_quantity' => $request->min_order_quantity ?? 1,
            'weight' => $request->weight,
            'material' => $request->material,
            'color' => $request->color,
            'brand' => $request->brand,
            'is_featured' => false,
            'is_active' => $request->is_active ?? true,
        ]);

        // Handle images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('products', 'public');

                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $path,
                    'is_primary' => $index === 0,
                    'sort_order' => $index,
                ]);
            }
        }

        return redirect()->route('seller.products.index')
            ->with('success', 'Product created successfully!');
    }

    /**
     * Show edit product form
     */
    public function edit($id)
    {
        $seller = Auth::user()->seller;

        $product = Product::where('seller_id', $seller->id)
            ->with('images')
            ->findOrFail($id);

        $categories = Category::active()->get();

        return view('seller.products.edit', compact('product', 'categories'));
    }

    /**
     * Update product
     */
    public function update(Request $request, $id)
    {
        $seller = Auth::user()->seller;

        $product = Product::where('seller_id', $seller->id)->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0|lt:price',
            'sku' => 'required|string|unique:products,sku,' . $product->id,
            'stock_quantity' => 'required|integer|min:0',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'short_description' => $request->short_description,
            'price' => $request->price,
            'sale_price' => $request->sale_price,
            'sku' => $request->sku,
            'stock_quantity' => $request->stock_quantity,
            'min_order_quantity' => $request->min_order_quantity ?? 1,
            'weight' => $request->weight,
            'material' => $request->material,
            'color' => $request->color,
            'brand' => $request->brand,
            'is_active' => $request->is_active ?? true,
        ]);

        // Handle new images
        if ($request->hasFile('images')) {
            $lastOrder = $product->images()->max('sort_order') ?? 0;

            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('products', 'public');

                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $path,
                    'is_primary' => false,
                    'sort_order' => $lastOrder + $index + 1,
                ]);
            }
        }

        return redirect()->route('seller.products.index')
            ->with('success', 'Product updated successfully!');
    }

    /**
     * Delete product
     */
    public function destroy($id)
    {
        $seller = Auth::user()->seller;

        $product = Product::where('seller_id', $seller->id)->findOrFail($id);

        // Delete images
        foreach ($product->images as $image) {
            Storage::disk('public')->delete($image->image_path);
            $image->delete();
        }

        $product->delete();

        return response()->json([
            'success' => true,
            'message' => 'Product deleted successfully!'
        ]);
    }

    /**
     * Toggle product status
     */
    public function toggleStatus($id)
    {
        $seller = Auth::user()->seller;

        $product = Product::where('seller_id', $seller->id)->findOrFail($id);
        $product->update(['is_active' => !$product->is_active]);

        return response()->json([
            'success' => true,
            'is_active' => $product->is_active,
            'message' => 'Product status updated!'
        ]);
    }
}
