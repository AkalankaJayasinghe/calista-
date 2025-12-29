@extends('layouts.app')

@section('title', 'Custom Furniture - Design Your Dream')

@section('content')

<div class="relative w-full min-h-[75vh] flex items-center justify-center overflow-hidden bg-gray-900">
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1618220179428-22790b461013?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80"
             alt="Luxury Furniture"
             class="w-full h-full object-cover opacity-50">
        <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/40 to-transparent"></div>
    </div>

    <div class="relative z-10 container mx-auto px-6 text-center mt-10">
        <span class="inline-block py-1 px-3 rounded-full bg-yellow-600/20 border border-yellow-500 text-yellow-400 text-sm font-semibold mb-6 tracking-widest uppercase animate-fade-in-down">
            Premium Craftsmanship
        </span>

        <h1 class="text-5xl md:text-7xl font-serif text-white mb-6 leading-tight animate-fade-in-up">
            Design Your <br>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-200 to-yellow-600">Dream Furniture</span>
        </h1>

        <p class="text-gray-300 text-lg md:text-xl max-w-2xl mx-auto leading-relaxed font-light animate-fade-in-up delay-100">
            Connect with Sri Lanka's finest carpenters and workshops. Turn your unique ideas into handcrafted reality.
        </p>
    </div>
</div>

<div class="relative z-20 -mt-20 container mx-auto px-6 mb-20">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 bg-white/10 backdrop-blur-md border border-white/20 p-8 rounded-3xl shadow-2xl">
        <div class="text-center border-r border-white/10 last:border-0">
            <div class="text-3xl font-bold text-yellow-400">500+</div>
            <div class="text-gray-300 text-sm mt-1">Projects Done</div>
        </div>
        <div class="text-center border-r border-white/10 last:border-0">
            <div class="text-3xl font-bold text-yellow-400">50+</div>
            <div class="text-gray-300 text-sm mt-1">Expert Workshops</div>
        </div>
        <div class="text-center border-r border-white/10 last:border-0">
            <div class="text-3xl font-bold text-yellow-400">100%</div>
            <div class="text-gray-300 text-sm mt-1">Custom Made</div>
        </div>
        <div class="text-center">
            <div class="text-3xl font-bold text-yellow-400">4.9</div>
            <div class="text-gray-300 text-sm mt-1">User Rating</div>
        </div>
    </div>
</div>

<section class="py-16 bg-white">
    <div class="container mx-auto px-6">
        <div class="flex flex-col md:flex-row items-center gap-12">
            <div class="w-full md:w-1/2">
                <div class="grid grid-cols-2 gap-4">
                    <img src="https://images.unsplash.com/photo-1555041469-a586c61ea9bc?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="rounded-2xl shadow-lg transform translate-y-8">
                    <img src="https://images.unsplash.com/photo-1598300042247-d088f8ab3a91?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="rounded-2xl shadow-lg">
                </div>
            </div>

            <div class="w-full md:w-1/2">
                <span class="text-yellow-600 font-bold tracking-wider text-sm uppercase">Get Inspired</span>
                <h2 class="text-4xl font-serif font-bold text-gray-900 mt-2 mb-6">Explore Our Design Gallery</h2>
                <p class="text-gray-600 text-lg mb-8 leading-relaxed">
                    Not sure where to start? Browse through hundreds of completed projects. From modern minimalist desks to classic teak wardrobes, find the perfect style for your home.
                </p>

                <a href="{{ route('custom-furniture.gallery') }}"
                   class="inline-flex items-center gap-3 px-8 py-4 bg-gray-900 text-white rounded-full font-semibold hover:bg-gray-800 transition-all shadow-xl hover:shadow-2xl transform hover:-translate-y-1">
                    <i class="fas fa-images"></i>
                    Browse Gallery
                </a>
            </div>
        </div>
    </div>
</section>

<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-serif font-bold text-gray-900 mb-4">Simple Process</h2>
            <div class="w-24 h-1 bg-yellow-500 mx-auto rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            <div class="group text-center p-8 rounded-2xl bg-white hover:shadow-xl transition-all duration-300 border border-gray-100">
                <div class="w-20 h-20 mx-auto bg-yellow-100 rounded-full flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <i class="fas fa-file-alt text-3xl text-yellow-600"></i>
                </div>
                <h3 class="text-xl font-bold mb-3">1. Post Your Request</h3>
                <p class="text-gray-600">Upload photos, sketches, or dimensions. Describe what you need in detail.</p>
            </div>

            <div class="group text-center p-8 rounded-2xl bg-white hover:shadow-xl transition-all duration-300 border border-gray-100">
                <div class="w-20 h-20 mx-auto bg-yellow-100 rounded-full flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <i class="fas fa-gavel text-3xl text-yellow-600"></i>
                </div>
                <h3 class="text-xl font-bold mb-3">2. Receive Quotes</h3>
                <p class="text-gray-600">Verified workshops will compete for your project with their best prices.</p>
            </div>

            <div class="group text-center p-8 rounded-2xl bg-white hover:shadow-xl transition-all duration-300 border border-gray-100">
                <div class="w-20 h-20 mx-auto bg-yellow-100 rounded-full flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <i class="fas fa-truck-loading text-3xl text-yellow-600"></i>
                </div>
                <h3 class="text-xl font-bold mb-3">3. Get it Delivered</h3>
                <p class="text-gray-600">Accept the best quote, track progress, and get your custom piece delivered.</p>
            </div>
        </div>
    </div>
</section>

