<?php

namespace App\Http\Controllers\InteriorDesign;

use App\Http\Controllers\Controller;
use App\Models\InteriorDesign\Consultation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ConsultationController extends Controller
{
    /**
     * Display a listing of consultations.
     */
    public function index()
    {
        $user = Auth::user();
        
        if ($user->role === 'customer') {
            $consultations = Consultation::where('customer_id', $user->id)
                ->with('designer.user')
                ->latest()
                ->paginate(10);
        } elseif ($user->role === 'designer') {
            $consultations = Consultation::whereHas('designer', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
                ->with('customer')
                ->latest()
                ->paginate(10);
        } else {
            $consultations = Consultation::with(['customer', 'designer.user'])
                ->latest()
                ->paginate(10);
        }

        return response()->json($consultations);
    }

    /**
     * Store a newly created consultation request.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'designer_id' => 'required|exists:designers,id',
            'consultation_type' => 'required|in:initial,follow_up,site_visit,virtual,final',
            'preferred_date' => 'required|date|after:now',
            'preferred_time' => 'required|string',
            'duration_minutes' => 'required|integer|min:30|max:480',
            'location' => 'required|string',
            'project_type' => 'required|string|max:100',
            'project_description' => 'required|string',
            'budget_range' => 'nullable|string',
            'timeline' => 'nullable|string',
            'special_requirements' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $consultation = Consultation::create([
            'customer_id' => Auth::id(),
            'designer_id' => $request->designer_id,
            'consultation_number' => 'CONS-' . strtoupper(uniqid()),
            'consultation_type' => $request->consultation_type,
            'preferred_date' => $request->preferred_date,
            'preferred_time' => $request->preferred_time,
            'duration_minutes' => $request->duration_minutes,
            'location' => $request->location,
            'project_type' => $request->project_type,
            'project_description' => $request->project_description,
            'budget_range' => $request->budget_range,
            'timeline' => $request->timeline,
            'special_requirements' => $request->special_requirements,
            'status' => 'pending',
        ]);

        return response()->json([
            'message' => 'Consultation request submitted successfully',
            'data' => $consultation->load('designer.user')
        ], 201);
    }

    /**
     * Display the specified consultation.
     */
    public function show($id)
    {
        $consultation = Consultation::with(['customer', 'designer.user'])->findOrFail($id);

        // Authorization check
        $user = Auth::user();
        if ($user->role === 'customer' && $consultation->customer_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        if ($user->role === 'designer' && $consultation->designer->user_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        return response()->json($consultation);
    }

    /**
     * Update consultation details.
     */
    public function update(Request $request, $id)
    {
        $consultation = Consultation::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'preferred_date' => 'date|after:now',
            'preferred_time' => 'string',
            'duration_minutes' => 'integer|min:30|max:480',
            'location' => 'string',
            'project_description' => 'string',
            'budget_range' => 'nullable|string',
            'timeline' => 'nullable|string',
            'special_requirements' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $consultation->update($request->all());

        return response()->json([
            'message' => 'Consultation updated successfully',
            'data' => $consultation
        ]);
    }

    /**
     * Confirm consultation (by designer).
     */
    public function confirm(Request $request, $id)
    {
        $consultation = Consultation::with('designer')->findOrFail($id);

        // Authorization check
        if ($consultation->designer->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $validator = Validator::make($request->all(), [
            'confirmed_date' => 'required|date',
            'confirmed_time' => 'required|string',
            'meeting_link' => 'nullable|url',
            'preparation_notes' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $consultation->update([
            'status' => 'confirmed',
            'confirmed_date' => $request->confirmed_date,
            'confirmed_time' => $request->confirmed_time,
            'meeting_link' => $request->meeting_link,
            'preparation_notes' => $request->preparation_notes,
        ]);

        return response()->json([
            'message' => 'Consultation confirmed successfully',
            'data' => $consultation
        ]);
    }

    /**
     * Complete consultation with notes.
     */
    public function complete(Request $request, $id)
    {
        $consultation = Consultation::with('designer')->findOrFail($id);

        // Authorization check
        if ($consultation->designer->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $validator = Validator::make($request->all(), [
            'consultation_notes' => 'required|string',
            'recommendations' => 'nullable|string',
            'attachments' => 'nullable|json',
            'follow_up_required' => 'boolean',
            'follow_up_notes' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $consultation->update([
            'status' => 'completed',
            'completed_at' => now(),
            'consultation_notes' => $request->consultation_notes,
            'recommendations' => $request->recommendations,
            'attachments' => $request->attachments,
            'follow_up_required' => $request->follow_up_required ?? false,
            'follow_up_notes' => $request->follow_up_notes,
        ]);

        return response()->json([
            'message' => 'Consultation completed successfully',
            'data' => $consultation
        ]);
    }

    /**
     * Cancel consultation.
     */
    public function cancel(Request $request, $id)
    {
        $consultation = Consultation::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'cancellation_reason' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $consultation->update([
            'status' => 'cancelled',
            'cancellation_reason' => $request->cancellation_reason,
            'cancelled_at' => now(),
        ]);

        return response()->json([
            'message' => 'Consultation cancelled successfully',
            'data' => $consultation
        ]);
    }

    /**
     * Reschedule consultation.
     */
    public function reschedule(Request $request, $id)
    {
        $consultation = Consultation::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'preferred_date' => 'required|date|after:now',
            'preferred_time' => 'required|string',
            'reschedule_reason' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $consultation->update([
            'status' => 'rescheduled',
            'preferred_date' => $request->preferred_date,
            'preferred_time' => $request->preferred_time,
            'reschedule_reason' => $request->reschedule_reason,
        ]);

        return response()->json([
            'message' => 'Consultation rescheduled successfully',
            'data' => $consultation
        ]);
    }
}
