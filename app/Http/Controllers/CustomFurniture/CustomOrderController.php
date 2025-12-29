<?php

namespace App\Http\Controllers\CustomFurniture;

use App\Http\Controllers\Controller;
use App\Models\CustomFurniture\CustomOrder;
use App\Models\CustomFurniture\CustomQuotation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomOrderController extends Controller
{
    // Orders List එක
    public function index()
    {
        $user = Auth::user();
        
        $query = CustomOrder::with(['quotation.customRequest', 'quotation.workshop'])
            ->latest();

        if ($user->role === 'customer') {
            $query->where('customer_id', $user->id);
        } elseif ($user->role === 'workshop') {
            $query->whereHas('quotation', function ($q) use ($user) {
                $q->where('workshop_id', $user->id);
            });
        }

        $orders = $query->paginate(10);
        return view('custom-furniture.orders.index', compact('orders'));
    }

    // Order Create කරන Form එක (Checkout වගේ පිටුවක්)
    public function create(Request $request)
    {
        $quotationId = $request->get('quotation_id');
        $quotation = CustomQuotation::with('customRequest')->findOrFail($quotationId);

        if ($quotation->status !== 'accepted') {
            return back()->with('error', 'You must accept the quotation first.');
        }

        return view('custom-furniture.orders.create', compact('quotation'));
    }

    // Order එක Store කිරීම
    public function store(Request $request)
    {
        $request->validate([
            'quotation_id' => 'required|exists:custom_quotations,id',
            'delivery_address' => 'required|string',
            'payment_method' => 'required|in:cash,card,bank_transfer',
        ]);

        $quotation = CustomQuotation::findOrFail($request->quotation_id);

        $order = CustomOrder::create([
            'quotation_id' => $request->quotation_id,
            'customer_id' => Auth::id(),
            'order_number' => 'CFO-' . strtoupper(uniqid()),
            'total_amount' => $quotation->estimated_price,
            'delivery_address' => $request->delivery_address,
            'delivery_notes' => $request->delivery_notes,
            'payment_method' => $request->payment_method,
            'status' => 'pending',
            'payment_status' => 'pending',
        ]);

        // Request status update
        $quotation->customRequest->update(['status' => 'in_progress']);

        return redirect()->route('custom-furniture.orders.show', $order->id)
            ->with('success', 'Order created successfully!');
    }

    // Order Detail Page
    public function show($id)
    {
        $order = CustomOrder::with(['quotation.customRequest', 'quotation.workshop', 'customer'])
            ->findOrFail($id);

        // Security Check
        if (Auth::user()->role === 'customer' && $order->customer_id !== Auth::id()) {
            abort(403);
        }

        return view('custom-furniture.orders.show', compact('order'));
    }

    // Order Status Update (Workshop එකට විතරයි)
    public function updateStatus(Request $request, $id)
    {
        $order = CustomOrder::findOrFail($id);
        
        // Workshop Check here...

        $order->update([
            'status' => $request->status,
            'progress_notes' => $request->progress_notes
        ]);

        return back()->with('success', 'Order status updated.');
    }
}