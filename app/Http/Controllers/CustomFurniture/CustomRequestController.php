<?php

namespace App\Http\Controllers\CustomFurniture;

use App\Http\Controllers\Controller;
use App\Models\CustomFurniture\CustomRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CustomRequestController extends Controller
{
    /**
     * Display a listing of custom requests.
     */
    public function index()
    {
        $user = Auth::user();
        
        if ($user->role === 'customer') {
            $requests = CustomRequest::where('customer_id', $user->id)
                ->with(['material', 'quotations'])
                ->latest()
                ->paginate(10);
        } else {
            $requests = CustomRequest::with(['customer', 'material', 'quotations'])
                ->latest()
                ->paginate(10);
        }

        return response()->json($requests);
    }

    /**
     * Store a newly created custom request.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'material_id' => 'required|exists:materials,id',
            'dimensions' => 'nullable|string',
            'preferred_wood_type' => 'nullable|string',
            'budget_range' => 'nullable|string',
            'delivery_address' => 'required|string',
            'preferred_delivery_date' => 'nullable|date',
            'reference_images' => 'nullable|json',
            'special_requirements' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $customRequest = CustomRequest::create([
            'customer_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'material_id' => $request->material_id,
            'dimensions' => $request->dimensions,
            'preferred_wood_type' => $request->preferred_wood_type,
            'budget_range' => $request->budget_range,
            'delivery_address' => $request->delivery_address,
            'preferred_delivery_date' => $request->preferred_delivery_date,
            'reference_images' => $request->reference_images,
            'special_requirements' => $request->special_requirements,
            'status' => 'pending',
        ]);

        return response()->json([
            'message' => 'Custom request submitted successfully',
            'data' => $customRequest->load('material')
        ], 201);
    }

    /**
     * Display the specified custom request.
     */
    public function show($id)
    {
        $customRequest = CustomRequest::with(['customer', 'material', 'quotations.workshop'])
            ->findOrFail($id);

        // Authorization check
        if (Auth::user()->role === 'customer' && $customRequest->customer_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        return response()->json($customRequest);
    }

    /**
     * Update the specified custom request.
     */
    public function update(Request $request, $id)
    {
        $customRequest = CustomRequest::findOrFail($id);

        // Authorization check
        if (Auth::user()->role === 'customer' && $customRequest->customer_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'string|max:255',
            'description' => 'string',
            'material_id' => 'exists:materials,id',
            'dimensions' => 'nullable|string',
            'preferred_wood_type' => 'nullable|string',
            'budget_range' => 'nullable|string',
            'delivery_address' => 'string',
            'preferred_delivery_date' => 'nullable|date',
            'reference_images' => 'nullable|json',
            'special_requirements' => 'nullable|string',
            'status' => 'in:pending,quoted,accepted,in_progress,completed,cancelled',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $customRequest->update($request->all());

        return response()->json([
            'message' => 'Custom request updated successfully',
            'data' => $customRequest->load('material')
        ]);
    }

    /**
     * Remove the specified custom request.
     */
    public function destroy($id)
    {
        $customRequest = CustomRequest::findOrFail($id);

        // Authorization check
        if (Auth::user()->role === 'customer' && $customRequest->customer_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Can only delete if status is pending
        if ($customRequest->status !== 'pending') {
            return response()->json(['error' => 'Cannot delete request in current status'], 400);
        }

        $customRequest->delete();

        return response()->json(['message' => 'Custom request deleted successfully']);
    }

    /**
     * Cancel a custom request.
     */
    public function cancel($id)
    {
        $customRequest = CustomRequest::findOrFail($id);

        // Authorization check
        if (Auth::user()->role === 'customer' && $customRequest->customer_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        if (in_array($customRequest->status, ['completed', 'cancelled'])) {
            return response()->json(['error' => 'Cannot cancel request in current status'], 400);
        }

        $customRequest->update(['status' => 'cancelled']);

        return response()->json([
            'message' => 'Custom request cancelled successfully',
            'data' => $customRequest
        ]);
    }
}
