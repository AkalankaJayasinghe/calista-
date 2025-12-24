@extends('layouts.app')

@section('title', 'Home - CalistaLK | Elegant Interior Designs & Furniture')

@section('content')

{{-- 1. NAVIGATION BAR --}}
<nav class="sticky top-0 z-50 bg-gray-900 shadow-xl w-full transition-all duration-300" id="navbar">
    <div class="container mx-auto px-4 py-3">
        <div class="flex justify-between items-center">
            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                <div class="w-10 h-10 bg-amber-500 rounded-md flex items-center justify-center transform group-hover:rotate-12 transition-transform">
                    <i class="fas fa-couch text-gray-900 text-lg"></i>
                </div>
                <div class="flex flex-col">
                    <span class="text-xl font-bold text-white tracking-wide">Calista<span class="text-amber-500">LK</span></span>
                    <span class="text-[10px] text-gray-400 uppercase tracking-widest leading-none">Interiors</span>
                </div>
            </a>

            {{-- Desktop Menu --}}
            <div class="hidden lg:flex items-center gap-8">
                <a href="{{ route('home') }}" class="text-amber-500 font-medium border-b-2 border-amber-500 pb-1">Home</a>

                {{-- Dropdown --}}
                <div class="relative group h-full flex items-center">
                    <a href="{{ route('marketplace.index') }}" class="flex items-center gap-1 text-gray-300 hover:text-amber-500 transition font-medium pb-1 border-b-2 border-transparent hover:border-amber-500">
                        <span>Marketplace</span>
                        <i class="fas fa-chevron-down text-[10px] ml-1 transition-transform group-hover:rotate-180"></i>
                    </a>
                    <div class="absolute left-1/2 transform -translate-x-1/2 top-full mt-0 pt-4 hidden group-hover:block w-56 z-50">
                        <div class="bg-white shadow-2xl rounded-lg overflow-hidden border-t-4 border-amber-500">
                            <a href="{{ route('marketplace.index', ['category' => 'living-room']) }}" class="block px-6 py-3 text-gray-700 hover:bg-amber-50 hover:text-amber-600 transition border-b border-gray-100">
                                <i class="fas fa-couch w-6 text-center mr-2 text-amber-500"></i>Living Room
                            </a>
                            <a href="{{ route('marketplace.index', ['category' => 'bedroom']) }}" class="block px-6 py-3 text-gray-700 hover:bg-amber-50 hover:text-amber-600 transition border-b border-gray-100">
                                <i class="fas fa-bed w-6 text-center mr-2 text-amber-500"></i>Bedroom
                            </a>
                            <a href="{{ route('marketplace.index', ['category' => 'dining']) }}" class="block px-6 py-3 text-gray-700 hover:bg-amber-50 hover:text-amber-600 transition border-b border-gray-100">
                                <i class="fas fa-utensils w-6 text-center mr-2 text-amber-500"></i>Dining
                            </a>
                            <a href="{{ route('marketplace.index', ['category' => 'office']) }}" class="block px-6 py-3 text-gray-700 hover:bg-amber-50 hover:text-amber-600 transition">
                                <i class="fas fa-briefcase w-6 text-center mr-2 text-amber-500"></i>Office
                            </a>
                        </div>
                    </div>
                </div>

                <a href="{{ route('custom-furniture.index') }}" class="text-gray-300 hover:text-amber-500 transition font-medium pb-1 border-b-2 border-transparent hover:border-amber-500">Customize</a>
                <a href="{{ route('interior-design.index') }}" class="text-gray-300 hover:text-amber-500 transition font-medium pb-1 border-b-2 border-transparent hover:border-amber-500">Interior Design</a>
                <a href="{{ route('contact') }}" class="text-gray-300 hover:text-amber-500 transition font-medium pb-1 border-b-2 border-transparent hover:border-amber-500">Contact</a>
            </div>

            {{-- Icons --}}
            <div class="flex items-center gap-5">
                <button class="text-gray-300 hover:text-amber-500 transition hidden sm:block">
                    <i class="fas fa-search text-lg"></i>
                </button>
                <a href="{{ route('wishlist.index') }}" class="text-gray-300 hover:text-amber-500 transition">
                    <i class="far fa-heart text-lg"></i>
                </a>
                <a href="{{ route('cart.index') }}" class="relative text-gray-300 hover:text-amber-500 transition group">
                    <i class="fas fa-shopping-cart text-lg"></i>
                    <span class="absolute -top-2 -right-2 bg-amber-500 text-gray-900 text-[10px] rounded-full w-4 h-4 flex items-center justify-center font-bold group-hover:scale-110 transition-transform">2</span>
                </a>
                <a href="{{ route('login') }}" class="hidden md:flex items-center gap-2 bg-amber-600/10 hover:bg-amber-600 text-amber-500 hover:text-white px-4 py-2 rounded-full transition-all duration-300">
                    <i class="fas fa-user text-sm"></i>
                    <span class="text-sm font-semibold">Login</span>
                </a>
                {{-- Mobile Menu Button --}}
                <button id="mobile-menu-btn" class="lg:hidden text-white hover:text-amber-500 transition">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile Menu Overlay (Added) --}}
    <div id="mobile-menu" class="fixed inset-0 bg-gray-900/95 z-50 transform translate-x-full transition-transform duration-300 lg:hidden flex flex-col pt-20 px-6">
        <button id="close-mobile-menu" class="absolute top-6 right-6 text-white text-3xl hover:text-amber-500">
            <i class="fas fa-times"></i>
        </button>
        <a href="{{ route('home') }}" class="text-2xl font-bold text-white mb-6 hover:text-amber-500">Home</a>
        <a href="{{ route('marketplace.index') }}" class="text-2xl font-bold text-white mb-6 hover:text-amber-500">Marketplace</a>
        <a href="{{ route('custom-furniture.index') }}" class="text-2xl font-bold text-white mb-6 hover:text-amber-500">Customize</a>
        <a href="{{ route('interior-design.index') }}" class="text-2xl font-bold text-white mb-6 hover:text-amber-500">Interior Design</a>
        <a href="{{ route('contact') }}" class="text-2xl font-bold text-white mb-6 hover:text-amber-500">Contact</a>
    </div>
