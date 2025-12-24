@extends('layouts.app')

@section('title', 'Checkout - CalistaLK')

@section('content')

<x-breadcrumb :items="[
    ['label' => 'Marketplace', 'url' => route('marketplace.index')],
    ['label' => 'Cart', 'url' => route('cart.index')],
    ['label' => 'Checkout']
]" />

<section class="py-12 bg-white">
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row gap-12">

            {{-- 1. BILLING DETAILS FORM --}}
            <div class="w-full lg:w-2/3">
                <h2 class="text-2xl font-serif font-bold text-gray-900 mb-6 flex items-center gap-3">
                    <span class="w-8 h-8 bg-gray-900 text-white rounded-full flex items-center justify-center text-sm">1</span>
                    Billing & Shipping
                </h2>

                <form action="{{ route('checkout.process') }}" method="POST" id="checkout-form">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-gray-700">First Name <span class="text-red-500">*</span></label>
                            <input type="text" name="first_name" class="w-full border border-gray-300 px-4 py-3 rounded-sm focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 transition">
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-gray-700">Last Name <span class="text-red-500">*</span></label>
                            <input type="text" name="last_name" class="w-full border border-gray-300 px-4 py-3 rounded-sm focus:outline-none focus:border-amber-500 transition">
                        </div>
                        <div class="space-y-2 md:col-span-2">
                            <label class="text-sm font-bold text-gray-700">Street Address <span class="text-red-500">*</span></label>
                            <input type="text" name="address" placeholder="House number and street name" class="w-full border border-gray-300 px-4 py-3 rounded-sm focus:outline-none focus:border-amber-500 transition mb-3">
                            <input type="text" name="apartment" placeholder="Apartment, suite, unit, etc. (optional)" class="w-full border border-gray-300 px-4 py-3 rounded-sm focus:outline-none focus:border-amber-500 transition">
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-gray-700">Town / City <span class="text-red-500">*</span></label>
                            <input type="text" name="city" class="w-full border border-gray-300 px-4 py-3 rounded-sm focus:outline-none focus:border-amber-500 transition">
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-gray-700">Postcode / ZIP <span class="text-red-500">*</span></label>
                            <input type="text" name="zip" class="w-full border border-gray-300 px-4 py-3 rounded-sm focus:outline-none focus:border-amber-500 transition">
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-gray-700">Phone <span class="text-red-500">*</span></label>
                            <input type="tel" name="phone" class="w-full border border-gray-300 px-4 py-3 rounded-sm focus:outline-none focus:border-amber-500 transition">
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-gray-700">Email Address <span class="text-red-500">*</span></label>
                            <input type="email" name="email" class="w-full border border-gray-300 px-4 py-3 rounded-sm focus:outline-none focus:border-amber-500 transition">
                        </div>
                    </div>

                    <h2 class="text-2xl font-serif font-bold text-gray-900 mb-6 flex items-center gap-3 mt-12">
                        <span class="w-8 h-8 bg-gray-900 text-white rounded-full flex items-center justify-center text-sm">2</span>
                        Payment Method
                    </h2>

                    <div class="space-y-4 bg-gray-50 p-6 rounded-sm border border-gray-200">
                        {{-- Card Payment --}}
                        <label class="flex items-start cursor-pointer">
                            <input type="radio" name="payment_method" value="card" checked class="mt-1 text-amber-600 focus:ring-amber-500">
                            <div class="ml-4">
                                <span class="block font-bold text-gray-800">Credit / Debit Card</span>
                                <p class="text-sm text-gray-500 mt-1">Pay securely with your credit card via our payment gateway.</p>
                                <div class="mt-2 flex gap-2 text-2xl text-gray-400">
                                    <i class="fab fa-cc-visa"></i>
                                    <i class="fab fa-cc-mastercard"></i>
                                </div>
                            </div>
                        </label>

                        <hr class="border-gray-200">

                        {{-- COD --}}
                        <label class="flex items-start cursor-pointer">
                            <input type="radio" name="payment_method" value="cod" class="mt-1 text-amber-600 focus:ring-amber-500">
                            <div class="ml-4">
                                <span class="block font-bold text-gray-800">Cash on Delivery</span>
                                <p class="text-sm text-gray-500 mt-1">Pay with cash upon delivery.</p>
                            </div>
                        </label>
                    </div>

                </form>
            </div>

            {{-- 2. ORDER REVIEW (Right Side) --}}
            <div class="w-full lg:w-1/3">
                <div class="bg-white border-2 border-amber-500 p-8 rounded-sm shadow-xl sticky top-24">
                    <h3 class="text-xl font-serif font-bold text-gray-900 mb-6 text-center">Your Order</h3>

                    <div class="space-y-4 mb-6 max-h-60 overflow-y-auto pr-2 custom-scrollbar">
                        {{-- Item 1 --}}
                        <div class="flex justify-between items-center text-sm">
                            <div class="flex items-center gap-3">
                                <div class="relative">
                                    <img src="https://images.unsplash.com/photo-1555041469-a586c61ea9bc?q=80&w=100" class="w-10 h-10 object-cover rounded-sm">
                                    <span class="absolute -top-2 -right-2 bg-gray-500 text-white text-[10px] w-4 h-4 rounded-full flex items-center justify-center">1</span>
                                </div>
                                <span class="text-gray-700">Velvet Sofa</span>
                            </div>
                            <span class="font-medium">Rs. 85,000</span>
                        </div>
                        {{-- Item 2 --}}
                        <div class="flex justify-between items-center text-sm">
                            <div class="flex items-center gap-3">
                                <div class="relative">
                                    <img src="https://images.unsplash.com/photo-1505693314120-0d443867891c?q=80&w=100" class="w-10 h-10 object-cover rounded-sm">
                                    <span class="absolute -top-2 -right-2 bg-gray-500 text-white text-[10px] w-4 h-4 rounded-full flex items-center justify-center">2</span>
                                </div>
                                <span class="text-gray-700">Bed Frame</span>
                            </div>
                            <span class="font-medium">Rs. 170,000</span>
                        </div>
                    </div>

                    <div class="border-t border-gray-100 pt-4 space-y-3 text-sm text-gray-600">
                        <div class="flex justify-between">
                            <span>Subtotal</span>
                            <span class="font-bold text-gray-900">Rs. 255,000</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Shipping</span>
                            <span class="text-green-600 font-bold">Free</span>
                        </div>
                    </div>

                    <div class="border-t border-gray-200 pt-6 mt-6">
                        <div class="flex justify-between items-center mb-6">
                            <span class="text-lg font-bold text-gray-900">Total</span>
                            <span class="text-2xl font-bold text-amber-600">Rs. 255,000</span>
                        </div>

                        <button form="checkout-form" type="submit" class="w-full bg-gray-900 hover:bg-amber-600 text-white py-4 rounded-sm font-bold uppercase tracking-widest transition duration-300">
                            Place Order
                        </button>

                        <p class="text-xs text-gray-400 text-center mt-4">
                            <i class="fas fa-lock mr-1"></i> Your data is processed securely.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection
