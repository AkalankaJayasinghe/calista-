<?php

namespace App\Http\Controllers\InteriorDesign;

use App\Http\Controllers\Controller;
use App\Models\InteriorDesign\DesignCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class DesignCategoryController extends Controller
{
    /**
     * Display a listing of design categories.
     */
    public function index()
    {
        $categories = DesignCategory::where('is_active', true)
            ->orderBy('name')
            ->get();

        return response()->json($categories);
    }

    /**
     * Display all categories (including inactive) - Admin only.
     */
    public function all()
    {
        $categories = DesignCategory::orderBy('name')->get();

        return response()->json($categories);
    }

    /**
     * Store a newly created category.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100|unique:design_categories,name',
            'description' => 'nullable|string',
            'icon' => 'nullable|string',
            'parent_id' => 'nullable|exists:design_categories,id',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $category = DesignCategory::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'icon' => $request->icon,
            'parent_id' => $request->parent_id,
            'is_active' => $request->is_active ?? true,
        ]);

        return response()->json([
            'message' => 'Design category created successfully',
            'data' => $category
        ], 201);
    }

    /**
     * Display the specified category.
     */
    public function show($id)
    {
        $category = DesignCategory::with(['children', 'parent'])->findOrFail($id);

        return response()->json($category);
    }

    /**
     * Update the specified category.
     */
    public function update(Request $request, $id)
    {
        $category = DesignCategory::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'string|max:100|unique:design_categories,name,' . $id,
            'description' => 'nullable|string',
            'icon' => 'nullable|string',
            'parent_id' => 'nullable|exists:design_categories,id',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $updateData = $request->all();
        if ($request->has('name')) {
            $updateData['slug'] = Str::slug($request->name);
        }

        $category->update($updateData);

        return response()->json([
            'message' => 'Design category updated successfully',
            'data' => $category
        ]);
    }

    /**
     * Remove the specified category.
     */
    public function destroy($id)
    {
        $category = DesignCategory::findOrFail($id);

        // Check if category has children
        if ($category->children()->count() > 0) {
            return response()->json([
                'error' => 'Cannot delete category with subcategories'
            ], 400);
        }

        $category->delete();

        return response()->json(['message' => 'Design category deleted successfully']);
    }

    /**
     * Get category tree structure.
     */
    public function tree()
    {
        $categories = DesignCategory::where('is_active', true)
            ->whereNull('parent_id')
            ->with('children')
            ->orderBy('name')
            ->get();

        return response()->json($categories);
    }
}