</nav>

{{-- 2. HERO SLIDER SECTION --}}
<section id="hero-slider" class="relative h-[85vh] overflow-hidden">
    {{-- Slide 1 --}}
    <div data-slide="1" class="absolute inset-0 bg-cover bg-center transition-all duration-1000 opacity-100 z-10 transform scale-100"
         style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?q=80&w=2000');">
        <div class="absolute inset-0 flex items-center justify-center">
            <div class="text-center text-white px-4 max-w-4xl mx-auto">
                <span class="inline-block py-1 px-3 border border-amber-500 text-amber-500 rounded-full text-sm font-bold tracking-widest uppercase mb-6 animate-slide-up">
                    New Collection 2025
                </span>
                <h1 class="text-5xl md:text-7xl lg:text-8xl font-extrabold mb-6 leading-tight animate-fade-in-slow tracking-tight">
                    Elegant <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-200 to-amber-500">Interior</span><br>
                    Designs Studio
                </h1>
                <p class="text-lg md:text-xl text-gray-200 mb-10 font-light max-w-2xl mx-auto animate-delay-1000">
                    Transform your space into a sanctuary of style and comfort with our premium furniture collection.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center animate-delay-1000">
                    <a href="{{ route('interior-design.index') }}" class="min-w-[180px] bg-amber-600 hover:bg-amber-700 text-white font-bold px-8 py-4 rounded-full transition-all transform hover:-translate-y-1 shadow-lg shadow-amber-600/30">
                        Start Project
                    </a>
                    <a href="{{ route('marketplace.index') }}" class="min-w-[180px] bg-transparent border-2 border-white hover:bg-white hover:text-gray-900 text-white font-bold px-8 py-4 rounded-full transition-all transform hover:-translate-y-1">
                        View Catalog
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Slide 2 (Example) --}}
    <div data-slide="2" class="absolute inset-0 bg-cover bg-center transition-all duration-1000 opacity-0 z-0 transform scale-105"
         style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://images.unsplash.com/photo-1578683010236-d716f9a3f461?q=80&w=2000');">
         {{-- Content same as slide 1 just different text --}}
         <div class="absolute inset-0 flex items-center justify-center">
            <div class="text-center text-white px-4 max-w-4xl mx-auto">
                <h1 class="text-5xl md:text-7xl lg:text-8xl font-extrabold mb-6 leading-tight">
                    Crafted for <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-200 to-amber-500">Luxury</span>
                </h1>
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mt-10">
                    <a href="{{ route('marketplace.index') }}" class="bg-amber-600 hover:bg-amber-700 text-white font-bold px-8 py-4 rounded-full transition-all">Shop Now</a>
                </div>
            </div>
        </div>
    </div>

    {{-- Slider Controls --}}
    <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 flex gap-4 z-20">
        <button data-slide-to="1" class="w-12 h-1 rounded-full bg-amber-500 transition-all"></button>
        <button data-slide-to="2" class="w-12 h-1 rounded-full bg-white/30 hover:bg-white transition-all"></button>
    </div>
