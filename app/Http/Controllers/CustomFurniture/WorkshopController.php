<?php

namespace App\Http\Controllers\CustomFurniture;

use App\Http\Controllers\Controller;
use App\Models\CustomFurniture\Workshop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class WorkshopController extends Controller
{
    /**
     * Display a listing of workshops.
     */
    public function index()
    {
        $workshops = Workshop::where('is_verified', true)
            ->where('is_active', true)
            ->with('user')
            ->paginate(12);

        return response()->json($workshops);
    }

    /**
     * Display all workshops (including unverified) - Admin only.
     */
    public function all()
    {
        $workshops = Workshop::with('user')->paginate(12);

        return response()->json($workshops);
    }

    /**
     * Store a newly created workshop.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'business_name' => 'required|string|max:255',
            'business_registration_number' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'specialization' => 'nullable|json',
            'address' => 'required|string',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'website' => 'nullable|url',
            'years_of_experience' => 'nullable|integer|min:0',
            'certifications' => 'nullable|json',
            'portfolio_images' => 'nullable|json',
            'operating_hours' => 'nullable|json',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $workshop = Workshop::create($request->all());

        return response()->json([
            'message' => 'Workshop created successfully',
            'data' => $workshop->load('user')
        ], 201);
    }

    /**
     * Display the specified workshop.
     */
    public function show($id)
    {
        $workshop = Workshop::with(['user', 'quotations' => function ($query) {
            $query->where('status', 'accepted')->limit(5);
        }])->findOrFail($id);

        return response()->json($workshop);
    }

    /**
     * Update the specified workshop.
     */
    public function update(Request $request, $id)
    {
        $workshop = Workshop::findOrFail($id);

        // Authorization check
        if (Auth::id() !== $workshop->user_id && Auth::user()->role !== 'admin') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $validator = Validator::make($request->all(), [
            'business_name' => 'string|max:255',
            'business_registration_number' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'specialization' => 'nullable|json',
            'address' => 'string',
            'city' => 'string|max:100',
            'state' => 'string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'phone' => 'string|max:20',
            'email' => 'email|max:255',
            'website' => 'nullable|url',
            'years_of_experience' => 'nullable|integer|min:0',
            'certifications' => 'nullable|json',
            'portfolio_images' => 'nullable|json',
            'operating_hours' => 'nullable|json',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $workshop->update($request->all());

        return response()->json([
            'message' => 'Workshop updated successfully',
            'data' => $workshop->load('user')
        ]);
    }

    /**
     * Verify a workshop (Admin only).
     */
    public function verify($id)
    {
        $workshop = Workshop::findOrFail($id);

        $workshop->update([
            'is_verified' => true,
            'verified_at' => now(),
        ]);

        return response()->json([
            'message' => 'Workshop verified successfully',
            'data' => $workshop
        ]);
    }

    /**
     * Deactivate a workshop.
     */
    public function deactivate($id)
    {
        $workshop = Workshop::findOrFail($id);

        $workshop->update(['is_active' => false]);

        return response()->json([
            'message' => 'Workshop deactivated successfully',
            'data' => $workshop
        ]);
    }

    /**
     * Activate a workshop.
     */
    public function activate($id)
    {
        $workshop = Workshop::findOrFail($id);

        $workshop->update(['is_active' => true]);

        return response()->json([
            'message' => 'Workshop activated successfully',
            'data' => $workshop
        ]);
    }

    /**
     * Get workshop statistics.
     */
    public function statistics($id)
    {
        $workshop = Workshop::findOrFail($id);

        $stats = [
            'total_quotations' => $workshop->quotations()->count(),
            'accepted_quotations' => $workshop->quotations()->where('status', 'accepted')->count(),
            'pending_quotations' => $workshop->quotations()->where('status', 'pending')->count(),
            'total_orders' => $workshop->quotations()->whereHas('customOrder')->count(),
            'completed_orders' => $workshop->quotations()
                ->whereHas('customOrder', function ($query) {
                    $query->where('status', 'completed');
                })->count(),
            'average_rating' => $workshop->average_rating,
            'total_reviews' => $workshop->total_reviews,
        ];

        return response()->json($stats);
    }
}
