<?php

namespace App\Http\Controllers\InteriorDesign;

use App\Http\Controllers\Controller;
use App\Models\InteriorDesign\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PortfolioController extends Controller
{
    /**
     * Display a listing of portfolios.
     */
    public function index()
    {
        $portfolios = Portfolio::where('is_published', true)
            ->with('designer.user')
            ->latest()
            ->paginate(12);

        return response()->json($portfolios);
    }

    /**
     * Get portfolios by designer.
     */
    public function getByDesigner($designerId)
    {
        $portfolios = Portfolio::where('designer_id', $designerId)
            ->where('is_published', true)
            ->latest()
            ->paginate(12);

        return response()->json($portfolios);
    }

    /**
     * Get designer's own portfolios.
     */
    public function myPortfolios()
    {
        $user = Auth::user();
        
        $portfolios = Portfolio::whereHas('designer', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
            ->latest()
            ->paginate(12);

        return response()->json($portfolios);
    }

    /**
     * Store a newly created portfolio.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'designer_id' => 'required|exists:designers,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'project_type' => 'required|in:residential,commercial,hospitality,office,retail,other',
            'style' => 'nullable|string|max:100',
            'location' => 'nullable|string',
            'year_completed' => 'nullable|integer|min:1900|max:' . date('Y'),
            'area_size' => 'nullable|numeric|min:0',
            'budget_range' => 'nullable|string',
            'images' => 'required|json',
            'featured_image' => 'required|string',
            'tags' => 'nullable|json',
            'client_name' => 'nullable|string|max:255',
            'is_published' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Verify designer belongs to authenticated user
        $designer = \App\Models\InteriorDesign\Designer::findOrFail($request->designer_id);
        if ($designer->user_id !== Auth::id() && Auth::user()->role !== 'admin') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $portfolio = Portfolio::create($request->all());

        return response()->json([
            'message' => 'Portfolio created successfully',
            'data' => $portfolio->load('designer.user')
        ], 201);
    }

    /**
     * Display the specified portfolio.
     */
    public function show($id)
    {
        $portfolio = Portfolio::with('designer.user')->findOrFail($id);

        // Check if published or belongs to user
        if (!$portfolio->is_published) {
            if (Auth::guest() || ($portfolio->designer->user_id !== Auth::id() && Auth::user()->role !== 'admin')) {
                return response()->json(['error' => 'Portfolio not found'], 404);
            }
        }

        // Increment view count
        $portfolio->increment('view_count');

        return response()->json($portfolio);
    }

    /**
     * Update the specified portfolio.
     */
    public function update(Request $request, $id)
    {
        $portfolio = Portfolio::with('designer')->findOrFail($id);

        // Authorization check
        if ($portfolio->designer->user_id !== Auth::id() && Auth::user()->role !== 'admin') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'string|max:255',
            'description' => 'string',
            'project_type' => 'in:residential,commercial,hospitality,office,retail,other',
            'style' => 'nullable|string|max:100',
            'location' => 'nullable|string',
            'year_completed' => 'nullable|integer|min:1900|max:' . date('Y'),
            'area_size' => 'nullable|numeric|min:0',
            'budget_range' => 'nullable|string',
            'images' => 'json',
            'featured_image' => 'string',
            'tags' => 'nullable|json',
            'client_name' => 'nullable|string|max:255',
            'is_published' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $portfolio->update($request->all());

        return response()->json([
            'message' => 'Portfolio updated successfully',
            'data' => $portfolio->load('designer.user')
        ]);
    }

    /**
     * Remove the specified portfolio.
     */
    public function destroy($id)
    {
        $portfolio = Portfolio::with('designer')->findOrFail($id);

        // Authorization check
        if ($portfolio->designer->user_id !== Auth::id() && Auth::user()->role !== 'admin') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $portfolio->delete();

        return response()->json(['message' => 'Portfolio deleted successfully']);
    }

    /**
     * Toggle publish status.
     */
    public function togglePublish($id)
    {
        $portfolio = Portfolio::with('designer')->findOrFail($id);

        // Authorization check
        if ($portfolio->designer->user_id !== Auth::id() && Auth::user()->role !== 'admin') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $portfolio->update(['is_published' => !$portfolio->is_published]);

        return response()->json([
            'message' => 'Portfolio publish status updated',
            'data' => $portfolio
        ]);
    }

    /**
     * Search portfolios.
     */
    public function search(Request $request)
    {
        $query = Portfolio::where('is_published', true);

        if ($request->has('project_type')) {
            $query->where('project_type', $request->project_type);
        }

        if ($request->has('style')) {
            $query->where('style', 'like', '%' . $request->style . '%');
        }

        if ($request->has('year')) {
            $query->where('year_completed', $request->year);
        }

        if ($request->has('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        $portfolios = $query->with('designer.user')->latest()->paginate(12);

        return response()->json($portfolios);
    }

    /**
     * Get featured portfolios.
     */
    public function featured()
    {
        $portfolios = Portfolio::where('is_published', true)
            ->where('is_featured', true)
            ->with('designer.user')
            ->latest()
            ->limit(8)
            ->get();

        return response()->json($portfolios);
    }
}
