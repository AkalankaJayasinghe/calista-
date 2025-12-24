@extends('layouts.app')

@section('title', 'My Orders')

@section('content')
<x-breadcrumb :items="[
    ['label' => 'Dashboard', 'url' => route('customer.dashboard')],
    ['label' => 'My Orders']
]" />

<section class="py-8">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold mb-8">My Orders</h1>

        <div class="space-y-4">
            @for($i = 1; $i <= 5; $i++)
            <div class="bg-white rounded-lg shadow-lg p-6">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h3 class="text-xl font-semibold">Order #{{ 10000 + $i }}</h3>
                        <p class="text-gray-600 text-sm">Placed on Nov {{ 10 + $i }}, 2025</p>
                    </div>
                    <span class="bg-{{ ['green', 'blue', 'yellow'][$i % 3] }}-100 text-{{ ['green', 'blue', 'yellow'][$i % 3] }}-800 px-3 py-1 rounded-full text-sm font-semibold">
                        {{ ['Delivered', 'Processing', 'Shipped'][$i % 3] }}
                    </span>
                </div>

                <div class="space-y-3 border-t pt-4">
                    @for($j = 1; $j <= 2; $j++)
                    <div class="flex items-center space-x-4">
                        <img src="https://via.placeholder.com/80x80/EAB308/FFFFFF?text=Item+{{ $j }}" class="w-20 h-20 rounded">
                        <div class="flex-1">
                            <h4 class="font-semibold">Product Item {{ $j }}</h4>
                            <p class="text-gray-600 text-sm">Qty: 1</p>
                        </div>
                        <span class="font-semibold">Rs. {{ number_format(30000 * $j) }}</span>
                    </div>
                    @endfor
                </div>

                <div class="flex justify-between items-center border-t mt-4 pt-4">
                    <span class="font-bold text-lg">Total: Rs. {{ number_format(90000) }}</span>
                    <div class="space-x-2">
                        <button class="px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white rounded-lg transition">
                            View Details
                        </button>
                        @if($i % 3 === 0)
                        <button class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg transition">
                            Track Order
                        </button>
                        @endif
                    </div>
                </div>
            </div>
            @endfor
        </div>
    </div>
</section>
@endsection