<section class="py-20 relative overflow-hidden">
    <div class="absolute inset-0 bg-gray-900">
        <img src="https://images.unsplash.com/photo-1604578762246-41134e37f9cc?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80" class="w-full h-full object-cover opacity-20">
        <div class="absolute inset-0 bg-gradient-to-r from-gray-900 via-gray-900/90 to-transparent"></div>
    </div>

    <div class="container mx-auto px-6 relative z-10">
        <div class="flex flex-col md:flex-row items-center justify-between gap-12">
            <div class="w-full md:w-3/5">
                <h2 class="text-4xl md:text-5xl font-serif font-bold text-white mb-6">Ready to Build Your <br><span class="text-yellow-500">Masterpiece?</span></h2>
                <p class="text-gray-300 text-lg mb-8 max-w-xl">
                    Skip the showrooms and middle-men. Directly connect with skilled craftsmen who can build exactly what you have in mind, within your budget.
                </p>

                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('custom-furniture.request') }}"
                       class="group px-8 py-4 bg-yellow-600 rounded-full text-white font-bold shadow-lg hover:bg-yellow-500 transition-all flex items-center gap-3">
                        <i class="fas fa-pencil-ruler"></i>
                        Start Your Request
                        <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
            </div>

            <div class="w-full md:w-2/5 hidden md:block">
                <div class="bg-white/10 backdrop-blur-md border border-white/20 p-6 rounded-2xl transform rotate-3 hover:rotate-0 transition-transform duration-500">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center text-white text-xl">
                            <i class="fas fa-check"></i>
                        </div>
                        <div>
                            <div class="text-white font-bold">Free to Post</div>
                            <div class="text-gray-400 text-sm">No hidden charges</div>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center text-white text-xl">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <div>
                            <div class="text-white font-bold">Secure Payments</div>
                            <div class="text-gray-400 text-sm">Your money is safe</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-20 bg-white">
    <div class="container mx-auto px-6">
        <div class="flex justify-between items-end mb-12">
            <div>
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-gray-900 mb-2">Top Rated Workshops</h2>
                <p class="text-gray-500">Meet the masters behind the craft</p>
            </div>
            <a href="{{ route('custom-furniture.workshops.index') }}" class="text-yellow-600 hover:text-yellow-700 font-semibold flex items-center gap-2">
                View All <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-lg hover:shadow-xl transition-all group">
                <div class="h-48 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1601058268499-e52642d42603?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80');">
                    <div class="w-full h-full bg-black/20 group-hover:bg-black/0 transition-all"></div>
                </div>
                <div class="p-6 relative">
                    <div class="absolute -top-10 right-6 w-20 h-20 bg-yellow-500 rounded-xl flex items-center justify-center shadow-lg text-2xl font-bold text-white">
                        W
                    </div>
                    <h3 class="text-xl font-bold mb-1 text-gray-900">Wood Master LK</h3>
                    <div class="flex items-center gap-2 text-sm text-yellow-500 mb-4">
                        <i class="fas fa-star"></i> 4.8 (120 Reviews)
                    </div>
                    <p class="text-gray-500 text-sm mb-6">Specialized in Teak & Mahogany classic furniture restoration.</p>

                    <a href="{{ route('custom-furniture.workshops.show', 1) }}" class="block w-full py-3 text-center border border-gray-200 rounded-lg hover:bg-yellow-600 hover:border-yellow-600 hover:text-white transition-all text-sm font-semibold text-gray-700">
                        View Profile
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-lg hover:shadow-xl transition-all group">
                <div class="h-48 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1533090481720-856c6e3c1fdc?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80');"></div>
                <div class="p-6 relative">
                    <div class="absolute -top-10 right-6 w-20 h-20 bg-yellow-500 rounded-xl flex items-center justify-center shadow-lg text-2xl font-bold text-white">M</div>
                    <h3 class="text-xl font-bold mb-1 text-gray-900">Modern Living</h3>
                    <div class="flex items-center gap-2 text-sm text-yellow-500 mb-4"><i class="fas fa-star"></i> 4.9 (85 Reviews)</div>
                    <p class="text-gray-500 text-sm mb-6">Experts in minimal designs and office setups.</p>
                    <a href="{{ route('custom-furniture.workshops.show', 2) }}" class="block w-full py-3 text-center border border-gray-200 rounded-lg hover:bg-yellow-600 hover:border-yellow-600 hover:text-white transition-all text-sm font-semibold text-gray-700">View Profile</a>
                </div>
            </div>

             <div class="bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-lg hover:shadow-xl transition-all group">
                <div class="h-48 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1581092580497-e0d23cbdf1dc?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80');"></div>
                <div class="p-6 relative">
                    <div class="absolute -top-10 right-6 w-20 h-20 bg-yellow-500 rounded-xl flex items-center justify-center shadow-lg text-2xl font-bold text-white">A</div>
                    <h3 class="text-xl font-bold mb-1 text-gray-900">Artisan Decor</h3>
                    <div class="flex items-center gap-2 text-sm text-yellow-500 mb-4"><i class="fas fa-star"></i> 5.0 (42 Reviews)</div>
                    <p class="text-gray-500 text-sm mb-6">Hand-carved wooden arts and traditional furniture.</p>
                    <a href="{{ route('custom-furniture.workshops.show', 3) }}" class="block w-full py-3 text-center border border-gray-200 rounded-lg hover:bg-yellow-600 hover:border-yellow-600 hover:text-white transition-all text-sm font-semibold text-gray-700">View Profile</a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
