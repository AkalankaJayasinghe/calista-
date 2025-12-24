@extends('layouts.app')

@section('title', 'Interior Design Services')

@section('content')
<x-breadcrumb :items="[
    ['label' => 'Interior Design']
]" />

<!-- Hero Section -->
<section class="relative h-[500px] bg-gradient-to-r from-gray-800 to-gray-600">
    <div class="absolute inset-0 bg-black bg-opacity-50"></div>
    <div class="relative container mx-auto px-4 h-full flex items-center">
        <div class="text-white max-w-2xl">
            <h1 class="text-5xl font-bold mb-4">Transform Your Space with Expert Design</h1>
            <p class="text-xl mb-8">Professional interior design consultation and project management services</p>
            <a href="{{ route('interior-design.consultation') }}" class="bg-yellow-600 hover:bg-yellow-700 text-white px-8 py-3 rounded-full font-semibold transition inline-block">
                Book Consultation
            </a>
        </div>
    </div>
</section>

<!-- Services -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12">Our Services</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white border-2 border-gray-200 rounded-lg p-6 hover:border-yellow-600 hover:shadow-xl transition">
                <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-comments text-3xl text-yellow-600"></i>
                </div>
                <h3 class="text-xl font-semibold text-center mb-3">Design Consultation</h3>
                <p class="text-gray-600 text-center mb-4">One-on-one consultation with experienced designers to discuss your vision and requirements</p>
                <div class="text-center">
                    <span class="text-2xl font-bold text-yellow-600">Rs. 15,000</span>
                    <p class="text-gray-500 text-sm">per session</p>
                </div>
            </div>

            <div class="bg-white border-2 border-yellow-600 rounded-lg p-6 hover:shadow-xl transition relative">
                <div class="absolute top-0 right-0 bg-yellow-600 text-white px-3 py-1 rounded-bl-lg text-sm">
                    Popular
                </div>
                <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-pencil-ruler text-3xl text-yellow-600"></i>
                </div>
                <h3 class="text-xl font-semibold text-center mb-3">Full Design Package</h3>
                <p class="text-gray-600 text-center mb-4">Complete design solution including 3D renders, material selection, and project management</p>
                <div class="text-center">
                    <span class="text-2xl font-bold text-yellow-600">Starting at Rs. 150,000</span>
                    <p class="text-gray-500 text-sm">per project</p>
                </div>
            </div>

            <div class="bg-white border-2 border-gray-200 rounded-lg p-6 hover:border-yellow-600 hover:shadow-xl transition">
                <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-building text-3xl text-yellow-600"></i>
                </div>
                <h3 class="text-xl font-semibold text-center mb-3">Commercial Design</h3>
                <p class="text-gray-600 text-center mb-4">Specialized design services for offices, restaurants, and retail spaces</p>
                <div class="text-center">
                    <span class="text-2xl font-bold text-yellow-600">Custom Quote</span>
                    <p class="text-gray-500 text-sm">based on scope</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Portfolio -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center mb-12">
            <h2 class="text-3xl font-bold">Our Portfolio</h2>
            <a href="{{ route('interior-design.portfolio') }}" class="text-yellow-600 hover:underline font-semibold">View All Projects →</a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @for($i = 1; $i <= 6; $i++)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden group">
                <div class="relative overflow-hidden">
                    <img src="https://via.placeholder.com/400x300/EAB308/FFFFFF?text=Project+{{ $i }}" 
                         alt="Project {{ $i }}" 
                         class="w-full h-64 object-cover group-hover:scale-110 transition duration-300">
                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-50 transition flex items-center justify-center">
                        <a href="#" class="bg-white text-gray-900 px-6 py-2 rounded-full opacity-0 group-hover:opacity-100 transition">
                            View Project
                        </a>
                    </div>
                </div>
                <div class="p-4">
                    <h3 class="font-semibold text-lg mb-1">Modern Living Room Design</h3>
                    <p class="text-gray-600 text-sm mb-2">Residential Project - Colombo</p>
                    <div class="flex items-center text-sm text-gray-500">
                        <i class="fas fa-user-circle mr-2 text-yellow-600"></i>
                        Designer {{ $i }}
                    </div>
                </div>
            </div>
            @endfor
        </div>
    </div>
</section>

<!-- Featured Designers -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12">Meet Our Designers</h2>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            @for($i = 1; $i <= 4; $i++)
            <div class="text-center">
                <div class="w-32 h-32 bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-full flex items-center justify-center text-white text-4xl font-bold mx-auto mb-4">
                    D{{ $i }}
                </div>
                <h3 class="font-semibold text-lg">Designer {{ $i }}</h3>
                <p class="text-gray-600 text-sm mb-2">Senior Interior Designer</p>
                <div class="flex justify-center text-yellow-500 text-sm mb-3">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <a href="#" class="text-yellow-600 hover:underline text-sm">View Profile</a>
            </div>
            @endfor
        </div>
    </div>
</section>

<!-- Process -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12">Our Design Process</h2>
        <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
            @php
            $steps = [
                ['icon' => 'fa-calendar-check', 'title' => 'Initial Consultation', 'desc' => 'Discuss your vision and requirements'],
                ['icon' => 'fa-ruler-combined', 'title' => 'Space Planning', 'desc' => 'Measure and analyze your space'],
                ['icon' => 'fa-palette', 'title' => 'Design Concepts', 'desc' => 'Create mood boards and 3D renders'],
                ['icon' => 'fa-shopping-cart', 'title' => 'Material Selection', 'desc' => 'Choose furniture and finishes'],
                ['icon' => 'fa-hammer', 'title' => 'Implementation', 'desc' => 'Oversee installation and styling']
            ];
            @endphp
            @foreach($steps as $index => $step)
            <div class="text-center">
                <div class="w-16 h-16 bg-yellow-600 rounded-full flex items-center justify-center mx-auto mb-3">
                    <i class="fas {{ $step['icon'] }} text-2xl text-white"></i>
                </div>
                <h4 class="font-semibold mb-2">{{ $step['title'] }}</h4>
                <p class="text-gray-600 text-sm">{{ $step['desc'] }}</p>
            </div>
            @if($index < count($steps) - 1)
            <div class="hidden md:flex items-center justify-center">
                <i class="fas fa-arrow-right text-yellow-600 text-2xl"></i>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</section>

<!-- Testimonials -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12">Client Testimonials</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @for($i = 1; $i <= 3; $i++)
            <div class="bg-gray-50 rounded-lg p-6">
                <div class="flex text-yellow-500 mb-4">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p class="text-gray-600 mb-4 italic">"The team transformed our home beyond our expectations. Professional, creative, and attentive to every detail. Highly recommended!"</p>
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-yellow-600 rounded-full flex items-center justify-center text-white font-bold mr-3">
                        C{{ $i }}
                    </div>
                    <div>
                        <h4 class="font-semibold">Client {{ $i }}</h4>
                        <p class="text-gray-500 text-sm">Residential Project</p>
                    </div>
                </div>
            </div>
            @endfor
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 bg-yellow-600">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold text-white mb-4">Ready to Transform Your Space?</h2>
        <p class="text-white text-xl mb-8">Book a consultation with our expert designers today</p>
        <a href="{{ route('interior-design.consultation') }}" class="bg-white hover:bg-gray-100 text-yellow-600 px-8 py-3 rounded-full font-semibold transition inline-block">
            Book Consultation
        </a>
    </div>
</section>
@endsection
