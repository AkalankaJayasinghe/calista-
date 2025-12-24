<?php

namespace App\Http\Controllers\InteriorDesign;

use App\Http\Controllers\Controller;
use App\Models\InteriorDesign\Designer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DesignerController extends Controller
{
    /**
     * Display a listing of designers.
     */
    public function index()
    {
        $designers = Designer::where('is_verified', true)
            ->where('is_active', true)
            ->with(['user', 'portfolios'])
            ->paginate(12);

        return response()->json($designers);
    }

    /**
     * Display all designers (including unverified) - Admin only.
     */
    public function all()
    {
        $designers = Designer::with(['user', 'portfolios'])->paginate(12);

        return response()->json($designers);
    }

    /**
     * Store a newly created designer profile.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id|unique:designers,user_id',
            'business_name' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'specialization' => 'nullable|json',
            'years_of_experience' => 'nullable|integer|min:0',
            'education' => 'nullable|json',
            'certifications' => 'nullable|json',
            'design_style' => 'nullable|json',
            'address' => 'required|string',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'website' => 'nullable|url',
            'portfolio_url' => 'nullable|url',
            'social_media' => 'nullable|json',
            'hourly_rate' => 'nullable|numeric|min:0',
            'consultation_fee' => 'nullable|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $designer = Designer::create($request->all());

        return response()->json([
            'message' => 'Designer profile created successfully',
            'data' => $designer->load('user')
        ], 201);
    }

    /**
     * Display the specified designer.
     */
    public function show($id)
    {
        $designer = Designer::with(['user', 'portfolios', 'projects' => function ($query) {
            $query->where('status', 'completed')->limit(6);
        }])->findOrFail($id);

        return response()->json($designer);
    }

    /**
     * Update the specified designer.
     */
    public function update(Request $request, $id)
    {
        $designer = Designer::findOrFail($id);

        // Authorization check
        if (Auth::id() !== $designer->user_id && Auth::user()->role !== 'admin') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $validator = Validator::make($request->all(), [
            'business_name' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'specialization' => 'nullable|json',
            'years_of_experience' => 'nullable|integer|min:0',
            'education' => 'nullable|json',
            'certifications' => 'nullable|json',
            'design_style' => 'nullable|json',
            'address' => 'string',
            'city' => 'string|max:100',
            'state' => 'string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'phone' => 'string|max:20',
            'email' => 'email|max:255',
            'website' => 'nullable|url',
            'portfolio_url' => 'nullable|url',
            'social_media' => 'nullable|json',
            'hourly_rate' => 'nullable|numeric|min:0',
            'consultation_fee' => 'nullable|numeric|min:0',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $designer->update($request->all());

        return response()->json([
            'message' => 'Designer profile updated successfully',
            'data' => $designer->load('user')
        ]);
    }

    /**
     * Verify a designer (Admin only).
     */
    public function verify($id)
    {
        $designer = Designer::findOrFail($id);

        $designer->update([
            'is_verified' => true,
            'verified_at' => now(),
        ]);

        return response()->json([
            'message' => 'Designer verified successfully',
            'data' => $designer
        ]);
    }

    /**
     * Get designer statistics.
     */
    public function statistics($id)
    {
        $designer = Designer::findOrFail($id);

        $stats = [
            'total_projects' => $designer->projects()->count(),
            'completed_projects' => $designer->projects()->where('status', 'completed')->count(),
            'active_projects' => $designer->projects()->where('status', 'in_progress')->count(),
            'total_consultations' => $designer->consultations()->count(),
            'completed_consultations' => $designer->consultations()->where('status', 'completed')->count(),
            'portfolio_count' => $designer->portfolios()->count(),
            'average_rating' => $designer->average_rating,
            'total_reviews' => $designer->total_reviews,
        ];

        return response()->json($stats);
    }

    /**
     * Search designers.
     */
    public function search(Request $request)
    {
        $query = Designer::where('is_verified', true)->where('is_active', true);

        if ($request->has('city')) {
            $query->where('city', $request->city);
        }

        if ($request->has('state')) {
            $query->where('state', $request->state);
        }

        if ($request->has('min_experience')) {
            $query->where('years_of_experience', '>=', $request->min_experience);
        }

        if ($request->has('max_rate')) {
            $query->where('hourly_rate', '<=', $request->max_rate);
        }

        if ($request->has('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('business_name', 'like', '%' . $request->search . '%')
                  ->orWhere('bio', 'like', '%' . $request->search . '%');
            });
        }

        $designers = $query->with(['user', 'portfolios'])->paginate(12);

        return response()->json($designers);
    }
}
