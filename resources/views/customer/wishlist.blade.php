@extends('layouts.app')

@section('title', 'My Wishlist')

@section('content')
<x-breadcrumb :items="[
    ['label' => 'My Wishlist']
]" />

<section class="py-8">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold mb-8">My Wishlist</h1>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            @for($i = 1; $i <= 8; $i++)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition group relative">
                <button class="absolute top-4 right-4 bg-red-500 text-white rounded-full p-2 hover:bg-red-600 transition z-10">
                    <i class="fas fa-heart"></i>
                </button>
                <div class="relative">
                    <img src="https://via.placeholder.com/300x300/EAB308/FFFFFF?text=Wishlist+{{ $i }}" alt="Product {{ $i }}" class="w-full h-64 object-cover">
                </div>
                <div class="p-4">
                    <h3 class="font-semibold text-gray-800 mb-2">Wishlist Item {{ $i }}</h3>
                    <p class="text-yellow-600 font-bold mb-3">Rs. {{ number_format(80000 + ($i * 5000)) }}</p>
                    <button class="w-full bg-yellow-600 hover:bg-yellow-700 text-white py-2 rounded-lg transition">
                        Add to Cart
                    </button>
                </div>
            </div>
            @endfor
        </div>
    </div>
</section>
@endsection
