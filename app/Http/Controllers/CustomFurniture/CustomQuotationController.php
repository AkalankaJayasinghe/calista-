<?php

namespace App\Http\Controllers\CustomFurniture;

use App\Http\Controllers\Controller;
use App\Models\CustomFurniture\CustomQuotation;
use App\Models\CustomFurniture\CustomRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CustomQuotationController extends Controller
{
    /**
     * Display a listing of quotations.
     */
    public function index()
    {
        $user = Auth::user();
        
        if ($user->role === 'workshop') {
            $quotations = CustomQuotation::where('workshop_id', $user->id)
                ->with(['customRequest', 'workshop'])
                ->latest()
                ->paginate(10);
        } else {
            $quotations = CustomQuotation::with(['customRequest', 'workshop'])
                ->latest()
                ->paginate(10);
        }

        return response()->json($quotations);
    }

    /**
     * Get quotations for a specific custom request.
     */
    public function getByRequest($requestId)
    {
        $customRequest = CustomRequest::findOrFail($requestId);
        
        // Authorization check
        if (Auth::user()->role === 'customer' && $customRequest->customer_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $quotations = CustomQuotation::where('custom_request_id', $requestId)
            ->with('workshop')
            ->get();

        return response()->json($quotations);
    }

    /**
     * Store a newly created quotation.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'custom_request_id' => 'required|exists:custom_requests,id',
            'estimated_price' => 'required|numeric|min:0',
            'estimated_days' => 'required|integer|min:1',
            'materials_cost' => 'required|numeric|min:0',
            'labor_cost' => 'required|numeric|min:0',
            'additional_costs' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
            'valid_until' => 'required|date|after:today',
            'terms_conditions' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Check if workshop already submitted a quotation
        $existingQuotation = CustomQuotation::where('custom_request_id', $request->custom_request_id)
            ->where('workshop_id', Auth::id())
            ->first();

        if ($existingQuotation) {
            return response()->json(['error' => 'You have already submitted a quotation for this request'], 400);
        }

        $quotation = CustomQuotation::create([
            'custom_request_id' => $request->custom_request_id,
            'workshop_id' => Auth::id(),
            'estimated_price' => $request->estimated_price,
            'estimated_days' => $request->estimated_days,
            'materials_cost' => $request->materials_cost,
            'labor_cost' => $request->labor_cost,
            'additional_costs' => $request->additional_costs ?? 0,
            'notes' => $request->notes,
            'valid_until' => $request->valid_until,
            'terms_conditions' => $request->terms_conditions,
            'status' => 'pending',
        ]);

        // Update custom request status
        $customRequest = CustomRequest::find($request->custom_request_id);
        if ($customRequest->status === 'pending') {
            $customRequest->update(['status' => 'quoted']);
        }

        return response()->json([
            'message' => 'Quotation submitted successfully',
            'data' => $quotation->load('workshop')
        ], 201);
    }

    /**
     * Display the specified quotation.
     */
    public function show($id)
    {
        $quotation = CustomQuotation::with(['customRequest', 'workshop'])->findOrFail($id);

        return response()->json($quotation);
    }

    /**
     * Update the specified quotation.
     */
    public function update(Request $request, $id)
    {
        $quotation = CustomQuotation::findOrFail($id);

        // Authorization check
        if (Auth::user()->role === 'workshop' && $quotation->workshop_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Can only update if status is pending
        if ($quotation->status !== 'pending') {
            return response()->json(['error' => 'Cannot update quotation in current status'], 400);
        }

        $validator = Validator::make($request->all(), [
            'estimated_price' => 'numeric|min:0',
            'estimated_days' => 'integer|min:1',
            'materials_cost' => 'numeric|min:0',
            'labor_cost' => 'numeric|min:0',
            'additional_costs' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
            'valid_until' => 'date|after:today',
            'terms_conditions' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $quotation->update($request->all());

        return response()->json([
            'message' => 'Quotation updated successfully',
            'data' => $quotation->load('workshop')
        ]);
    }

    /**
     * Accept a quotation (by customer).
     */
    public function accept($id)
    {
        $quotation = CustomQuotation::with('customRequest')->findOrFail($id);

        // Authorization check - only the customer who made the request can accept
        if ($quotation->customRequest->customer_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        if ($quotation->status !== 'pending') {
            return response()->json(['error' => 'Quotation is no longer pending'], 400);
        }

        // Update quotation status
        $quotation->update(['status' => 'accepted']);

        // Update custom request status
        $quotation->customRequest->update(['status' => 'accepted']);

        // Reject other pending quotations for this request
        CustomQuotation::where('custom_request_id', $quotation->custom_request_id)
            ->where('id', '!=', $id)
            ->where('status', 'pending')
            ->update(['status' => 'rejected']);

        return response()->json([
            'message' => 'Quotation accepted successfully',
            'data' => $quotation
        ]);
    }

    /**
     * Reject a quotation (by customer).
     */
    public function reject($id)
    {
        $quotation = CustomQuotation::with('customRequest')->findOrFail($id);

        // Authorization check
        if ($quotation->customRequest->customer_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        if ($quotation->status !== 'pending') {
            return response()->json(['error' => 'Quotation is no longer pending'], 400);
        }

        $quotation->update(['status' => 'rejected']);

        return response()->json([
            'message' => 'Quotation rejected successfully',
            'data' => $quotation
        ]);
    }

    /**
     * Delete a quotation.
     */
    public function destroy($id)
    {
        $quotation = CustomQuotation::findOrFail($id);

        // Authorization check
        if (Auth::user()->role === 'workshop' && $quotation->workshop_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Can only delete if status is pending
        if ($quotation->status !== 'pending') {
            return response()->json(['error' => 'Cannot delete quotation in current status'], 400);
        }

        $quotation->delete();

        return response()->json(['message' => 'Quotation deleted successfully']);
    }
}
