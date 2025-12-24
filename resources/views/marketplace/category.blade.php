@extends('layouts.app')

@section('title', ucfirst(str_replace('-', ' ', $slug)))

@section('content')
<x-breadcrumb :items="[
    ['label' => 'Marketplace', 'url' => route('marketplace.index')],
    ['label' => ucfirst(str_replace('-', ' ', $slug))]
]" />

<section class="py-8">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold mb-6">{{ ucfirst(str_replace('-', ' ', $slug)) }}</h1>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            @for($i = 1; $i <= 12; $i++)
            <x-product-card
                :id="$i"
                :name="ucfirst(str_replace('-', ' ', $slug)) . ' Item ' . $i"
                :price="75000 + ($i * 3000)"
                :image="'https://via.placeholder.com/300x300/EAB308/FFFFFF?text=Product+' . $i"
                :rating="4.0 + (($i % 10) / 10)"
                :reviews="rand(15, 85)"
            />
            @endfor
        </div>
    </div>
</section>
@endsection
