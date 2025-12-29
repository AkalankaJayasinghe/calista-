@extends('layouts.app')

@section('title', 'Inspiration Gallery - Calista Custom Furniture')

@section('content')

<div class="relative bg-gray-900 py-20 px-6 text-center overflow-hidden">
    <div class="absolute inset-0 opacity-40">
        <img src="https://images.unsplash.com/photo-1618219908412-a29a1bb7b86e?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80" class="w-full h-full object-cover">
    </div>
    <div class="absolute inset-0 bg-gradient-to-b from-gray-900/0 via-gray-900/60 to-gray-900"></div>

    <div class="relative z-10 max-w-3xl mx-auto">
        <span class="text-yellow-500 font-bold tracking-widest uppercase text-sm mb-4 block">Our Portfolio</span>
        <h1 class="text-4xl md:text-5xl font-serif font-bold text-white mb-6">Masterpieces Crafted for You</h1>
        <p class="text-gray-300 text-lg">Explore a collection of custom-designed furniture brought to life by our expert craftsmen. Find inspiration for your next project.</p>
    </div>
</div>

<section class="py-16 bg-white">
    <div class="container mx-auto px-4">

        <div class="flex flex-wrap justify-center gap-4 mb-12">
            <button class="px-6 py-2 rounded-full bg-yellow-600 text-white font-semibold shadow-lg">All Projects</button>
            <button class="px-6 py-2 rounded-full bg-gray-100 text-gray-600 hover:bg-gray-200 transition font-medium">Living Room</button>
            <button class="px-6 py-2 rounded-full bg-gray-100 text-gray-600 hover:bg-gray-200 transition font-medium">Bedroom</button>
            <button class="px-6 py-2 rounded-full bg-gray-100 text-gray-600 hover:bg-gray-200 transition font-medium">Office</button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            <div class="group relative overflow-hidden rounded-2xl shadow-lg cursor-pointer">
                <img src="https://images.unsplash.com/photo-1556228453-efd6c1ff04f6?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                     class="w-full h-80 object-cover transform group-hover:scale-110 transition duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex flex-col justify-end p-6">
                    <h3 class="text-white text-xl font-bold">Modern Velvet Sofa</h3>
                    <p class="text-yellow-400 text-sm">Living Room Collection</p>
                </div>
            </div>

            <div class="group relative overflow-hidden rounded-2xl shadow-lg cursor-pointer">
                <img src="https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                     class="w-full h-80 object-cover transform group-hover:scale-110 transition duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex flex-col justify-end p-6">
                    <h3 class="text-white text-xl font-bold">Minimalist King Bed</h3>
                    <p class="text-yellow-400 text-sm">Bedroom Suite</p>
                </div>
            </div>

            <div class="group relative overflow-hidden rounded-2xl shadow-lg cursor-pointer">
                <img src="https://images.unsplash.com/photo-1595428774223-ef52624120d2?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                     class="w-full h-80 object-cover transform group-hover:scale-110 transition duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex flex-col justify-end p-6">
                    <h3 class="text-white text-xl font-bold">Custom Kitchen Pantry</h3>
                    <p class="text-yellow-400 text-sm">Kitchen & Dining</p>
                </div>
            </div>

            <div class="group relative overflow-hidden rounded-2xl shadow-lg cursor-pointer">
                <img src="https://images.unsplash.com/photo-1518455027359-f3f8164ba6bd?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                     class="w-full h-80 object-cover transform group-hover:scale-110 transition duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex flex-col justify-end p-6">
                    <h3 class="text-white text-xl font-bold">Teak Wardrobe</h3>
                    <p class="text-yellow-400 text-sm">Storage Solutions</p>
                </div>
            </div>

            <div class="group relative overflow-hidden rounded-2xl shadow-lg cursor-pointer">
                <img src="https://images.unsplash.com/photo-1538688525198-9b88f6f53126?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                     class="w-full h-80 object-cover transform group-hover:scale-110 transition duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex flex-col justify-end p-6">
                    <h3 class="text-white text-xl font-bold">Executive Office Desk</h3>
                    <p class="text-yellow-400 text-sm">Office Furniture</p>
                </div>
            </div>

            <div class="group relative overflow-hidden rounded-2xl shadow-lg cursor-pointer">
                <img src="https://images.unsplash.com/photo-1615873968403-89e068629265?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                     class="w-full h-80 object-cover transform group-hover:scale-110 transition duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex flex-col justify-end p-6">
                    <h3 class="text-white text-xl font-bold">Luxury Dining Set</h3>
                    <p class="text-yellow-400 text-sm">Dining Room</p>
                </div>
            </div>

        </div>

        <div class="mt-20 text-center bg-gray-50 rounded-3xl p-10 border border-gray-100">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Inspired by what you see?</h2>
            <p class="text-gray-600 mb-8 max-w-2xl mx-auto">Don't just dream about it. Let our craftsmen build exactly what you have in mind.</p>
            <a href="{{ route('custom-furniture.request') }}" class="inline-block px-8 py-4 bg-yellow-600 hover:bg-yellow-700 text-white font-bold rounded-full shadow-xl transition transform hover:scale-105">
                Create My Custom Piece
            </a>
        </div>

    </div>
</section>

@endsection
