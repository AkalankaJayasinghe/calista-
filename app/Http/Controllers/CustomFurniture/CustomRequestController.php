<?php

namespace App\Http\Controllers\CustomFurniture;

use App\Http\Controllers\Controller;
use App\Models\CustomFurniture\CustomRequest;
use App\Models\CustomFurniture\Material; // Material Model එක import කරන්න
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomRequestController extends Controller
{
    /**
     * මගේ ඉල්ලීම් ලැයිස්තුව පෙන්වීම (Page: my-requests)
     */
    public function index()
    {
        $user = Auth::user();

        // Customer කෙනෙක් නම් එයාගේ ඒවා විතරයි
        if ($user->role === 'customer') {
            $requests = CustomRequest::where('customer_id', $user->id)
                ->with(['material', 'quotations'])
                ->latest()
                ->paginate(10);
        } else {
            // Admin හෝ Workshop නම් ඔක්කොම
            $requests = CustomRequest::with(['customer', 'material', 'quotations'])
                ->latest()
                ->paginate(10);
        }

        // JSON නැතුව View එකක් Return කරනවා
        return view('custom-furniture.my-requests', compact('requests'));
    }

    /**
     * අලුත් ඉල්ලීමක් දාන Form එක පෙන්වීම (Page: create)
     */
   public function create()
{
    // Database එකෙන් Active Materials ටික ගන්නවා Dropdown එකට
    $materials = \App\Models\CustomFurniture\Material::where('is_active', true)->get();

    // View එකට යවනවා
    return view('custom-furniture.request-form', compact('materials'));
}

    /**
     * Form එක Submit කළාම Data Save කිරීම
     */
    public function store(Request $request)
    {
        // Validation (වැරදි තිබුනොත් Auto Redirect වෙනවා)
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'material_id' => 'required|exists:materials,id',
            'dimensions' => 'nullable|string',
            'budget_range' => 'nullable|string',
            'delivery_address' => 'required|string',
            'reference_images.*' => 'nullable|image|max:2048', // Image Validation
        ]);

        // Image Upload Logic
        $imagePaths = [];
        if($request->hasFile('reference_images')) {
            foreach($request->file('reference_images') as $image) {
                // public/storage/custom-requests ෆෝල්ඩර් එකට save වෙනවා
                $path = $image->store('custom-requests', 'public');
                $imagePaths[] = $path;
            }
        }

        CustomRequest::create([
            'customer_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'material_id' => $request->material_id,
            'dimensions' => $request->dimensions,
            'budget_range' => $request->budget_range,
            'delivery_address' => $request->delivery_address,
            'preferred_wood_type' => $request->preferred_wood_type,
            'reference_images' => json_encode($imagePaths), // JSON විදියට save කරනවා
            'status' => 'pending',
        ]);

        // වැඩේ හරි නම් My Requests පිටුවට යවනවා Message එකක් එක්කම
        return redirect()->route('custom-furniture.my-requests')
            ->with('success', 'Custom request submitted successfully!');
    }

    /**
     * තනි Request එකක විස්තර පෙන්වීම
     */
    public function show($id)
    {
        $customRequest = CustomRequest::with(['customer', 'material', 'quotations.workshop'])
            ->findOrFail($id);

        // අයිති කෙනාද කියලා check කරනවා
        if (Auth::user()->role === 'customer' && $customRequest->customer_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('custom-furniture.show', compact('customRequest'));
    }

    /**
     * Cancel කිරීම
     */
    public function cancel($id)
    {
        $customRequest = CustomRequest::findOrFail($id);

        if (Auth::user()->role === 'customer' && $customRequest->customer_id !== Auth::id()) {
            abort(403);
        }

        $customRequest->update(['status' => 'cancelled']);

        return back()->with('success', 'Request cancelled successfully.');
    }
}
