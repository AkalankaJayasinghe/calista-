@extends('layouts.app')

@section('title', 'Request Custom Furniture')

@section('content')

<div class="relative bg-gray-900 py-16">
    <div class="absolute inset-0 overflow-hidden">
        <img src="https://images.unsplash.com/photo-1617098900591-3f90928e8c54?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80" alt="Woodwork" class="w-full h-full object-cover opacity-30">
        <div class="absolute inset-0 bg-gradient-to-b from-gray-900/50 to-gray-900"></div>
    </div>
    <div class="relative container mx-auto px-6 text-center text-white">
        <h1 class="text-4xl md:text-5xl font-serif font-bold mb-4">Craft Your Vision</h1>
        <p class="text-lg text-gray-300 max-w-2xl mx-auto">Tell us what you need. We connect you with expert craftsmen to build furniture that fits your space perfectly.</p>
    </div>
</div>

<section class="py-12 bg-white border-b border-gray-100">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center">
            <div class="relative">
                <div class="w-16 h-16 mx-auto bg-yellow-100 rounded-full flex items-center justify-center mb-4 text-yellow-700 text-2xl">
                    <i class="fas fa-pencil-alt"></i>
                </div>
                <h3 class="font-bold text-gray-900">1. Describe</h3>
                <p class="text-sm text-gray-500 mt-2">Fill out the form with your idea, dimensions, and photos.</p>
                <div class="hidden md:block absolute top-8 -right-4 text-gray-300"><i class="fas fa-chevron-right"></i></div>
            </div>

            <div class="relative">
                <div class="w-16 h-16 mx-auto bg-yellow-100 rounded-full flex items-center justify-center mb-4 text-yellow-700 text-2xl">
                    <i class="fas fa-file-invoice-dollar"></i>
                </div>
                <h3 class="font-bold text-gray-900">2. Get Quotes</h3>
                <p class="text-sm text-gray-500 mt-2">Receive estimated prices from top-rated workshops.</p>
                <div class="hidden md:block absolute top-8 -right-4 text-gray-300"><i class="fas fa-chevron-right"></i></div>
            </div>

            <div class="relative">
                <div class="w-16 h-16 mx-auto bg-yellow-100 rounded-full flex items-center justify-center mb-4 text-yellow-700 text-2xl">
                    <i class="fas fa-hammer"></i>
                </div>
                <h3 class="font-bold text-gray-900">3. Production</h3>
                <p class="text-sm text-gray-500 mt-2">Approve a quote and watch your item being built.</p>
                <div class="hidden md:block absolute top-8 -right-4 text-gray-300"><i class="fas fa-chevron-right"></i></div>
            </div>

            <div>
                <div class="w-16 h-16 mx-auto bg-green-100 rounded-full flex items-center justify-center mb-4 text-green-700 text-2xl">
                    <i class="fas fa-truck"></i>
                </div>
                <h3 class="font-bold text-gray-900">4. Delivery</h3>
                <p class="text-sm text-gray-500 mt-2">Get your custom piece delivered to your doorstep.</p>
            </div>
        </div>
    </div>
</section>

