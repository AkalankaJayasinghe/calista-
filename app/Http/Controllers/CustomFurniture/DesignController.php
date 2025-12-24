<?php

namespace App\Http\Controllers\CustomFurniture;

use App\Http\Controllers\Controller;
use App\Models\CustomFurniture\Design;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DesignController extends Controller
{
    /**
     * Display a listing of designs.
     */
    public function index()
    {
        $designs = Design::where('is_public', true)
            ->with('creator')
            ->latest()
            ->paginate(12);

        return response()->json($designs);
    }

    /**
     * Get designs by creator.
     */
    public function getByCreator($userId)
    {
        $designs = Design::where('created_by', $userId)
            ->where('is_public', true)
            ->latest()
            ->paginate(12);

        return response()->json($designs);
    }

    /**
     * Get user's own designs.
     */
    public function myDesigns()
    {
        $designs = Design::where('created_by', Auth::id())
            ->latest()
            ->paginate(12);

        return response()->json($designs);
    }

    /**
     * Store a newly created design.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|in:chair,table,bed,cabinet,sofa,desk,shelf,other',
            'style' => 'nullable|string|max:100',
            'dimensions' => 'nullable|string',
            'materials_used' => 'nullable|json',
            'design_images' => 'nullable|json',
            'technical_drawings' => 'nullable|json',
            'estimated_cost' => 'nullable|numeric|min:0',
            'difficulty_level' => 'nullable|in:easy,medium,hard,expert',
            'is_public' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $design = Design::create([
            'created_by' => Auth::id(),
            'name' => $request->name,
            'description' => $request->description,
            'category' => $request->category,
            'style' => $request->style,
            'dimensions' => $request->dimensions,
            'materials_used' => $request->materials_used,
            'design_images' => $request->design_images,
            'technical_drawings' => $request->technical_drawings,
            'estimated_cost' => $request->estimated_cost,
            'difficulty_level' => $request->difficulty_level,
            'is_public' => $request->is_public ?? false,
        ]);

        return response()->json([
            'message' => 'Design created successfully',
            'data' => $design->load('creator')
        ], 201);
    }

    /**
     * Display the specified design.
     */
    public function show($id)
    {
        $design = Design::with('creator')->findOrFail($id);

        // Check if design is public or belongs to the user
        if (!$design->is_public && $design->created_by !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Increment view count
        $design->increment('view_count');

        return response()->json($design);
    }

    /**
     * Update the specified design.
     */
    public function update(Request $request, $id)
    {
        $design = Design::findOrFail($id);

        // Authorization check
        if ($design->created_by !== Auth::id() && Auth::user()->role !== 'admin') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'description' => 'nullable|string',
            'category' => 'in:chair,table,bed,cabinet,sofa,desk,shelf,other',
            'style' => 'nullable|string|max:100',
            'dimensions' => 'nullable|string',
            'materials_used' => 'nullable|json',
            'design_images' => 'nullable|json',
            'technical_drawings' => 'nullable|json',
            'estimated_cost' => 'nullable|numeric|min:0',
            'difficulty_level' => 'nullable|in:easy,medium,hard,expert',
            'is_public' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $design->update($request->all());

        return response()->json([
            'message' => 'Design updated successfully',
            'data' => $design->load('creator')
        ]);
    }

    /**
     * Remove the specified design.
     */
    public function destroy($id)
    {
        $design = Design::findOrFail($id);

        // Authorization check
        if ($design->created_by !== Auth::id() && Auth::user()->role !== 'admin') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $design->delete();

        return response()->json(['message' => 'Design deleted successfully']);
    }

    /**
     * Search designs.
     */
    public function search(Request $request)
    {
        $query = Design::where('is_public', true);

        if ($request->has('category')) {
            $query->where('category', $request->category);
        }

        if ($request->has('style')) {
            $query->where('style', 'like', '%' . $request->style . '%');
        }

        if ($request->has('difficulty_level')) {
            $query->where('difficulty_level', $request->difficulty_level);
        }

        if ($request->has('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        $designs = $query->with('creator')->latest()->paginate(12);

        return response()->json($designs);
    }

    /**
     * Get popular designs.
     */
    public function popular()
    {
        $designs = Design::where('is_public', true)
            ->orderBy('view_count', 'desc')
            ->with('creator')
            ->limit(10)
            ->get();

        return response()->json($designs);
    }
}
