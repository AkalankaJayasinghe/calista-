@extends('layouts.app')

@section('title', 'My Dashboard')

@section('content')
<section class="py-8 bg-gray-50">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold mb-8">My Dashboard</h1>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm">Total Orders</p>
                        <h3 class="text-3xl font-bold text-yellow-600">12</h3>
                    </div>
                    <i class="fas fa-shopping-bag text-4xl text-yellow-600"></i>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm">Wishlist Items</p>
                        <h3 class="text-3xl font-bold text-yellow-600">8</h3>
                    </div>
                    <i class="fas fa-heart text-4xl text-yellow-600"></i>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm">Custom Requests</p>
                        <h3 class="text-3xl font-bold text-yellow-600">3</h3>
                    </div>
                    <i class="fas fa-tools text-4xl text-yellow-600"></i>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm">Design Projects</p>
                        <h3 class="text-3xl font-bold text-yellow-600">2</h3>
                    </div>
                    <i class="fas fa-paint-roller text-4xl text-yellow-600"></i>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h2 class="text-xl font-semibold mb-4">Recent Orders</h2>
                    <div class="space-y-4">
                        @for($i = 1; $i <= 3; $i++)
                        <div class="flex items-center justify-between border-b pb-4">
                            <div class="flex items-center space-x-4">
                                <img src="https://via.placeholder.com/60x60/EAB308/FFFFFF" class="w-16 h-16 rounded">
                                <div>
                                    <h4 class="font-semibold">Order #{{ 10000 + $i }}</h4>
                                    <p class="text-gray-600 text-sm">Nov {{ 15 + $i }}, 2025</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-bold">Rs. {{ number_format(50000 * $i) }}</p>
                                <span class="text-green-600 text-sm">Delivered</span>
                            </div>
                        </div>
                        @endfor
                    </div>
                    <a href="{{ route('customer.orders') }}" class="block text-center mt-4 text-yellow-600 hover:underline">
                        View All Orders →
                    </a>
                </div>
            </div>

            <div>
                <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                    <h2 class="text-xl font-semibold mb-4">Quick Links</h2>
                    <div class="space-y-3">
                        <a href="{{ route('customer.orders') }}" class="flex items-center text-gray-700 hover:text-yellow-600">
                            <i class="fas fa-shopping-bag w-6"></i>
                            <span>My Orders</span>
                        </a>
                        <a href="{{ route('wishlist.index') }}" class="flex items-center text-gray-700 hover:text-yellow-600">
                            <i class="fas fa-heart w-6"></i>
                            <span>Wishlist</span>
                        </a>
                        <a href="{{ route('customer.profile') }}" class="flex items-center text-gray-700 hover:text-yellow-600">
                            <i class="fas fa-user w-6"></i>
                            <span>My Profile</span>
                        </a>
                        <a href="{{ route('custom-furniture.my-requests') }}" class="flex items-center text-gray-700 hover:text-yellow-600">
                            <i class="fas fa-tools w-6"></i>
                            <span>Custom Requests</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