</section>

{{-- 3. FEATURES STRIP --}}
<section class="py-16 bg-white border-b border-gray-100">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            {{-- Feature 1 --}}
            <div class="flex flex-col items-center text-center group cursor-default">
                <div class="w-16 h-16 rounded-full bg-amber-50 flex items-center justify-center mb-4 group-hover:bg-amber-500 transition-colors duration-300">
                    <i class="fas fa-truck text-amber-600 text-2xl group-hover:text-white transition-colors"></i>
                </div>
                <h3 class="font-bold text-gray-900 mb-1">Free Delivery</h3>
                <p class="text-sm text-gray-500">On orders over Rs. 50k</p>
            </div>
            {{-- Feature 2 --}}
            <div class="flex flex-col items-center text-center group cursor-default">
                <div class="w-16 h-16 rounded-full bg-amber-50 flex items-center justify-center mb-4 group-hover:bg-amber-500 transition-colors duration-300">
                    <i class="fas fa-shield-alt text-amber-600 text-2xl group-hover:text-white transition-colors"></i>
                </div>
                <h3 class="font-bold text-gray-900 mb-1">Warranty Protection</h3>
                <p class="text-sm text-gray-500">2 Year quality guarantee</p>
            </div>
            {{-- Feature 3 --}}
            <div class="flex flex-col items-center text-center group cursor-default">
                <div class="w-16 h-16 rounded-full bg-amber-50 flex items-center justify-center mb-4 group-hover:bg-amber-500 transition-colors duration-300">
                    <i class="fas fa-pencil-ruler text-amber-600 text-2xl group-hover:text-white transition-colors"></i>
                </div>
                <h3 class="font-bold text-gray-900 mb-1">Custom Design</h3>
                <p class="text-sm text-gray-500">Furniture made for you</p>
            </div>
            {{-- Feature 4 --}}
            <div class="flex flex-col items-center text-center group cursor-default">
                <div class="w-16 h-16 rounded-full bg-amber-50 flex items-center justify-center mb-4 group-hover:bg-amber-500 transition-colors duration-300">
                    <i class="fas fa-headset text-amber-600 text-2xl group-hover:text-white transition-colors"></i>
                </div>
                <h3 class="font-bold text-gray-900 mb-1">24/7 Support</h3>
                <p class="text-sm text-gray-500">Dedicated support team</p>
            </div>
        </div>
    </div>
</section>

{{-- 4. CATEGORY GRID --}}
<section class="py-24 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row justify-between items-end mb-12">
            <div>
                <span class="text-amber-600 font-bold tracking-widest text-sm uppercase">Collections</span>
                <h2 class="text-4xl font-extrabold text-gray-900 mt-2">Shop by Category</h2>
            </div>
            <a href="{{ route('marketplace.index') }}" class="hidden md:flex items-center text-gray-600 hover:text-amber-600 font-semibold transition">
                View All Categories <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            {{-- Category Card 1 --}}
            <a href="{{ route('marketplace.index', ['category' => 'living-room']) }}" class="group relative h-96 rounded-2xl overflow-hidden shadow-lg">
                <img src="https://images.unsplash.com/photo-1586023492125-27b2c045efd7?q=80&w=800" alt="Living Room" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent p-8 flex flex-col justify-end">
                    <h3 class="text-white text-2xl font-bold mb-2 translate-y-2 group-hover:translate-y-0 transition-transform">Living Room</h3>
                    <p class="text-gray-300 text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300">Sofas, Coffee Tables, TV Units</p>
                </div>
            </a>

            {{-- Category Card 2 --}}
            <a href="{{ route('marketplace.index', ['category' => 'bedroom']) }}" class="group relative h-96 rounded-2xl overflow-hidden shadow-lg">
                <img src="https://images.unsplash.com/photo-1616594039964-ae9021a400a0?q=80&w=800" alt="Bedroom" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent p-8 flex flex-col justify-end">
                    <h3 class="text-white text-2xl font-bold mb-2 translate-y-2 group-hover:translate-y-0 transition-transform">Bedroom</h3>
                    <p class="text-gray-300 text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300">Beds, Wardrobes, Nightstands</p>
                </div>
            </a>

            {{-- Category Card 3 --}}
            <a href="{{ route('marketplace.index', ['category' => 'office']) }}" class="group relative h-96 rounded-2xl overflow-hidden shadow-lg">
                <img src="https://images.unsplash.com/photo-1497366754035-f200968a6e72?q=80&w=800" alt="Office" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent p-8 flex flex-col justify-end">
                    <h3 class="text-white text-2xl font-bold mb-2 translate-y-2 group-hover:translate-y-0 transition-transform">Home Office</h3>
                    <p class="text-gray-300 text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300">Desks, Chairs, Storage</p>
                </div>
            </a>
        </div>
    </div>
</section>

