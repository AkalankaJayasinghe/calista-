<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\Payment\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of payment methods.
     */
    public function index()
    {
        $paymentMethods = PaymentMethod::where('is_active', true)
            ->orderBy('name')
            ->get();

        return response()->json($paymentMethods);
    }

    /**
     * Display all payment methods (including inactive) - Admin only.
     */
    public function all()
    {
        $paymentMethods = PaymentMethod::orderBy('name')->get();

        return response()->json($paymentMethods);
    }

    /**
     * Store a newly created payment method.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100|unique:payment_methods,name',
            'type' => 'required|in:card,bank_transfer,cash,digital_wallet,installment',
            'description' => 'nullable|string',
            'icon' => 'nullable|string',
            'processing_fee_percentage' => 'nullable|numeric|min:0|max:100',
            'processing_fee_fixed' => 'nullable|numeric|min:0',
            'min_amount' => 'nullable|numeric|min:0',
            'max_amount' => 'nullable|numeric|min:0',
            'config' => 'nullable|json',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $paymentMethod = PaymentMethod::create($request->all());

        return response()->json([
            'message' => 'Payment method created successfully',
            'data' => $paymentMethod
        ], 201);
    }

    /**
     * Display the specified payment method.
     */
    public function show($id)
    {
        $paymentMethod = PaymentMethod::findOrFail($id);

        return response()->json($paymentMethod);
    }

    /**
     * Update the specified payment method.
     */
    public function update(Request $request, $id)
    {
        $paymentMethod = PaymentMethod::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'string|max:100|unique:payment_methods,name,' . $id,
            'type' => 'in:card,bank_transfer,cash,digital_wallet,installment',
            'description' => 'nullable|string',
            'icon' => 'nullable|string',
            'processing_fee_percentage' => 'nullable|numeric|min:0|max:100',
            'processing_fee_fixed' => 'nullable|numeric|min:0',
            'min_amount' => 'nullable|numeric|min:0',
            'max_amount' => 'nullable|numeric|min:0',
            'config' => 'nullable|json',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $paymentMethod->update($request->all());

        return response()->json([
            'message' => 'Payment method updated successfully',
            'data' => $paymentMethod
        ]);
    }

    /**
     * Remove the specified payment method.
     */
    public function destroy($id)
    {
        $paymentMethod = PaymentMethod::findOrFail($id);

        // Check if payment method is used in any payments
        if ($paymentMethod->payments()->count() > 0) {
            return response()->json([
                'error' => 'Cannot delete payment method that has been used'
            ], 400);
        }

        $paymentMethod->delete();

        return response()->json(['message' => 'Payment method deleted successfully']);
    }

    /**
     * Toggle active status.
     */
    public function toggleActive($id)
    {
        $paymentMethod = PaymentMethod::findOrFail($id);

        $paymentMethod->update(['is_active' => !$paymentMethod->is_active]);

        return response()->json([
            'message' => 'Payment method status updated',
            'data' => $paymentMethod
        ]);
    }

    /**
     * Calculate processing fee for amount.
     */
    public function calculateFee(Request $request, $id)
    {
        $paymentMethod = PaymentMethod::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $amount = $request->amount;
        $fee = 0;

        if ($paymentMethod->processing_fee_percentage) {
            $fee += ($amount * $paymentMethod->processing_fee_percentage / 100);
        }

        if ($paymentMethod->processing_fee_fixed) {
            $fee += $paymentMethod->processing_fee_fixed;
        }

        return response()->json([
            'amount' => $amount,
            'fee' => round($fee, 2),
            'total' => round($amount + $fee, 2),
        ]);
    }

    /**
     * Get payment methods by type.
     */
    public function getByType($type)
    {
        $paymentMethods = PaymentMethod::where('type', $type)
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return response()->json($paymentMethods);
    }
}
