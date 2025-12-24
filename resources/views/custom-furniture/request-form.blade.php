@extends('layouts.app')

@section('title', 'Request Custom Furniture')

@section('content')
<x-breadcrumb :items="[
    ['label' => 'Custom Furniture', 'url' => route('custom-furniture.index')],
    ['label' => 'Request Form']
]" />

<section class="py-8">
    <div class="container mx-auto px-4 max-w-3xl">
        <h1 class="text-3xl font-bold mb-4">Request Custom Furniture</h1>
        <p class="text-gray-600 mb-8">Fill out the form below and we'll connect you with qualified workshops</p>

        <form class="bg-white rounded-lg shadow-lg p-8 space-y-6">
            <div>
                <label class="block text-sm font-medium mb-2">Furniture Type</label>
                <select class="w-full border border-gray-300 rounded-lg px-4 py-2">
                    <option>Select Type</option>
                    <option>Table</option>
                    <option>Chair</option>
                    <option>Cabinet</option>
                    <option>Bed</option>
                    <option>Sofa</option>
                    <option>Other</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium mb-2">Description</label>
                <textarea rows="5" class="w-full border border-gray-300 rounded-lg px-4 py-2" placeholder="Describe what you need..."></textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-2">Dimensions (L x W x H)</label>
                    <input type="text" class="w-full border border-gray-300 rounded-lg px-4 py-2" placeholder="e.g. 120 x 60 x 75 cm">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2">Budget Range (Rs.)</label>
                    <input type="text" class="w-full border border-gray-300 rounded-lg px-4 py-2" placeholder="e.g. 50,000 - 100,000">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium mb-2">Preferred Material</label>
                <div class="grid grid-cols-3 gap-3">
                    <label class="flex items-center">
                        <input type="checkbox" class="mr-2"> Teak
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" class="mr-2"> Mahogany
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" class="mr-2"> Pine
                    </label>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium mb-2">Upload Reference Images</label>
                <input type="file" multiple class="w-full border border-gray-300 rounded-lg px-4 py-2">
            </div>

            <button type="submit" class="w-full bg-yellow-600 hover:bg-yellow-700 text-white py-3 rounded-lg font-semibold transition">
                Submit Request
            </button>
        </form>
    </div>
</section>
@endsection
