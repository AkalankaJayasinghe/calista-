@extends('layouts.app')

@section('title', 'Design Portfolio')

@section('content')
<x-breadcrumb :items="[
    ['label' => 'Interior Design', 'url' => route('interior-design.index')],
    ['label' => 'Portfolio']
]" />

<section class="py-8">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold mb-8">Our Design Portfolio</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @for($i = 1; $i <= 12; $i++)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden group">
                <div class="relative overflow-hidden h-64">
                    <img src="https://via.placeholder.com/400x300/EAB308/FFFFFF?text=Portfolio+{{ $i }}"
                         alt="Project {{ $i }}"
                         class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-50 transition flex items-center justify-center">
                        <button class="bg-white text-gray-900 px-6 py-2 rounded-full opacity-0 group-hover:opacity-100 transition">
                            View Project
                        </button>
                    </div>
                </div>
                <div class="p-4">
                    <h3 class="font-semibold text-lg mb-1">{{ ['Modern Living Room', 'Luxury Bedroom', 'Contemporary Kitchen', 'Office Space'][$i % 4] }}</h3>
                    <p class="text-gray-600 text-sm mb-2">{{ ['Residential', 'Commercial'][$i % 2] }} Project - Colombo</p>
                    <div class="flex items-center text-sm text-gray-500">
                        <i class="fas fa-user-circle mr-2 text-yellow-600"></i>
                        Designer {{ ($i % 4) + 1 }}
                    </div>
                </div>
            </div>
            @endfor
        </div>
    </div>
</section>
@endsection
