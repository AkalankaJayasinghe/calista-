@extends('layouts.app')

@section('title', 'My Projects')

@section('content')
<x-breadcrumb :items="[
    ['label' => 'Interior Design', 'url' => route('interior-design.index')],
    ['label' => 'My Projects']
]" />

<section class="py-8">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold mb-8">My Interior Design Projects</h1>

        <div class="space-y-6">
            @for($i = 1; $i <= 3; $i++)
            <div class="bg-white rounded-lg shadow-lg p-6">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h3 class="text-xl font-semibold">Living Room Redesign #{{ $i }}</h3>
                        <p class="text-gray-600 text-sm">Started: Nov {{ 10 + $i }}, 2025</p>
                        <p class="text-gray-600 text-sm">Designer: Designer {{ $i }}</p>
                    </div>
                    <span class="bg-{{ $i == 1 ? 'blue' : ($i == 2 ? 'yellow' : 'green') }}-100 text-{{ $i == 1 ? 'blue' : ($i == 2 ? 'yellow' : 'green') }}-800 px-3 py-1 rounded-full text-sm font-semibold">
                        {{ $i == 1 ? 'Planning' : ($i == 2 ? 'In Progress' : 'Completed') }}
                    </span>
                </div>

                <div class="grid grid-cols-4 gap-3 mb-4">
                    @for($j = 1; $j <= 4; $j++)
                    <img src="https://via.placeholder.com/150x100/EAB308/FFFFFF?text=Photo+{{ $j }}" class="w-full h-24 object-cover rounded">
                    @endfor
                </div>

                <div class="flex space-x-4">
                    <button class="px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white rounded-lg transition">
                        View Details
                    </button>
                    <button class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg transition">
                        Contact Designer
                    </button>
                </div>
            </div>
            @endfor
        </div>
    </div>
</section>
@endsection
