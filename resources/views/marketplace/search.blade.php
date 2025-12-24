@extends('layouts.app')

@section('title', 'Search Results')

@section('content')
<x-breadcrumb :items="[
    ['label' => 'Marketplace', 'url' => route('marketplace.index')],
    ['label' => 'Search Results']
]" />

<section class="py-8">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold mb-2">Search Results</h1>
        <p class="text-gray-600 mb-8">Showing results for: <strong>{{ request('q') }}</strong></p>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            @for($i = 1; $i <= 8; $i++)
            <x-product-card
                :id="$i"
                :name="'Furniture Item ' . $i"
                :price="60000 + ($i * 4000)"
                :image="'https://via.placeholder.com/300x300/EAB308/FFFFFF?text=Result+' . $i"
                :rating="4.2"
                :reviews="rand(10, 50)"
            />
            @endfor
        </div>
    </div>
</section>
@endsection
