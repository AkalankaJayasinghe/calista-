@extends('layouts.app')

@section('title', 'Book Consultation')

@section('content')
<x-breadcrumb :items="[
    ['label' => 'Interior Design', 'url' => route('interior-design.index')],
    ['label' => 'Book Consultation']
]" />

<section class="py-8">
    <div class="container mx-auto px-4 max-w-3xl">
        <h1 class="text-3xl font-bold mb-4">Book a Design Consultation</h1>
        <p class="text-gray-600 mb-8">Schedule a consultation with our expert interior designers</p>

        <form class="bg-white rounded-lg shadow-lg p-8 space-y-6">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-2">First Name</label>
                    <input type="text" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2">Last Name</label>
                    <input type="text" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-2">Email</label>
                    <input type="email" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2">Phone</label>
                    <input type="tel" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium mb-2">Project Type</label>
                <select class="w-full border border-gray-300 rounded-lg px-4 py-2">
                    <option>Residential - Living Room</option>
                    <option>Residential - Bedroom</option>
                    <option>Residential - Kitchen</option>
                    <option>Commercial - Office</option>
                    <option>Commercial - Restaurant</option>
                    <option>Full Home Design</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium mb-2">Project Description</label>
                <textarea rows="5" class="w-full border border-gray-300 rounded-lg px-4 py-2" placeholder="Tell us about your project..."></textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-2">Preferred Date</label>
                    <input type="date" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2">Preferred Time</label>
                    <select class="w-full border border-gray-300 rounded-lg px-4 py-2">
                        <option>Morning (9AM - 12PM)</option>
                        <option>Afternoon (12PM - 3PM)</option>
                        <option>Evening (3PM - 6PM)</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium mb-2">Budget Range (Rs.)</label>
                <select class="w-full border border-gray-300 rounded-lg px-4 py-2">
                    <option>Under 100,000</option>
                    <option>100,000 - 250,000</option>
                    <option>250,000 - 500,000</option>
                    <option>500,000 - 1,000,000</option>
                    <option>Above 1,000,000</option>
                </select>
            </div>

            <button type="submit" class="w-full bg-yellow-600 hover:bg-yellow-700 text-white py-3 rounded-lg font-semibold transition">
                Book Consultation
            </button>
        </form>
    </div>
</section>
@endsection
