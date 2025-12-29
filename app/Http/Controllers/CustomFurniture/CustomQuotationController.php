<?php

namespace App\Http\Controllers\CustomFurniture;

use App\Http\Controllers\Controller;
use App\Models\CustomFurniture\CustomQuotation;
use App\Models\CustomFurniture\CustomRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomQuotationController extends Controller
{
    // Quotations List එක (Workshop එකට)
    public function index()
    {
        $user = Auth::user();
        
        if ($user->role === 'workshop') {
            $quotations = CustomQuotation::where('workshop_id', $user->id)
                ->with(['customRequest'])
                ->latest()
                ->paginate(10);
                
            return view('custom-furniture.quotations.index', compact('quotations'));
        }
        
        abort(403, 'Only workshops can access this page.');
    }

    // අලුත් Quote එකක් දාන්න (Store)
    public function store(Request $request)
    {
        $request->validate([
            'custom_request_id' => 'required|exists:custom_requests,id',
            'estimated_price' => 'required|numeric|min:0',
            'estimated_days' => 'required|integer|min:1',
            'materials_cost' => 'required|numeric|min:0',
            'labor_cost' => 'required|numeric|min:0',
            'valid_until' => 'required|date|after:today',
        ]);

        // Check if already quoted
        $exists = CustomQuotation::where('custom_request_id', $request->custom_request_id)
            ->where('workshop_id', Auth::id())
            ->exists();

        if ($exists) {
            return back()->with('error', 'You have already submitted a quotation for this request.');
        }

        CustomQuotation::create([
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

        // Status update
        CustomRequest::where('id', $request->custom_request_id)
            ->where('status', 'pending')
            ->update(['status' => 'quoted']);

        return redirect()->route('custom-furniture.workshops.dashboard') // හෝ අදාළ පිටුවට
            ->with('success', 'Quotation submitted successfully!');
    }

    // පාරිභෝගිකයා Quote එක Accept කිරීම
    public function accept($id)
    {
        $quotation = CustomQuotation::with('customRequest')->findOrFail($id);

        if ($quotation->customRequest->customer_id !== Auth::id()) {
            abort(403);
        }

        // Quote එක update කිරීම
        $quotation->update(['status' => 'accepted']);
        
        // Request එක update කිරීම
        $quotation->customRequest->update(['status' => 'accepted']);

        // අනිත් ඔක්කොම Quotes reject කිරීම
        CustomQuotation::where('custom_request_id', $quotation->custom_request_id)
            ->where('id', '!=', $id)
            ->where('status', 'pending')
            ->update(['status' => 'rejected']);

        // Order එකක් create කරන්න පිටුවට යවනවා
        return redirect()->route('custom-furniture.orders.create', ['quotation_id' => $id])
            ->with('success', 'Quotation accepted! Please proceed to create the order.');
    }

    // Quote එක Reject කිරීම
    public function reject($id)
    {
        $quotation = CustomQuotation::with('customRequest')->findOrFail($id);

        if ($quotation->customRequest->customer_id !== Auth::id()) {
            abort(403);
        }

        $quotation->update(['status' => 'rejected']);

        return back()->with('success', 'Quotation rejected.');
    }
}