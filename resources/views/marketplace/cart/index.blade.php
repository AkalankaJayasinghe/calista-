@extends('layouts.app')

@section('title', 'Shopping Cart - CalistaLK')

@section('content')

{{-- Breadcrumb --}}
<x-breadcrumb :items="[['label' => 'Marketplace', 'url' => route('marketplace.index')], ['label' => 'Shopping Cart']]" />

<section class="py-12 bg-white">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-serif font-bold text-gray-900 mb-8">Your Shopping Cart</h1>

        <div class="flex flex-col lg:flex-row gap-12">

            {{-- 1. CART ITEMS LIST (Left Side) --}}
            <div class="w-full lg:w-2/3">
                <div class="bg-white border border-gray-100 rounded-sm shadow-sm overflow-hidden">
                    {{-- Header --}}
                    <div class="hidden md:grid grid-cols-12 gap-4 p-4 bg-gray-50 text-sm font-bold text-gray-700 uppercase tracking-wide border-b border-gray-100">
                        <div class="col-span-6">Product</div>
                        <div class="col-span-2 text-center">Price</div>
                        <div class="col-span-2 text-center">Quantity</div>
                        <div class="col-span-2 text-right">Total</div>
                    </div>

                    {{-- Items Loop (Real Cart Data) --}}
                    @forelse($cart as $id => $details)
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-6 md:gap-4 p-6 border-b border-gray-100 items-center hover:bg-gray-50 transition duration-300">

                        {{-- Product Image & Name --}}
                        <div class="col-span-1 md:col-span-6 flex items-center gap-4">
                            <div class="w-20 h-20 bg-gray-200 flex-shrink-0 overflow-hidden rounded-sm">
                                <img src="{{ asset($details['image'] ?? 'images/placeholder.jpg') }}" alt="{{ $details['name'] }}" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 text-lg font-serif">{{ $details['name'] }}</h3>
                                <p class="text-xs text-gray-500 mb-2">Product ID: {{ $id }}</p>
                                <form action="{{ route('cart.remove', $id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-xs text-red-500 hover:text-red-700 flex items-center gap-1 transition">
                                        <i class="fas fa-trash"></i> Remove
                                    </button>
                                </form>
                            </div>
                        </div>

                        {{-- Price --}}
                        <div class="col-span-1 md:col-span-2 text-left md:text-center">
                            <span class="md:hidden text-xs text-gray-500 font-bold uppercase">Price: </span>
                            <span class="text-gray-700 font-medium">Rs. {{ number_format($details['price'], 2) }}</span>
                        </div>

                        {{-- Quantity --}}
                        <div class="col-span-1 md:col-span-2 flex justify-start md:justify-center">
                            <div class="flex items-center border border-gray-300 rounded-sm">
                                <button class="px-3 py-1 text-gray-600 hover:bg-gray-100 transition">-</button>
                                <input type="text" value="{{ $details['quantity'] }}" class="w-10 text-center text-sm font-bold border-x border-gray-300 focus:outline-none py-1" readonly>
                                <button class="px-3 py-1 text-gray-600 hover:bg-gray-100 transition">+</button>
                            </div>
                        </div>

                        {{-- Total --}}
                        <div class="col-span-1 md:col-span-2 text-left md:text-right">
                            <span class="md:hidden text-xs text-gray-500 font-bold uppercase">Total: </span>
                            <span class="text-amber-600 font-bold text-lg">Rs. {{ number_format($details['price'] * $details['quantity'], 2) }}</span>
                        </div>
                    </div>
                    @empty
                    <div class="p-12 text-center">
                        <i class="fas fa-shopping-cart text-6xl text-gray-300 mb-4"></i>
                        <p class="text-gray-500 text-lg">Your cart is empty</p>
                        <a href="{{ route('marketplace.index') }}" class="inline-block mt-4 bg-amber-600 text-white px-6 py-2 rounded-sm hover:bg-amber-700 transition">
                            Start Shopping
                        </a>
                    </div>
                    @endforelse
                </div>

                <div class="mt-6 flex justify-between items-center">
                    <a href="{{ route('marketplace.index') }}" class="text-gray-600 hover:text-amber-600 transition flex items-center gap-2 text-sm font-medium">
                        <i class="fas fa-arrow-left"></i> Continue Shopping
                    </a>
                </div>
            </div>

            {{-- 2. ORDER SUMMARY (Right Side) --}}
            <div class="w-full lg:w-1/3">
                <div class="bg-gray-50 border border-gray-100 p-8 rounded-sm sticky top-24">
                    <h3 class="text-xl font-serif font-bold text-gray-900 mb-6 border-b border-gray-200 pb-4">Order Summary</h3>

                    <div class="space-y-4 mb-6 text-sm text-gray-600">
                        <div class="flex justify-between">
                            <span>Subtotal ({{ count($cart) }} items)</span>
                            <span class="font-bold text-gray-900">Rs. {{ number_format($total, 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Shipping</span>
                            <span class="text-green-600 font-bold">Free</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Tax (Estimated)</span>
                            <span>Rs. 0</span>
                        </div>
                    </div>

                    {{-- Coupon Code --}}
                    <div class="mb-6">
                        <div class="flex gap-2">
                            <input type="text" placeholder="Coupon Code" class="flex-1 border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-amber-500 rounded-sm">
                            <button class="bg-gray-800 text-white px-4 py-2 text-xs font-bold uppercase tracking-wide hover:bg-gray-700 transition rounded-sm">Apply</button>
                        </div>
                    </div>

                    <div class="flex justify-between items-center border-t border-gray-200 pt-4 mb-8">
                        <span class="text-lg font-bold text-gray-900">Total</span>
                        <span class="text-2xl font-bold text-amber-600">Rs. {{ number_format($total, 2) }}</span>
                    </div>

                    <a href="{{ route('checkout.index') }}" class="block w-full bg-amber-600 text-white text-center py-4 rounded-sm font-bold uppercase tracking-widest hover:bg-amber-700 transition shadow-lg hover:shadow-amber-500/30">
                        Proceed to Checkout
                    </a>

                    <div class="mt-6 flex justify-center gap-3 text-gray-400 text-2xl">
                        <i class="fab fa-cc-visa hover:text-blue-600 transition"></i>
                        <i class="fab fa-cc-mastercard hover:text-red-600 transition"></i>
                        <i class="fab fa-cc-amex hover:text-blue-400 transition"></i>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
