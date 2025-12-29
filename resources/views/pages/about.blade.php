@extends('layouts.app')

@section('title', 'Calista - Experience Luxury Living')

@section('content')

<div class="relative w-full h-[85vh] flex items-center justify-center overflow-hidden bg-black">
    <video autoplay muted loop playsinline class="w-full h-full object-cover opacity-60 scale-105">
        <source src="https://videos.pexels.com/video-files/6703923/6703923-hd_1920_1080_25fps.mp4" type="video/mp4">
    </video>
    <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-black/40 to-transparent"></div>

    <div class="relative z-10 text-center px-6 max-w-5xl">
        <div class="inline-flex items-center gap-2 py-1 px-4 rounded-full bg-yellow-600/30 border border-yellow-500/50 backdrop-blur-md mb-6 animate-fade-in-down">
            <span class="w-2 h-2 bg-red-500 rounded-full animate-pulse"></span>
            <span class="text-yellow-400 text-xs font-bold tracking-widest uppercase">Live: New Collection</span>
        </div>
        <h1 class="text-5xl md:text-8xl font-serif font-bold text-white mb-6 leading-tight drop-shadow-2xl animate-fade-in-up">
            Design Your <br> <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-200 to-yellow-600">Legacy</span>
        </h1>
        <div class="flex flex-col sm:flex-row gap-4 justify-center animate-fade-in-up delay-200">
            <a href="{{ route('custom-furniture.request') }}" class="px-8 py-4 bg-white text-gray-900 font-bold rounded-full hover:scale-105 transition-transform">
                Start Customizing
            </a>
            <a href="#collection" class="px-8 py-4 border border-white/30 text-white rounded-full font-medium hover:bg-white/10 backdrop-blur-sm transition-all">
                View Collection
            </a>
        </div>
    </div>
</div>

<div class="relative bg-yellow-600 overflow-hidden py-3 shadow-lg z-20 border-t border-yellow-400">
    <div class="flex overflow-x-hidden group">
        <div class="py-1 animate-marquee whitespace-nowrap flex gap-12 text-white font-bold tracking-wider text-sm uppercase">
            <span><i class="fas fa-star text-yellow-900"></i> Premium Teak Wood</span>
            <span><i class="fas fa-truck text-yellow-900"></i> Island-wide Delivery</span>
            <span><i class="fas fa-tools text-yellow-900"></i> Custom Made in Sri Lanka</span>
            <span><i class="fas fa-shield-alt text-yellow-900"></i> 10 Year Warranty</span>
            <span><i class="fas fa-star text-yellow-900"></i> Premium Teak Wood</span>
            <span><i class="fas fa-truck text-yellow-900"></i> Island-wide Delivery</span>
            <span><i class="fas fa-tools text-yellow-900"></i> Custom Made in Sri Lanka</span>
            <span><i class="fas fa-shield-alt text-yellow-900"></i> 10 Year Warranty</span>
        </div>
    </div>
</div>

<section id="collection" class="py-20 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <span class="text-yellow-600 font-bold tracking-widest text-sm uppercase">Curated Spaces</span>
            <h2 class="text-4xl font-serif font-bold text-gray-900 mt-2">Shop by Category</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 h-auto md:h-[600px]">
            <div class="group relative md:col-span-2 md:row-span-2 overflow-hidden rounded-2xl cursor-pointer">
                <img src="https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80"
                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-80"></div>
                <div class="absolute bottom-8 left-8 text-white">
                    <h3 class="text-3xl font-serif font-bold">Living Room</h3>
                    <p class="text-gray-300 mb-4">Sofas, Coffee Tables & TV Units</p>
                    <span class="underline decoration-yellow-500 underline-offset-4 group-hover:text-yellow-400 transition">Explore Collection &rarr;</span>
                </div>
            </div>

            <div class="group relative overflow-hidden rounded-2xl cursor-pointer">
                <img src="https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-80"></div>
                <div class="absolute bottom-6 left-6 text-white">
                    <h3 class="text-2xl font-serif font-bold">Bedroom</h3>
                    <span class="text-sm group-hover:text-yellow-400 transition">View Products &rarr;</span>
                </div>
            </div>

            <div class="group relative overflow-hidden rounded-2xl cursor-pointer">
                <img src="https://images.unsplash.com/photo-1617806118233-18e1de247200?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-80"></div>
                <div class="absolute bottom-6 left-6 text-white">
                    <h3 class="text-2xl font-serif font-bold">Dining</h3>
                    <span class="text-sm group-hover:text-yellow-400 transition">View Products &rarr;</span>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-6">
        <div class="flex justify-between items-end mb-12">
            <div>
                <h2 class="text-3xl font-serif font-bold text-gray-900">Trending Now</h2>
                <p class="text-gray-500">Handpicked favorites for this season</p>
            </div>
            <a href="#" class="text-yellow-600 font-bold hover:text-yellow-700">View All &rarr;</a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="bg-white rounded-xl shadow-sm hover:shadow-xl transition duration-300 group">
                <div class="relative overflow-hidden rounded-t-xl h-64">
                    <img src="https://images.unsplash.com/photo-1592078615290-033ee584e267?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
                         class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                    <div class="absolute top-3 right-3 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">-20%</div>
                </div>
                <div class="p-5">
                    <h3 class="text-lg font-bold text-gray-800">Royal Teak Armchair</h3>
                    <p class="text-gray-500 text-sm mb-3">Vintage Finish</p>
                    <div class="flex justify-between items-center">
                        <span class="text-xl font-bold text-gray-900">Rs. 45,000</span>
                        <button class="w-10 h-10 rounded-full bg-gray-100 hover:bg-yellow-500 hover:text-white transition flex items-center justify-center">
                            <i class="fas fa-shopping-cart"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm hover:shadow-xl transition duration-300 group">
                <div class="relative overflow-hidden rounded-t-xl h-64">
                    <img src="https://images.unsplash.com/photo-1538688525198-9b88f6f53126?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
                         class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                </div>
                <div class="p-5">
                    <h3 class="text-lg font-bold text-gray-800">Minimalist Wall Shelf</h3>
                    <p class="text-gray-500 text-sm mb-3">Oak Wood</p>
                    <div class="flex justify-between items-center">
                        <span class="text-xl font-bold text-gray-900">Rs. 12,500</span>
                        <button class="w-10 h-10 rounded-full bg-gray-100 hover:bg-yellow-500 hover:text-white transition flex items-center justify-center">
                            <i class="fas fa-shopping-cart"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm hover:shadow-xl transition duration-300 group">
                <div class="relative overflow-hidden rounded-t-xl h-64">
                    <img src="https://images.unsplash.com/photo-1567016432929-1557d05779ea?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
                         class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                    <div class="absolute top-3 left-3 bg-yellow-500 text-white text-xs font-bold px-2 py-1 rounded">New</div>
                </div>
                <div class="p-5">
                    <h3 class="text-lg font-bold text-gray-800">Nordic Coffee Table</h3>
                    <p class="text-gray-500 text-sm mb-3">Glass & Wood</p>
                    <div class="flex justify-between items-center">
                        <span class="text-xl font-bold text-gray-900">Rs. 28,000</span>
                        <button class="w-10 h-10 rounded-full bg-gray-100 hover:bg-yellow-500 hover:text-white transition flex items-center justify-center">
                            <i class="fas fa-shopping-cart"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm hover:shadow-xl transition duration-300 group">
                <div class="relative overflow-hidden rounded-t-xl h-64">
                    <img src="https://images.unsplash.com/photo-1617325247661-675ab4b64ae2?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
                         class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                </div>
                <div class="p-5">
                    <h3 class="text-lg font-bold text-gray-800">Luxury Velvet Stool</h3>
                    <p class="text-gray-500 text-sm mb-3">Gold Plated Legs</p>
                    <div class="flex justify-between items-center">
                        <span class="text-xl font-bold text-gray-900">Rs. 18,900</span>
                        <button class="w-10 h-10 rounded-full bg-gray-100 hover:bg-yellow-500 hover:text-white transition flex items-center justify-center">
                            <i class="fas fa-shopping-cart"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-20 bg-gray-900 text-white relative overflow-hidden">
    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#d4af37 1px, transparent 1px); background-size: 30px 30px;"></div>

    <div class="container mx-auto px-6 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <div>
                <span class="text-yellow-500 font-bold tracking-widest uppercase text-sm">The Calista Difference</span>
                <h2 class="text-4xl md:text-5xl font-serif font-bold mt-4 mb-6">Why We Are The Best?</h2>
                <p class="text-gray-400 text-lg mb-8 leading-relaxed">
                    We combine traditional Sri Lankan craftsmanship with modern technology to deliver furniture that lasts generations. Quality is not just a promise; it's our habit.
                </p>

                <div class="space-y-6">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-yellow-600 rounded-lg flex items-center justify-center text-xl flex-shrink-0">
                            <i class="fas fa-tree"></i>
                        </div>
                        <div>
                            <h4 class="text-xl font-bold">Sustainably Sourced Wood</h4>
                            <p class="text-gray-400 text-sm">100% Teak, Mahogany, and Mara from certified sources.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-yellow-600 rounded-lg flex items-center justify-center text-xl flex-shrink-0">
                            <i class="fas fa-paint-roller"></i>
                        </div>
                        <div>
                            <h4 class="text-xl font-bold">Premium Finishes</h4>
                            <p class="text-gray-400 text-sm">Water-resistant and scratch-proof coatings.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-yellow-600 rounded-lg flex items-center justify-center text-xl flex-shrink-0">
                            <i class="fas fa-headset"></i>
                        </div>
                        <div>
                            <h4 class="text-xl font-bold">Lifetime Support</h4>
                            <p class="text-gray-400 text-sm">We are here for repairs and maintenance anytime.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="relative">
                <img src="https://images.unsplash.com/photo-1604578762246-41134e37f9cc?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                     class="rounded-2xl shadow-2xl border-4 border-gray-700 transform rotate-2 hover:rotate-0 transition duration-500">
                <div class="absolute -bottom-6 -left-6 bg-white p-6 rounded-xl shadow-xl text-gray-900 hidden md:block">
                    <p class="font-bold text-3xl text-yellow-600">15+</p>
                    <p class="text-sm font-semibold">Years of Excellence</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-20 bg-yellow-600">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-3xl md:text-4xl font-serif font-bold text-white mb-4">Join Our Exclusive Club</h2>
        <p class="text-yellow-100 mb-8">Subscribe to get special offers, free design tips, and once-in-a-lifetime deals.</p>

        <form class="max-w-xl mx-auto flex gap-2">
            <input type="email" placeholder="Enter your email address"
                   class="w-full px-6 py-4 rounded-full border-none focus:ring-2 focus:ring-black outline-none shadow-lg text-gray-800">
            <button class="bg-gray-900 text-white px-8 py-4 rounded-full font-bold hover:bg-gray-800 transition shadow-lg">
                Subscribe
            </button>
        </form>
    </div>
</section>

<style>
    @keyframes marquee {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }
    .animate-marquee {
        animation: marquee 30s linear infinite;
    }
    @keyframes fade-in-up {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in-up { animation: fade-in-up 0.8s ease-out forwards; }
    .delay-200 { animation-delay: 0.2s; opacity: 0; animation-fill-mode: forwards; }
</style>

@endsection