<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-6">
        <div class="flex flex-col lg:flex-row gap-12">

            <div class="lg:w-2/3">
                <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-3">
                        <span class="w-2 h-8 bg-yellow-500 rounded-full"></span>
                        Submit Your Request
                    </h2>

                    @if ($errors->any())
                        <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6">
                            <ul class="list-disc list-inside text-red-600 text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('custom-furniture.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Project Title</label>
                            <input type="text" name="title" value="{{ old('title') }}"
                                   class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 transition"
                                   placeholder="e.g. Modern Teak Dining Table">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Detailed Description</label>
                            <textarea name="description" rows="5"
                                      class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 transition"
                                      placeholder="Describe the style, finish, legs, usage, and any specific details...">{{ old('description') }}</textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Preferred Material</label>
                                <select name="material_id" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 bg-white">
                                    <option value="">Select Material</option>
                                    @foreach($materials as $material)
                                        <option value="{{ $material->id }}">{{ $material->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Wood Type / Color</label>
                                <input type="text" name="preferred_wood_type" value="{{ old('preferred_wood_type') }}"
                                       class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200"
                                       placeholder="e.g. Dark Mahogany, Light Oak">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Dimensions (L x W x H)</label>
                                <input type="text" name="dimensions" value="{{ old('dimensions') }}"
                                       class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200"
                                       placeholder="e.g. 180cm x 90cm x 75cm">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Estimated Budget (LKR)</label>
                                <input type="text" name="budget_range" value="{{ old('budget_range') }}"
                                       class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200"
                                       placeholder="e.g. 50,000 - 80,000">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Delivery Location/Address</label>
                            <input type="text" name="delivery_address" value="{{ old('delivery_address') }}"
                                   class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200"
                                   placeholder="Your delivery city or address">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Reference Images (Sketches/Photos)</label>
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:bg-gray-50 transition cursor-pointer relative">
                                <input type="file" name="reference_images[]" multiple class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                                <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                                <p class="text-sm text-gray-500">Click to upload photos or drag and drop here</p>
                                <p class="text-xs text-gray-400 mt-1">(JPG, PNG up to 2MB)</p>
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-4 rounded-lg shadow-lg transform transition hover:-translate-y-1">
                            Send Request to Workshops
                        </button>
                    </form>
                </div>
            </div>

            <div class="lg:w-1/3">
                <div class="sticky top-24">
                    <h2 class="text-xl font-bold text-gray-800 mb-6">Inspiration Gallery</h2>

                    <div class="grid grid-cols-1 gap-4">
                        <div class="group relative overflow-hidden rounded-xl shadow-md cursor-pointer">
                            <img src="https://images.unsplash.com/photo-1538688525198-9b88f6f53126?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
                                 class="w-full h-48 object-cover group-hover:scale-110 transition duration-500">
                            <div class="absolute inset-0 bg-black/40 flex items-end p-4 opacity-0 group-hover:opacity-100 transition">
                                <p class="text-white font-semibold">Custom Wall Unit</p>
                            </div>
                        </div>

                        <div class="group relative overflow-hidden rounded-xl shadow-md cursor-pointer">
                            <img src="https://images.unsplash.com/photo-1592078615290-033ee584e267?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
                                 class="w-full h-48 object-cover group-hover:scale-110 transition duration-500">
                            <div class="absolute inset-0 bg-black/40 flex items-end p-4 opacity-0 group-hover:opacity-100 transition">
                                <p class="text-white font-semibold">Teak Armchair</p>
                            </div>
                        </div>

                        <div class="group relative overflow-hidden rounded-xl shadow-md cursor-pointer">
                            <img src="https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
                                 class="w-full h-48 object-cover group-hover:scale-110 transition duration-500">
                            <div class="absolute inset-0 bg-black/40 flex items-end p-4 opacity-0 group-hover:opacity-100 transition">
                                <p class="text-white font-semibold">Modern Bed Frame</p>
                            </div>
                        </div>

                        <div class="group relative overflow-hidden rounded-xl shadow-md cursor-pointer">
                            <img src="https://images.unsplash.com/photo-1601366533287-59b97dcb2911?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
                                 class="w-full h-48 object-cover group-hover:scale-110 transition duration-500">
                            <div class="absolute inset-0 bg-black/40 flex items-end p-4 opacity-0 group-hover:opacity-100 transition">
                                <p class="text-white font-semibold">Office Desk Setup</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 bg-yellow-50 p-6 rounded-xl border border-yellow-100">
                        <h4 class="font-bold text-yellow-800 mb-2">Need Help?</h4>
                        <p class="text-sm text-yellow-700 mb-4">Not sure about materials or measurements? Contact our support team for free guidance.</p>
                        <a href="{{ route('contact') }}" class="text-yellow-600 font-semibold hover:underline">Contact Support &rarr;</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection
