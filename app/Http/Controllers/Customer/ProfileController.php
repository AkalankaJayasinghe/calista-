<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /**
     * Get customer profile.
     */
    public function show()
    {
        $user = Auth::user();

        return response()->json($user);
    }

    /**
     * Update customer profile.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:100',
            'profile_picture' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user->update($request->all());

        return response()->json([
            'message' => 'Profile updated successfully',
            'data' => $user
        ]);
    }

    /**
     * Change password.
     */
    public function changePassword(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Verify current password
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json(['error' => 'Current password is incorrect'], 400);
        }

        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        return response()->json(['message' => 'Password changed successfully']);
    }

    /**
     * Update email.
     */
    public function updateEmail(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Verify password
        if (!Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'Password is incorrect'], 400);
        }

        $user->update([
            'email' => $request->email,
            'email_verified_at' => null, // Reset email verification
        ]);

        return response()->json([
            'message' => 'Email updated successfully. Please verify your new email.',
            'data' => $user
        ]);
    }

    /**
     * Delete account.
     */
    public function deleteAccount(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'password' => 'required|string',
            'confirmation' => 'required|in:DELETE',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Verify password
        if (!Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'Password is incorrect'], 400);
        }

        // Soft delete user
        $user->delete();

        return response()->json(['message' => 'Account deleted successfully']);
    }

    /**
     * Get profile completion percentage.
     */
    public function completionStatus()
    {
        $user = Auth::user();

        $fields = [
            'name' => !empty($user->name),
            'email' => !empty($user->email),
            'phone' => !empty($user->phone),
            'address' => !empty($user->address),
            'city' => !empty($user->city),
            'state' => !empty($user->state),
            'postal_code' => !empty($user->postal_code),
            'profile_picture' => !empty($user->profile_picture),
        ];

        $completed = count(array_filter($fields));
        $total = count($fields);
        $percentage = ($completed / $total) * 100;

        return response()->json([
            'completion_percentage' => round($percentage, 2),
            'completed_fields' => $completed,
            'total_fields' => $total,
            'missing_fields' => array_keys(array_filter($fields, function ($value) {
                return !$value;
            })),
        ]);
    }

    /**
     * Get account preferences.
     */
    public function getPreferences()
    {
        $user = Auth::user();

        $preferences = [
            'email_notifications' => $user->email_notifications ?? true,
            'sms_notifications' => $user->sms_notifications ?? false,
            'newsletter_subscription' => $user->newsletter_subscription ?? false,
            'language' => $user->preferred_language ?? 'en',
            'currency' => $user->preferred_currency ?? 'USD',
        ];

        return response()->json($preferences);
    }

    /**
     * Update account preferences.
     */
    public function updatePreferences(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'email_notifications' => 'boolean',
            'sms_notifications' => 'boolean',
            'newsletter_subscription' => 'boolean',
            'preferred_language' => 'string|max:5',
            'preferred_currency' => 'string|size:3',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user->update($request->all());

        return response()->json([
            'message' => 'Preferences updated successfully',
            'data' => $user
        ]);
    }
}
