@extends('layouts.app')

@section('title', 'My Custom Requests')

@section('content')
<x-breadcrumb :items="[
    ['label' => 'Custom Furniture', 'url' => route('custom-furniture.index')],
    ['label' => 'My Requests']
]" />

<section class="py-8">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold mb-8">My Custom Furniture Requests</h1>

        <div class="space-y-4">
            @for($i = 1; $i <= 3; $i++)
            <div class="bg-white rounded-lg shadow-lg p-6">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h3 class="text-xl font-semibold">Custom Dining Table #{{ 1000 + $i }}</h3>
                        <p class="text-gray-600 text-sm">Submitted: Nov {{ 15 + $i }}, 2025</p>
                    </div>
                    <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-semibold">
                        {{ $i == 1 ? 'Pending Quotes' : ($i == 2 ? 'In Progress' : 'Completed') }}
                    </span>
                </div>
                <p class="text-gray-700 mb-4">Custom teak wood dining table with modern design, 180cm x 90cm</p>
                <div class="flex space-x-4">
                    <button class="px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white rounded-lg transition">
                        View Details
                    </button>
                    <button class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg transition">
                        View Quotes ({{ $i + 1 }})
                    </button>
                </div>
            </div>
            @endfor
        </div>
    </div>
</section>
@endsection
