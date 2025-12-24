<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CalistaLK - Elegant Interior Designs & Furniture</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        serif: ['Playfair Display', 'serif'],
                    },
                    colors: {
                        amber: {
                            50: '#fffbeb',
                            100: '#fef3c7',
                            200: '#fde68a',
                            300: '#fcd34d',
                            400: '#fbbf24',
                            500: '#f59e0b',
                            600: '#d97706',
                            700: '#b45309',
                            800: '#92400e',
                            900: '#78350f',
                        }
                    }
                }
            }
        }
    </script>

    <style>
        /* Custom Animations */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up {
            animation: fadeInUp 1s ease-out forwards;
            opacity: 0;
        }
        .delay-100 { animation-delay: 0.2s; }
        .delay-200 { animation-delay: 0.4s; }
        .delay-300 { animation-delay: 0.6s; }

        /* Slider Transition */
        .slider-image {
            transition: opacity 1.5s ease-in-out;
        }
    </style>
</head>
<body class="antialiased text-gray-800">

    {{-- 1. HERO SECTION & NAVBAR --}}
    <div class="relative w-full h-screen overflow-hidden bg-gray-900">

        {{-- Custom Transparent Navbar --}}
        {{-- Custom Transparent Navbar --}}
        <nav class="absolute top-0 left-0 w-full z-50 flex justify-between items-center px-6 py-6 md:px-12 text-white bg-gradient-to-b from-black/80 to-transparent">
            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                <div class="w-10 h-10 bg-amber-600/20 backdrop-blur-md border border-amber-500/30 rounded-lg flex items-center justify-center">
                    <span class="text-amber-500 font-serif font-bold text-xl">C</span>
                </div>
                <span class="text-2xl font-serif font-bold tracking-widest">
                    CALISTA<span class="text-amber-500">.</span>
                </span>
            </a>

            {{-- Desktop Menu (Updated List) --}}
            <div class="hidden lg:flex items-center space-x-6 text-sm font-medium tracking-widest uppercase">
                <a href="{{ route('home') }}" class="text-amber-500 border-b border-amber-500 pb-1">
                    Home
                </a>

                <a href="{{ route('marketplace.index') }}" class="hover:text-amber-400 transition hover:-translate-y-0.5 transform duration-300">
                    Marketplace
                </a>

                <a href="{{ route('custom-furniture.index') }}" class="hover:text-amber-400 transition hover:-translate-y-0.5 transform duration-300">
                    Customize
                </a>

                <a href="{{ route('interior-design.index') }}" class="hover:text-amber-400 transition hover:-translate-y-0.5 transform duration-300">
                    Interior Design
                </a>

                <a href="{{ route('about') }}" class="hover:text-amber-400 transition hover:-translate-y-0.5 transform duration-300">
                    About
                </a>

                <a href="{{ route('contact') }}" class="hover:text-amber-400 transition hover:-translate-y-0.5 transform duration-300">
                    Contact
                </a>
            </div>

            {{-- Icons --}}
            <div class="flex items-center space-x-6">
                <a href="{{ route('marketplace.search') }}" class="hover:text-amber-400 transition"><i class="fas fa-search text-lg"></i></a>

                <a href="{{ route('cart.index') }}" class="hover:text-amber-400 transition relative group">
                    <i class="fas fa-shopping-bag text-lg group-hover:scale-110 transition"></i>
                    <span class="absolute -top-2 -right-2 bg-amber-600 text-white text-[10px] font-bold w-4 h-4 rounded-full flex items-center justify-center">0</span>
                </a>

                {{-- Mobile Menu Button --}}
                <button class="lg:hidden text-2xl"><i class="fas fa-bars"></i></button>
            </div>
        </nav>

        {{-- Slider Images --}}
        <div class="relative w-full h-full">
            <div class="absolute inset-0 w-full h-full bg-cover bg-center slider-image opacity-100"
                 style="background-image: url('https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?q=80&w=2000');">
                <div class="absolute inset-0 bg-black/40"></div>
            </div>

            <div class="absolute inset-0 w-full h-full bg-cover bg-center slider-image opacity-0"
                 style="background-image: url('https://images.unsplash.com/photo-1616486338812-3dadae4b4f9d?q=80&w=2000');">
                <div class="absolute inset-0 bg-black/40"></div>
            </div>

            {{-- Hero Content --}}
            <div class="absolute inset-0 flex flex-col items-center justify-center text-center text-white z-10 px-4 mt-16">
                <div class="inline-block border border-amber-500/50 px-4 py-1 rounded-full mb-6 backdrop-blur-sm animate-fade-in-up">
                    <p class="text-amber-400 tracking-[0.3em] text-xs md:text-sm font-bold uppercase">Premium Furniture Collection</p>
                </div>

                <h1 class="text-5xl md:text-7xl lg:text-8xl font-serif font-bold mb-6 leading-tight animate-fade-in-up delay-100">
                    Elegant Interior <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-200 via-amber-400 to-amber-600">Unique Lifestyle</span>
                </h1>

                <p class="text-gray-300 max-w-2xl text-lg mb-10 font-light animate-fade-in-up delay-200">
                    Experience the perfect harmony of luxury and comfort. We craft spaces that tell your unique story.
                </p>

                <div class="flex flex-col md:flex-row gap-5 animate-fade-in-up delay-300">
                    <a href="{{ route('marketplace.index') }}" class="group relative px-8 py-4 bg-amber-600 text-white font-medium tracking-wider overflow-hidden">
                        <div class="absolute inset-0 w-full h-full bg-amber-700 transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left duration-300"></div>
                        <span class="relative z-10 flex items-center gap-2">SHOP NOW <i class="fas fa-arrow-right text-sm"></i></span>
                    </a>
                    <a href="{{ route('interior-design.index') }}" class="group px-8 py-4 border border-white text-white font-medium tracking-wider hover:bg-white hover:text-gray-900 transition duration-300">
                        VIEW PORTFOLIO
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- 2. FEATURES STRIP --}}
    <div class="bg-white py-16 border-b border-gray-100 relative z-20 -mt-8 mx-4 md:mx-12 rounded-lg shadow-xl">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center divide-y md:divide-y-0 md:divide-x divide-gray-100">
            <div class="p-4 group cursor-default">
                <div class="w-16 h-16 bg-amber-50 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-amber-600 transition duration-300">
                    <i class="fas fa-truck text-2xl text-amber-600 group-hover:text-white transition"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900 uppercase tracking-wide">Free Shipping</h3>
                <p class="text-gray-500 text-sm mt-2">On all island-wide orders over Rs. 50,000</p>
            </div>
            <div class="p-4 group cursor-default">
                <div class="w-16 h-16 bg-amber-50 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-amber-600 transition duration-300">
                    <i class="fas fa-undo text-2xl text-amber-600 group-hover:text-white transition"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900 uppercase tracking-wide">Return Policy</h3>
                <p class="text-gray-500 text-sm mt-2">Hassle-free 30-day return policy</p>
            </div>
            <div class="p-4 group cursor-default">
                <div class="w-16 h-16 bg-amber-50 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-amber-600 transition duration-300">
                    <i class="fas fa-headset text-2xl text-amber-600 group-hover:text-white transition"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900 uppercase tracking-wide">24/7 Support</h3>
                <p class="text-gray-500 text-sm mt-2">Dedicated support team for your needs</p>
            </div>
        </div>
    </div>

    {{-- 3. CATEGORY COLLECTION --}}
    <section class="py-24 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <span class="text-amber-600 font-bold tracking-[0.2em] text-xs uppercase block mb-2">Collections</span>
                <h2 class="text-4xl md:text-5xl font-serif font-bold text-gray-900">Curated For You</h2>
                <div class="w-24 h-1 bg-amber-600 mx-auto mt-6"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                {{-- Category 1 --}}
                <a href="{{ route('marketplace.index', ['category' => 'living-room']) }}" class="group relative h-[450px] overflow-hidden rounded-sm">
                    <img src="https://images.unsplash.com/photo-1567016432779-094069958ea5?q=80&w=800" alt="Living Room" class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-80 group-hover:opacity-90 transition"></div>
                    <div class="absolute bottom-10 left-8">
                        <h3 class="text-3xl font-serif text-white mb-2 translate-y-4 group-hover:translate-y-0 transition duration-500">Living Room</h3>
                        <p class="text-gray-300 mb-4 opacity-0 group-hover:opacity-100 transition duration-500 delay-75 transform translate-y-4 group-hover:translate-y-0">Sofas, Coffee Tables & More</p>
                        <span class="text-amber-400 text-sm tracking-wider font-bold border-b border-amber-400 pb-1">EXPLORE COLLECTION</span>
                    </div>
                </a>

                {{-- Category 2 (Featured) --}}
                <a href="{{ route('marketplace.index', ['category' => 'bedroom']) }}" class="group relative h-[450px] lg:h-[500px] lg:-mt-6 overflow-hidden rounded-sm shadow-2xl z-10">
                    <img src="https://images.unsplash.com/photo-1505693314120-0d443867891c?q=80&w=800" alt="Bedroom" class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-80 group-hover:opacity-90 transition"></div>
                    <div class="absolute top-6 right-6 bg-amber-600 text-white text-xs font-bold px-3 py-1 uppercase tracking-wider">Most Popular</div>
                    <div class="absolute bottom-10 left-8">
                        <h3 class="text-3xl font-serif text-white mb-2 translate-y-4 group-hover:translate-y-0 transition duration-500">Bedroom Suites</h3>
                        <p class="text-gray-300 mb-4 opacity-0 group-hover:opacity-100 transition duration-500 delay-75 transform translate-y-4 group-hover:translate-y-0">Luxury Beds & Wardrobes</p>
                        <span class="text-amber-400 text-sm tracking-wider font-bold border-b border-amber-400 pb-1">EXPLORE COLLECTION</span>
                    </div>
                </a>

                {{-- Category 3 --}}
                <a href="{{ route('marketplace.index', ['category' => 'dining']) }}" class="group relative h-[450px] overflow-hidden rounded-sm">
                    <img src="https://images.unsplash.com/photo-1617103996702-96ff29b1c467?q=80&w=800" alt="Dining" class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-80 group-hover:opacity-90 transition"></div>
                    <div class="absolute bottom-10 left-8">
                        <h3 class="text-3xl font-serif text-white mb-2 translate-y-4 group-hover:translate-y-0 transition duration-500">Dining Area</h3>
                        <p class="text-gray-300 mb-4 opacity-0 group-hover:opacity-100 transition duration-500 delay-75 transform translate-y-4 group-hover:translate-y-0">Tables, Chairs & Sets</p>
                        <span class="text-amber-400 text-sm tracking-wider font-bold border-b border-amber-400 pb-1">EXPLORE COLLECTION</span>
                    </div>
                </a>
            </div>
        </div>
    </section>

    {{-- 4. NEW ARRIVALS --}}
    <section class="py-24 bg-white">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12">
                <div>
                    <h2 class="text-3xl md:text-4xl font-serif font-bold text-gray-900">New Arrivals</h2>
                    <p class="text-gray-500 mt-2">Exclusive pieces freshly added to our catalog</p>
                </div>
                <a href="{{ route('marketplace.index') }}" class="mt-4 md:mt-0 px-6 py-2 border border-gray-300 text-gray-700 hover:bg-black hover:text-white hover:border-black transition duration-300">View All Products</a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                {{-- Product 1 --}}
                <div class="group cursor-pointer">
                    <div class="relative h-[350px] bg-gray-100 overflow-hidden mb-4">
                        <img src="https://images.unsplash.com/photo-1555041469-a586c61ea9bc?q=80&w=600" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" alt="Sofa">
                        <div class="absolute top-4 right-4 translate-x-10 group-hover:translate-x-0 transition duration-300">
                            <button class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow hover:bg-amber-600 hover:text-white transition"><i class="far fa-heart"></i></button>
                        </div>
                        <div class="absolute bottom-0 left-0 w-full bg-white/95 backdrop-blur p-4 translate-y-full group-hover:translate-y-0 transition duration-300 border-t border-gray-100">
                            <button class="w-full bg-gray-900 text-white py-2 text-sm uppercase tracking-wide hover:bg-amber-600 transition">Add to Cart</button>
                        </div>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 group-hover:text-amber-600 transition">Velvet Armchair</h3>
                    <p class="text-gray-500 font-serif mt-1">Rs. 45,000</p>
                </div>

                {{-- Product 2 --}}
                <div class="group cursor-pointer">
                    <div class="relative h-[350px] bg-gray-100 overflow-hidden mb-4">
                        <img src="https://images.unsplash.com/photo-1592078615290-033ee584e267?q=80&w=600" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" alt="Chair">
                        <span class="absolute top-4 left-4 bg-gray-900 text-white text-[10px] font-bold px-3 py-1 uppercase tracking-wide">New</span>
                        <div class="absolute bottom-0 left-0 w-full bg-white/95 backdrop-blur p-4 translate-y-full group-hover:translate-y-0 transition duration-300 border-t border-gray-100">
                            <button class="w-full bg-gray-900 text-white py-2 text-sm uppercase tracking-wide hover:bg-amber-600 transition">Add to Cart</button>
                        </div>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 group-hover:text-amber-600 transition">Modern Dining Chair</h3>
                    <p class="text-gray-500 font-serif mt-1">Rs. 18,500</p>
                </div>

                {{-- Product 3 --}}
                <div class="group cursor-pointer">
                    <div class="relative h-[350px] bg-gray-100 overflow-hidden mb-4">
                        <img src="https://images.unsplash.com/photo-1532323544230-7191fd51bc1b?q=80&w=600" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" alt="Lamp">
                        <div class="absolute bottom-0 left-0 w-full bg-white/95 backdrop-blur p-4 translate-y-full group-hover:translate-y-0 transition duration-300 border-t border-gray-100">
                            <button class="w-full bg-gray-900 text-white py-2 text-sm uppercase tracking-wide hover:bg-amber-600 transition">Add to Cart</button>
                        </div>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 group-hover:text-amber-600 transition">Minimalist Lamp</h3>
                    <p class="text-gray-500 font-serif mt-1">Rs. 12,000</p>
                </div>

                 {{-- Product 4 --}}
                 <div class="group cursor-pointer">
                    <div class="relative h-[350px] bg-gray-100 overflow-hidden mb-4">
                        <img src="https://images.unsplash.com/photo-1503602642458-2321114458ed?q=80&w=600" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" alt="Table">
                        <div class="absolute bottom-0 left-0 w-full bg-white/95 backdrop-blur p-4 translate-y-full group-hover:translate-y-0 transition duration-300 border-t border-gray-100">
                            <button class="w-full bg-gray-900 text-white py-2 text-sm uppercase tracking-wide hover:bg-amber-600 transition">Add to Cart</button>
                        </div>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 group-hover:text-amber-600 transition">Coffee Table</h3>
                    <p class="text-gray-500 font-serif mt-1">Rs. 28,000</p>
                </div>
            </div>
        </div>
    </section>

    {{-- 5. BEAUTIFUL FOOTER (Single, Fixed) --}}
    <footer class="bg-[#0f0f0f] text-white pt-20 pb-10 border-t border-gray-900">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
                {{-- Column 1: Brand --}}
                <div class="space-y-6">
                    <a href="#" class="flex items-center gap-2 group">
                        <div class="w-10 h-10 bg-amber-600 rounded-lg flex items-center justify-center text-white font-serif font-bold text-xl">C</div>
                        <span class="text-2xl font-serif font-bold tracking-widest">
                            CALISTA<span class="text-amber-600">.</span>
                        </span>
                    </a>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Redefining luxury living with exceptional furniture and interior design services tailored to your unique lifestyle.
                    </p>
                    <div class="flex gap-4 pt-2">
                        <a href="#" class="w-10 h-10 border border-gray-800 rounded-full flex items-center justify-center text-gray-400 hover:bg-amber-600 hover:border-amber-600 hover:text-white transition duration-300"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="w-10 h-10 border border-gray-800 rounded-full flex items-center justify-center text-gray-400 hover:bg-amber-600 hover:border-amber-600 hover:text-white transition duration-300"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="w-10 h-10 border border-gray-800 rounded-full flex items-center justify-center text-gray-400 hover:bg-amber-600 hover:border-amber-600 hover:text-white transition duration-300"><i class="fab fa-pinterest-p"></i></a>
                    </div>
                </div>

                {{-- Column 2: Links --}}
                <div>
                    <h4 class="text-lg font-medium mb-6 text-white border-b-2 border-amber-600 inline-block pb-1">Quick Links</h4>
                    <ul class="space-y-4 text-gray-400 text-sm">
                        <li><a href="{{ route('home') }}" class="hover:text-amber-500 transition flex items-center gap-2"><i class="fas fa-chevron-right text-[10px] text-amber-600"></i> Home</a></li>
                        <li><a href="{{ route('marketplace.index') }}" class="hover:text-amber-500 transition flex items-center gap-2"><i class="fas fa-chevron-right text-[10px] text-amber-600"></i> Shop Collection</a></li>
                        <li><a href="{{ route('interior-design.index') }}" class="hover:text-amber-500 transition flex items-center gap-2"><i class="fas fa-chevron-right text-[10px] text-amber-600"></i> Interior Design</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-amber-500 transition flex items-center gap-2"><i class="fas fa-chevron-right text-[10px] text-amber-600"></i> About Us</a></li>
                    </ul>
                </div>

                {{-- Column 3: Customer Service --}}
                <div>
                    <h4 class="text-lg font-medium mb-6 text-white border-b-2 border-amber-600 inline-block pb-1">Customer Care</h4>
                    <ul class="space-y-4 text-gray-400 text-sm">
                        <li><a href="#" class="hover:text-amber-500 transition">Frequently Asked Questions</a></li>
                        <li><a href="#" class="hover:text-amber-500 transition">Shipping & Delivery</a></li>
                        <li><a href="#" class="hover:text-amber-500 transition">Returns & Exchanges</a></li>
                        <li><a href="#" class="hover:text-amber-500 transition">Terms & Conditions</a></li>
                    </ul>
                </div>

                {{-- Column 4: Contact --}}
                <div>
                    <h4 class="text-lg font-medium mb-6 text-white border-b-2 border-amber-600 inline-block pb-1">Contact Us</h4>
                    <ul class="space-y-5 text-gray-400 text-sm">
                        <li class="flex items-start gap-3">
                            <div class="mt-1 w-8 h-8 rounded bg-gray-800 flex items-center justify-center shrink-0">
                                <i class="fas fa-map-marker-alt text-amber-500"></i>
                            </div>
                            <span>123 Havelock Road,<br>Colombo 05, Sri Lanka</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded bg-gray-800 flex items-center justify-center shrink-0">
                                <i class="fas fa-phone-alt text-amber-500"></i>
                            </div>
                            <span>+94 11 234 5678</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded bg-gray-800 flex items-center justify-center shrink-0">
                                <i class="fas fa-envelope text-amber-500"></i>
                            </div>
                            <span>hello@calista.lk</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center text-gray-500 text-xs">
                <p>&copy; 2025 CalistaLK. All rights reserved.</p>
                <p class="flex items-center gap-1 mt-2 md:mt-0">Designed with <i class="fas fa-heart text-amber-600 animate-pulse"></i> in Sri Lanka</p>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const slides = document.querySelectorAll('.slider-image');
            let currentSlide = 0;

            setInterval(() => {
                slides[currentSlide].classList.remove('opacity-100');
                slides[currentSlide].classList.add('opacity-0');
                currentSlide = (currentSlide + 1) % slides.length;
                slides[currentSlide].classList.remove('opacity-0');
                slides[currentSlide].classList.add('opacity-100');
            }, 5000);
        });
    </script>
</body>
</html>
