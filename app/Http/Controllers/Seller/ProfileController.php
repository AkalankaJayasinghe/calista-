<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Seller\Seller;
use App\Models\Seller\SellerProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'seller']);
    }

    /**
     * Display seller profile
     */
    public function index()
    {
        $seller = Auth::user()->seller->load('profile');
        return view('seller.profile.index', compact('seller'));
    }

    /**
     * Show edit profile form
     */
    public function edit()
    {
        $seller = Auth::user()->seller->load('profile');
        return view('seller.profile.edit', compact('seller'));
    }

    /**
     * Update seller profile
     */
    public function update(Request $request)
    {
        $seller = Auth::user()->seller;

        $request->validate([
            'business_name' => 'required|string|max:255',
            'business_type' => 'required|string',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only([
            'business_name',
            'business_type',
            'phone',
            'email',
            'website',
            'description',
        ]);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            if ($seller->logo) {
                Storage::disk('public')->delete($seller->logo);
            }
            $data['logo'] = $request->file('logo')->store('sellers/logos', 'public');
        }

        // Handle banner upload
        if ($request->hasFile('banner')) {
            if ($seller->banner) {
                Storage::disk('public')->delete($seller->banner);
            }
            $data['banner'] = $request->file('banner')->store('sellers/banners', 'public');
        }

        $seller->update($data);

        // Update or create profile
        $profileData = $request->only([
            'address_line_1',
            'address_line_2',
            'city',
            'state',
            'postal_code',
            'country',
            'about_us',
            'return_policy',
            'terms_and_conditions',
            'social_facebook',
            'social_instagram',
            'social_twitter',
            'social_linkedin',
        ]);

        $seller->profile()->updateOrCreate(
            ['seller_id' => $seller->id],
            $profileData
        );

        return redirect()->route('seller.profile.index')
            ->with('success', 'Profile updated successfully!');
    }

    /**
     * Update bank details
     */
    public function updateBankDetails(Request $request)
    {
        $request->validate([
            'bank_name' => 'required|string|max:255',
            'bank_account_name' => 'required|string|max:255',
            'bank_account_number' => 'required|string|max:50',
            'bank_branch' => 'nullable|string|max:255',
        ]);

        $seller = Auth::user()->seller;

        $seller->profile()->updateOrCreate(
            ['seller_id' => $seller->id],
            $request->only([
                'bank_name',
                'bank_account_name',
                'bank_account_number',
                'bank_branch',
            ])
        );

        return response()->json([
            'success' => true,
            'message' => 'Bank details updated successfully!'
        ]);
    }
}