{{-- 5. INTERIOR DESIGN SHOWCASE (Fixed Grid Structure) --}}
<section class="py-24 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-extrabold text-gray-900 mb-4">Interior Design <span class="text-amber-600">Showcase</span></h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Browse our portfolio of completed projects.</p>
        </div>

        {{-- The Grid: 1 Large Left, 2 Stacked Right --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 h-auto lg:h-[600px]">
            {{-- Left Column: Large Image --}}
            <a href="{{ route('interior-design.portfolio') }}" class="relative group rounded-2xl overflow-hidden shadow-xl h-96 lg:h-full block">
                <img src="https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?q=80&w=1200" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" alt="Minimalist Home">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-90"></div>
                <div class="absolute bottom-0 left-0 p-8 w-full">
                    <span class="bg-amber-600 text-white text-xs font-bold px-3 py-1 rounded-full mb-3 inline-block">Residential</span>
                    <h3 class="text-3xl font-bold text-white mb-2">Modern Minimalist Home</h3>
                    <p class="text-gray-300"><i class="fas fa-map-marker-alt text-amber-500 mr-2"></i>Colombo 03</p>
                </div>
            </a>

            {{-- Right Column: Stacked Images --}}
            <div class="flex flex-col gap-6 h-full">
                {{-- Top Right --}}
                <a href="{{ route('interior-design.portfolio') }}" class="relative group rounded-2xl overflow-hidden shadow-xl h-64 lg:h-1/2 block">
                    <img src="https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?q=80&w=800" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" alt="Luxury Villa">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-90"></div>
                    <div class="absolute bottom-0 left-0 p-6 w-full">
                        <h3 class="text-xl font-bold text-white mb-1">Luxury Kandy Villa</h3>
                        <p class="text-gray-300 text-sm">Full Renovation</p>
                    </div>
                </a>

                {{-- Bottom Right --}}
                <a href="{{ route('interior-design.portfolio') }}" class="relative group rounded-2xl overflow-hidden shadow-xl h-64 lg:h-1/2 block">
                    <img src="https://images.unsplash.com/photo-1497366754035-f200968a6e72?q=80&w=800" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" alt="Office Space">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-90"></div>
                    <div class="absolute bottom-0 left-0 p-6 w-full">
                        <h3 class="text-xl font-bold text-white mb-1">Tech Office Space</h3>
                        <p class="text-gray-300 text-sm">Commercial Design</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

{{-- 6. FOOTER (Dark Theme) --}}
<footer class="bg-gray-900 text-white pt-20 pb-10 border-t border-gray-800">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
            {{-- Brand --}}
            <div>
                <div class="flex items-center gap-2 mb-6">
                    <div class="w-8 h-8 bg-amber-600 rounded flex items-center justify-center">
                        <i class="fas fa-couch text-gray-900 text-sm"></i>
                    </div>
                    <span class="text-2xl font-bold tracking-wide">Calista<span class="text-amber-500">LK</span></span>
                </div>
                <p class="text-gray-400 leading-relaxed mb-6">
                    Redefining spaces with premium furniture and bespoke interior design solutions in Sri Lanka.
                </p>
                <div class="flex gap-4">
                    <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-amber-600 hover:text-white transition"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-amber-600 hover:text-white transition"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-amber-600 hover:text-white transition"><i class="fab fa-pinterest-p"></i></a>
                </div>
            </div>

            {{-- Links --}}
            <div>
                <h4 class="text-lg font-bold mb-6 text-white">Quick Links</h4>
                <ul class="space-y-3 text-gray-400">
                    <li><a href="#" class="hover:text-amber-500 transition">About Us</a></li>
                    <li><a href="#" class="hover:text-amber-500 transition">Marketplace</a></li>
                    <li><a href="#" class="hover:text-amber-500 transition">Interior Design</a></li>
                    <li><a href="#" class="hover:text-amber-500 transition">Contact</a></li>
                </ul>
            </div>

            {{-- Support --}}
            <div>
                <h4 class="text-lg font-bold mb-6 text-white">Customer Care</h4>
                <ul class="space-y-3 text-gray-400">
                    <li><a href="#" class="hover:text-amber-500 transition">FAQ</a></li>
                    <li><a href="#" class="hover:text-amber-500 transition">Shipping Policy</a></li>
                    <li><a href="#" class="hover:text-amber-500 transition">Returns</a></li>
                    <li><a href="#" class="hover:text-amber-500 transition">Privacy Policy</a></li>
                </ul>
            </div>

            {{-- Contact --}}
            <div>
                <h4 class="text-lg font-bold mb-6 text-white">Contact Us</h4>
                <ul class="space-y-4 text-gray-400">
                    <li class="flex items-start gap-3">
                        <i class="fas fa-map-marker-alt text-amber-500 mt-1"></i>
                        <span>123 Design District,<br>Colombo 07, Sri Lanka</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <i class="fas fa-phone-alt text-amber-500"></i>
                        <span>+94 11 234 5678</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <i class="fas fa-envelope text-amber-500"></i>
                        <span>hello@calistalk.com</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="border-t border-gray-800 pt-8 text-center text-gray-500 text-sm">
            <p>&copy; 2025 CalistaLK. All rights reserved.</p>
        </div>
    </div>
</footer>

@endsection

@push('scripts')
<script>
    // Toggle Mobile Menu
    const mobileBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const closeMenu = document.getElementById('close-mobile-menu');

    function toggleMenu() {
        const isHidden = mobileMenu.classList.contains('translate-x-full');
        if (isHidden) {
            mobileMenu.classList.remove('translate-x-full');
        } else {
            mobileMenu.classList.add('translate-x-full');
        }
    }

    mobileBtn.addEventListener('click', toggleMenu);
    closeMenu.addEventListener('click', toggleMenu);

    // Hero Slider Logic (Simplified for stability)
    let currentSlide = 1;
    const slides = document.querySelectorAll('[data-slide]');
    const indicators = document.querySelectorAll('[data-slide-to]');

    function showSlide(index) {
        slides.forEach(s => {
            s.classList.remove('opacity-100', 'z-10', 'scale-100');
            s.classList.add('opacity-0', 'z-0', 'scale-105'); // Add scale effect on hide
        });

        // Handle wrapping
        if (index > slides.length) index = 1;
        if (index < 1) index = slides.length;

        const active = document.querySelector(`[data-slide="${index}"]`);
        active.classList.remove('opacity-0', 'z-0', 'scale-105');
        active.classList.add('opacity-100', 'z-10', 'scale-100'); // Zoom in effect

        // Update indicators
        indicators.forEach(ind => {
            ind.classList.remove('bg-amber-500');
            ind.classList.add('bg-white/30');
        });
        document.querySelector(`[data-slide-to="${index}"]`).classList.remove('bg-white/30');
        document.querySelector(`[data-slide-to="${index}"]`).classList.add('bg-amber-500');

        currentSlide = index;
    }

    // Auto rotate
    setInterval(() => {
        showSlide(currentSlide + 1);
    }, 6000);

    // Click events for indicators
    indicators.forEach(ind => {
        ind.addEventListener('click', (e) => {
            const index = parseInt(e.target.getAttribute('data-slide-to'));
            showSlide(index);
        });
    });
</script>
@endpush
