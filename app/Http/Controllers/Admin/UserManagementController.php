<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserManagementController extends Controller
{
    /**
     * Display a listing of users.
     */
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->has('role')) {
            $query->where('role', $request->role);
        }

        if ($request->has('status')) {
            if ($request->status === 'active') {
                $query->whereNull('deleted_at');
            }
        }

        if ($request->has('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        $users = $query->latest()->paginate(20);

        return response()->json($users);
    }

    /**
     * Display the specified user.
     */
    public function show($id)
    {
        $user = User::with([
            'orders',
            'payments',
            'seller',
            'reviews'
        ])->findOrFail($id);

        return response()->json($user);
    }

    /**
     * Create a new user.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|in:customer,seller,designer,workshop,admin',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'phone' => $request->phone,
            'address' => $request->address,
            'email_verified_at' => now(),
        ]);

        return response()->json([
            'message' => 'User created successfully',
            'data' => $user
        ], 201);
    }

    /**
     * Update the specified user.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'email' => 'email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
            'role' => 'in:customer,seller,designer,workshop,admin',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $updateData = $request->except('password');
        
        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        $user->update($updateData);

        return response()->json([
            'message' => 'User updated successfully',
            'data' => $user
        ]);
    }

    /**
     * Suspend a user.
     */
    public function suspend(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'reason' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user->update([
            'is_suspended' => true,
            'suspension_reason' => $request->reason,
            'suspended_at' => now(),
        ]);

        return response()->json([
            'message' => 'User suspended successfully',
            'data' => $user
        ]);
    }

    /**
     * Reactivate a suspended user.
     */
    public function reactivate($id)
    {
        $user = User::findOrFail($id);

        $user->update([
            'is_suspended' => false,
            'suspension_reason' => null,
            'suspended_at' => null,
        ]);

        return response()->json([
            'message' => 'User reactivated successfully',
            'data' => $user
        ]);
    }

    /**
     * Delete a user.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Soft delete
        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }

    /**
     * Get user statistics.
     */
    public function statistics($id)
    {
        $user = User::findOrFail($id);

        $stats = [
            'total_orders' => $user->orders()->count(),
            'completed_orders' => $user->orders()->where('order_status', 'completed')->count(),
            'total_spent' => $user->orders()->where('payment_status', 'paid')->sum('total_amount'),
            'total_payments' => $user->payments()->count(),
            'reviews_given' => $user->reviews()->count(),
        ];

        if ($user->role === 'seller') {
            $stats['seller_stats'] = [
                'total_products' => $user->seller?->products()->count() ?? 0,
                'active_products' => $user->seller?->products()->where('status', 'active')->count() ?? 0,
            ];
        }

        return response()->json($stats);
    }

    /**
     * Bulk actions on users.
     */
    public function bulkAction(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'action' => 'required|in:suspend,reactivate,delete',
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id',
            'reason' => 'required_if:action,suspend|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $users = User::whereIn('id', $request->user_ids)->get();

        foreach ($users as $user) {
            switch ($request->action) {
                case 'suspend':
                    $user->update([
                        'is_suspended' => true,
                        'suspension_reason' => $request->reason,
                        'suspended_at' => now(),
                    ]);
                    break;
                case 'reactivate':
                    $user->update([
                        'is_suspended' => false,
                        'suspension_reason' => null,
                        'suspended_at' => null,
                    ]);
                    break;
                case 'delete':
                    $user->delete();
                    break;
            }
        }

        return response()->json([
            'message' => 'Bulk action completed successfully',
            'affected_users' => $users->count()
        ]);
    }
}
