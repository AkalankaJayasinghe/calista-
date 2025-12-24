<?php

namespace App\Http\Controllers\InteriorDesign;

use App\Http\Controllers\Controller;
use App\Models\InteriorDesign\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    /**
     * Display a listing of projects.
     */
    public function index()
    {
        $user = Auth::user();
        
        if ($user->role === 'customer') {
            $projects = Project::where('customer_id', $user->id)
                ->with(['designer.user', 'images'])
                ->latest()
                ->paginate(10);
        } elseif ($user->role === 'designer') {
            $projects = Project::whereHas('designer', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
                ->with(['customer', 'images'])
                ->latest()
                ->paginate(10);
        } else {
            $projects = Project::with(['customer', 'designer.user', 'images'])
                ->latest()
                ->paginate(10);
        }

        return response()->json($projects);
    }

    /**
     * Store a newly created project.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required|exists:users,id',
            'designer_id' => 'required|exists:designers,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'project_type' => 'required|in:residential,commercial,hospitality,office,retail,other',
            'location' => 'required|string',
            'total_area' => 'nullable|numeric|min:0',
            'budget' => 'nullable|numeric|min:0',
            'start_date' => 'required|date',
            'expected_end_date' => 'required|date|after:start_date',
            'requirements' => 'nullable|json',
            'scope_of_work' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $project = Project::create([
            'customer_id' => $request->customer_id,
            'designer_id' => $request->designer_id,
            'project_number' => 'PROJ-' . strtoupper(uniqid()),
            'title' => $request->title,
            'description' => $request->description,
            'project_type' => $request->project_type,
            'location' => $request->location,
            'total_area' => $request->total_area,
            'budget' => $request->budget,
            'start_date' => $request->start_date,
            'expected_end_date' => $request->expected_end_date,
            'requirements' => $request->requirements,
            'scope_of_work' => $request->scope_of_work,
            'status' => 'planning',
        ]);

        return response()->json([
            'message' => 'Project created successfully',
            'data' => $project->load(['customer', 'designer.user'])
        ], 201);
    }

    /**
     * Display the specified project.
     */
    public function show($id)
    {
        $project = Project::with(['customer', 'designer.user', 'images'])
            ->findOrFail($id);

        // Authorization check
        $user = Auth::user();
        if ($user->role === 'customer' && $project->customer_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        if ($user->role === 'designer' && $project->designer->user_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        return response()->json($project);
    }

    /**
     * Update the specified project.
     */
    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title' => 'string|max:255',
            'description' => 'string',
            'project_type' => 'in:residential,commercial,hospitality,office,retail,other',
            'location' => 'string',
            'total_area' => 'nullable|numeric|min:0',
            'budget' => 'nullable|numeric|min:0',
            'start_date' => 'date',
            'expected_end_date' => 'date|after:start_date',
            'actual_end_date' => 'nullable|date',
            'requirements' => 'nullable|json',
            'scope_of_work' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $project->update($request->all());

        return response()->json([
            'message' => 'Project updated successfully',
            'data' => $project
        ]);
    }

    /**
     * Update project status.
     */
    public function updateStatus(Request $request, $id)
    {
        $project = Project::with('designer')->findOrFail($id);

        // Authorization check
        if ($project->designer->user_id !== Auth::id() && Auth::user()->role !== 'admin') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $validator = Validator::make($request->all(), [
            'status' => 'required|in:planning,design,approval,execution,review,completed,on_hold,cancelled',
            'progress_percentage' => 'nullable|integer|min:0|max:100',
            'status_notes' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $updateData = [
            'status' => $request->status,
            'status_notes' => $request->status_notes,
        ];

        if ($request->has('progress_percentage')) {
            $updateData['progress_percentage'] = $request->progress_percentage;
        }

        if ($request->status === 'completed') {
            $updateData['actual_end_date'] = now();
            $updateData['progress_percentage'] = 100;
        }

        $project->update($updateData);

        return response()->json([
            'message' => 'Project status updated successfully',
            'data' => $project
        ]);
    }

    /**
     * Add milestone to project.
     */
    public function addMilestone(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'milestone_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'target_date' => 'required|date',
            'amount' => 'nullable|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $milestones = $project->milestones ?? [];
        $milestones[] = [
            'id' => uniqid(),
            'name' => $request->milestone_name,
            'description' => $request->description,
            'target_date' => $request->target_date,
            'amount' => $request->amount,
            'status' => 'pending',
            'created_at' => now()->toDateTimeString(),
        ];

        $project->update(['milestones' => json_encode($milestones)]);

        return response()->json([
            'message' => 'Milestone added successfully',
            'data' => $project
        ]);
    }

    /**
     * Delete project.
     */
    public function destroy($id)
    {
        $project = Project::findOrFail($id);

        // Can only delete if status is planning
        if ($project->status !== 'planning') {
            return response()->json(['error' => 'Cannot delete project in current status'], 400);
        }

        $project->delete();

        return response()->json(['message' => 'Project deleted successfully']);
    }

    /**
     * Get project statistics.
     */
    public function statistics($id)
    {
        $project = Project::with('images')->findOrFail($id);

        $stats = [
            'total_images' => $project->images()->count(),
            'progress_percentage' => $project->progress_percentage ?? 0,
            'days_elapsed' => now()->diffInDays($project->start_date),
            'days_remaining' => $project->expected_end_date ? now()->diffInDays($project->expected_end_date, false) : null,
            'budget_utilized' => $project->actual_cost ?? 0,
            'budget_remaining' => $project->budget ? ($project->budget - ($project->actual_cost ?? 0)) : null,
            'milestones_total' => $project->milestones ? count(json_decode($project->milestones, true)) : 0,
        ];

        return response()->json($stats);
    }
}
