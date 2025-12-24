@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
<x-breadcrumb :items="[
    ['label' => 'Dashboard', 'url' => route('customer.dashboard')],
    ['label' => 'My Profile']
]" />

<section class="py-8">
    <div class="container mx-auto px-4 max-w-4xl">
        <h1 class="text-3xl font-bold mb-8">My Profile</h1>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-lg p-6 text-center">
                    <div class="w-32 h-32 bg-yellow-600 rounded-full flex items-center justify-center text-white text-5xl font-bold mx-auto mb-4">
                        JD
                    </div>
                    <h3 class="text-xl font-semibold">John Doe</h3>
                    <p class="text-gray-600">john.doe@example.com</p>
                    <button class="mt-4 px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-lg transition">
                        Change Photo
                    </button>
                </div>
            </div>

            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h2 class="text-xl font-semibold mb-6">Personal Information</h2>
                    <form class="space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium mb-2">First Name</label>
                                <input type="text" value="John" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-2">Last Name</label>
                                <input type="text" value="Doe" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Email</label>
                            <input type="email" value="john.doe@example.com" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Phone</label>
                            <input type="tel" value="+94 77 123 4567" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Address</label>
                            <textarea rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-2">123 Main Street, Colombo 03</textarea>
                        </div>

                        <button type="submit" class="px-6 py-2 bg-yellow-600 hover:bg-yellow-700 text-white rounded-lg transition">
                            Save Changes
                        </button>
                    </form>
                </div>

                <div class="bg-white rounded-lg shadow-lg p-6 mt-6">
                    <h2 class="text-xl font-semibold mb-6">Change Password</h2>
                    <form class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium mb-2">Current Password</label>
                            <input type="password" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">New Password</label>
                            <input type="password" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Confirm New Password</label>
                            <input type="password" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                        </div>

                        <button type="submit" class="px-6 py-2 bg-yellow-600 hover:bg-yellow-700 text-white rounded-lg transition">
                            Update Password
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
