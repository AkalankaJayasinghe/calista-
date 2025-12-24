@extends('layouts.app')

@section('title', 'Custom Furniture - Design Your Dream Pieces')

@section('content')

<!-- Hero Section - Full Screen -->
<section class="relative min-h-screen bg-gradient-to-br from-yellow-900 via-yellow-800 to-gray-900 z-0 overflow-hidden pt-32">
    <!-- Animated Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 -left-4 w-96 h-96 bg-yellow-500 rounded-full mix-blend-multiply filter blur-xl animate-blob"></div>
        <div class="absolute top-0 -right-4 w-96 h-96 bg-orange-500 rounded-full mix-blend-multiply filter blur-xl animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-8 left-20 w-96 h-96 bg-red-500 rounded-full mix-blend-multiply filter blur-xl animate-blob animation-delay-4000"></div>
    </div>

    <!-- Background Image with Overlay -->
    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1556228578-0d85b1a4d571?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');">
        <div class="absolute inset-0 bg-gradient-to-r from-black via-black/90 to-transparent"></div>
    </div>

    <!-- Hero Content -->
    <div class="relative container mx-auto px-4 py-20">
        <div class="max-w-4xl animate-fade-in-up">
            <div class="mb-6">
                <span class="inline-block px-6 py-3 bg-yellow-600/30 border-2 border-yellow-600 rounded-full text-yellow-400 text-sm font-bold mb-4 animate-pulse">
                    ✨ BESPOKE FURNITURE CRAFTSMANSHIP
                </span>
            </div>
            <h1 class="text-7xl font-bold mb-8 leading-tight text-white">
                Create Your Dream <span class="text-yellow-400">Furniture</span>
            </h1>
            <p class="text-2xl mb-10 text-gray-300 leading-relaxed max-w-3xl">
                Work with expert craftsmen to design and build custom furniture perfectly tailored to your space, style, and budget. From concept to delivery.
            </p>

            <!-- CTA Buttons -->
            <div class="flex flex-wrap gap-6 mb-12">
                <a href="{{ route('custom-furniture.request') }}" class="group bg-yellow-600 hover:bg-yellow-700 text-white px-12 py-5 rounded-full font-bold transition-all duration-300 transform hover:scale-105 shadow-2xl hover:shadow-yellow-600/50 flex items-center gap-3 text-lg">
                    <i class="fas fa-pencil-ruler text-2xl"></i>
                    <span>Start Your Project</span>
                    <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                </a>
                <a href="#how-it-works" class="group bg-white/10 backdrop-blur-sm hover:bg-white/20 border-2 border-white text-white px-12 py-5 rounded-full font-bold transition-all duration-300 transform hover:scale-105 shadow-2xl flex items-center gap-3 text-lg">
                    <i class="fas fa-play-circle text-2xl"></i>
                    <span>How It Works</span>
                </a>
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 pt-12 border-t border-white/20">
                <div class="animate-fade-in">
                    <div class="text-5xl font-bold text-yellow-400 mb-2">500+</div>
                    <div class="text-gray-400 text-lg">Projects Completed</div>
                </div>
                <div class="animate-fade-in animation-delay-200">
                    <div class="text-5xl font-bold text-yellow-400 mb-2">50+</div>
                    <div class="text-gray-400 text-lg">Expert Craftsmen</div>
                </div>
                <div class="animate-fade-in animation-delay-400">
                    <div class="text-5xl font-bold text-yellow-400 mb-2">100%</div>
                    <div class="text-gray-400 text-lg">Custom Made</div>
                </div>
                <div class="animate-fade-in animation-delay-600">
                    <div class="text-5xl font-bold text-yellow-400 mb-2">4-6</div>
                    <div class="text-gray-400 text-lg">Weeks Delivery</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scroll Down Indicator -->
    <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce">
        <a href="#how-it-works" class="text-white text-center block hover:text-yellow-400 transition">
            <i class="fas fa-chevron-down text-3xl"></i>
            <p class="text-sm mt-2 font-medium">Discover More</p>
        </a>
    </div>
</section>

<!-- How It Works -->
<section id="how-it-works" class="py-20 bg-white relative overflow-hidden">
    <!-- Background Decoration -->
    <div class="absolute top-0 right-0 w-96 h-96 bg-yellow-100 rounded-full -mr-48 -mt-48 opacity-30"></div>
    <div class="absolute bottom-0 left-0 w-96 h-96 bg-yellow-50 rounded-full -ml-48 -mb-48 opacity-50"></div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center mb-16 animate-fade-in">
            <span class="inline-block px-4 py-2 bg-yellow-100 text-yellow-600 rounded-full text-sm font-semibold mb-4">
                SIMPLE PROCESS
            </span>
            <h2 class="text-5xl font-bold mb-4 text-gray-900">How It Works</h2>
            <p class="text-gray-600 text-xl max-w-2xl mx-auto">Four simple steps to bring your custom furniture vision to life</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 relative">
            <!-- Connecting Lines (hidden on mobile) -->
            <div class="hidden md:block absolute top-16 left-0 right-0 h-1 bg-gradient-to-r from-yellow-200 via-yellow-400 to-yellow-200" style="top: 4rem;"></div>

            <!-- Step 1 -->
            <div class="relative text-center group">
                <div class="relative z-10 w-32 h-32 bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-full flex items-center justify-center mx-auto mb-6 transform group-hover:scale-110 transition-all duration-500 shadow-2xl group-hover:shadow-yellow-600/50">
                    <span class="text-5xl font-bold text-white">1</span>
                </div>
                <div class="bg-white rounded-2xl p-6 shadow-lg group-hover:shadow-2xl transition-all duration-500 border border-gray-100 group-hover:border-yellow-400">
                    <h3 class="text-2xl font-bold mb-3 text-gray-900 group-hover:text-yellow-600 transition">Submit Request</h3>
                    <p class="text-gray-600 leading-relaxed">Describe your furniture needs, dimensions, style preferences, and upload design inspiration</p>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="relative text-center group">
                <div class="relative z-10 w-32 h-32 bg-gradient-to-br from-yellow-500 to-yellow-700 rounded-full flex items-center justify-center mx-auto mb-6 transform group-hover:scale-110 transition-all duration-500 shadow-2xl group-hover:shadow-yellow-600/50">
                    <span class="text-5xl font-bold text-white">2</span>
                </div>
                <div class="bg-white rounded-2xl p-6 shadow-lg group-hover:shadow-2xl transition-all duration-500 border border-gray-100 group-hover:border-yellow-400">
                    <h3 class="text-2xl font-bold mb-3 text-gray-900 group-hover:text-yellow-600 transition">Get Quotations</h3>
                    <p class="text-gray-600 leading-relaxed">Receive detailed quotes from multiple skilled workshops with timelines and material options</p>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="relative text-center group">
                <div class="relative z-10 w-32 h-32 bg-gradient-to-br from-yellow-600 to-orange-600 rounded-full flex items-center justify-center mx-auto mb-6 transform group-hover:scale-110 transition-all duration-500 shadow-2xl group-hover:shadow-yellow-600/50">
                    <span class="text-5xl font-bold text-white">3</span>
                </div>
                <div class="bg-white rounded-2xl p-6 shadow-lg group-hover:shadow-2xl transition-all duration-500 border border-gray-100 group-hover:border-yellow-400">
                    <h3 class="text-2xl font-bold mb-3 text-gray-900 group-hover:text-yellow-600 transition">Choose Workshop</h3>
                    <p class="text-gray-600 leading-relaxed">Compare options, review workshop ratings, and select the best craftsman for your project</p>
                </div>
            </div>

            <!-- Step 4 -->
            <div class="relative text-center group">
                <div class="relative z-10 w-32 h-32 bg-gradient-to-br from-orange-500 to-red-600 rounded-full flex items-center justify-center mx-auto mb-6 transform group-hover:scale-110 transition-all duration-500 shadow-2xl group-hover:shadow-yellow-600/50">
                    <span class="text-5xl font-bold text-white">4</span>
                </div>
                <div class="bg-white rounded-2xl p-6 shadow-lg group-hover:shadow-2xl transition-all duration-500 border border-gray-100 group-hover:border-yellow-400">
                    <h3 class="text-2xl font-bold mb-3 text-gray-900 group-hover:text-yellow-600 transition">Delivery & Setup</h3>
                    <p class="text-gray-600 leading-relaxed">Get your custom furniture delivered and professionally installed at your location</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Custom Works -->
<section class="py-20 bg-gradient-to-b from-gray-50 to-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16 animate-fade-in">
            <span class="inline-block px-4 py-2 bg-yellow-100 text-yellow-600 rounded-full text-sm font-semibold mb-3">
                PORTFOLIO
            </span>
            <h2 class="text-5xl font-bold mb-4 text-gray-900">Featured Custom Projects</h2>
            <p class="text-gray-600 text-xl max-w-2xl mx-auto">Explore stunning custom furniture pieces crafted by our expert workshops</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @php
            $projects = [
                ['name' => 'Custom Dining Table', 'desc' => 'Solid teak wood with modern design', 'price' => 225000, 'weeks' => 4, 'img' => 'photo-1617098900591-3f90928e8c54'],
                ['name' => 'Luxury Bed Frame', 'desc' => 'King size with upholstered headboard', 'price' => 250000, 'weeks' => 5, 'img' => 'photo-1505693416388-ac5ce068fe85'],
                ['name' => 'Office Desk Setup', 'desc' => 'Mahogany wood with storage drawers', 'price' => 275000, 'weeks' => 4, 'img' => 'photo-1595428774223-ef52624120d2'],
                ['name' => 'Modular Wardrobe', 'desc' => 'Walk-in closet with sliding doors', 'price' => 300000, 'weeks' => 6, 'img' => 'photo-1595428774223-ef52624120d2'],
                ['name' => 'Living Room Set', 'desc' => 'Custom sofa with matching coffee table', 'price' => 325000, 'weeks' => 5, 'img' => 'photo-1555041469-a586c61ea9bc'],
                ['name' => 'Kitchen Cabinets', 'desc' => 'Full kitchen remodel with island', 'price' => 350000, 'weeks' => 6, 'img' => 'photo-1556912173-46c336c7fd55']
            ];
            @endphp

            @foreach($projects as $index => $project)
            <div class="group bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                <div class="relative overflow-hidden h-72">
                    <img src="https://images.unsplash.com/{{ $project['img'] }}?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
                         alt="{{ $project['name'] }}"
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                    <!-- Overlay Info -->
                    <div class="absolute bottom-4 left-4 right-4 transform translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-500">
                        <div class="flex items-center gap-2 text-white text-sm mb-2">
                            <i class="fas fa-check-circle text-green-400"></i>
                            <span>Completed Project</span>
                        </div>
                    </div>

                    <!-- Badge -->
                    @if($index < 2)
                    <span class="absolute top-4 left-4 bg-yellow-600 text-white px-4 py-2 rounded-full text-sm font-bold shadow-lg">
                        ⭐ Featured
                    </span>
                    @endif
                </div>

                <div class="p-6">
                    <h3 class="font-bold text-xl mb-2 text-gray-900 group-hover:text-yellow-600 transition">{{ $project['name'] }}</h3>
                    <p class="text-gray-600 mb-4 leading-relaxed">{{ $project['desc'] }}</p>

                    <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                        <div>
                            <div class="text-sm text-gray-500 mb-1">Starting From</div>
                            <div class="text-2xl font-bold text-gray-900">Rs. {{ number_format($project['price']) }}</div>
                        </div>
                        <div class="text-right">
                            <div class="text-sm text-gray-500 mb-1">Timeline</div>
                            <div class="text-lg font-semibold text-yellow-600">{{ $project['weeks'] }} weeks</div>
                        </div>
                    </div>

                    <button class="w-full mt-4 bg-gray-900 hover:bg-yellow-600 text-white py-3 rounded-xl transition-all duration-300 font-semibold transform hover:scale-105 shadow-lg hover:shadow-yellow-600/50 flex items-center justify-center gap-2">
                        <i class="fas fa-pencil-ruler"></i>
                        <span>Request Quote</span>
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Featured Workshops -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16 animate-fade-in">
            <span class="inline-block px-4 py-2 bg-yellow-100 text-yellow-600 rounded-full text-sm font-semibold mb-3">
                TOP CRAFTSMEN
            </span>
            <h2 class="text-5xl font-bold mb-4 text-gray-900">Top-Rated Workshops</h2>
            <p class="text-gray-600 text-xl max-w-2xl mx-auto">Meet our verified expert craftsmen with years of experience</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @php
            $workshops = [
                ['name' => 'Premium Wood Works', 'rating' => 5.0, 'reviews' => 128, 'projects' => 250, 'specialty' => 'Teak & Mahogany', 'experience' => 15],
                ['name' => 'Modern Craft Studio', 'rating' => 4.9, 'reviews' => 95, 'projects' => 180, 'specialty' => 'Contemporary Design', 'experience' => 12],
                ['name' => 'Heritage Furniture', 'rating' => 5.0, 'reviews' => 156, 'projects' => 320, 'specialty' => 'Classic & Vintage', 'experience' => 20]
            ];
            @endphp

            @foreach($workshops as $workshop)
            <div class="group relative bg-gradient-to-br from-gray-50 to-white rounded-2xl p-8 hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:border-yellow-400 transform hover:-translate-y-2">
                <div class="absolute top-0 right-0 w-32 h-32 bg-yellow-400 rounded-bl-full opacity-0 group-hover:opacity-10 transition-opacity duration-500"></div>

                <div class="relative">
                    <!-- Workshop Logo/Badge -->
                    <div class="flex items-center mb-6">
                        <div class="w-20 h-20 bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-2xl flex items-center justify-center text-white text-3xl font-bold shadow-lg mr-4 transform group-hover:rotate-6 transition-transform">
                            {{ substr($workshop['name'], 0, 1) }}
                        </div>
                        <div>
                            <h3 class="font-bold text-xl text-gray-900 group-hover:text-yellow-600 transition">{{ $workshop['name'] }}</h3>
                            <div class="flex items-center gap-2 mt-1">
                                <div class="flex text-yellow-500 text-sm">
                                    @for($i = 0; $i < 5; $i++)
                                    <i class="fas fa-star"></i>
                                    @endfor
                                </div>
                                <span class="text-gray-600 text-sm font-semibold">({{ $workshop['rating'] }})</span>
                            </div>
                        </div>
                    </div>

                    <p class="text-gray-600 mb-6 leading-relaxed">Specializing in custom wood furniture with exceptional craftsmanship and attention to detail</p>

                    <!-- Stats -->
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div class="bg-white rounded-xl p-4 border border-gray-100">
                            <div class="text-2xl font-bold text-gray-900">{{ $workshop['projects'] }}+</div>
                            <div class="text-sm text-gray-500">Projects</div>
                        </div>
                        <div class="bg-white rounded-xl p-4 border border-gray-100">
                            <div class="text-2xl font-bold text-gray-900">{{ $workshop['reviews'] }}</div>
                            <div class="text-sm text-gray-500">Reviews</div>
                        </div>
                    </div>

                    <!-- Specialties -->
                    <div class="flex flex-wrap gap-2 mb-6">
                        <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-sm font-semibold">
                            <i class="fas fa-check-circle mr-1"></i>{{ $workshop['specialty'] }}
                        </span>
                        <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-semibold">
                            <i class="fas fa-award mr-1"></i>{{ $workshop['experience'] }} Years
                        </span>
                        <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm font-semibold">
                            <i class="fas fa-shield-alt mr-1"></i>Verified
                        </span>
                    </div>

                    <a href="#" class="block text-center bg-yellow-600 hover:bg-yellow-700 text-white py-3 rounded-xl transition-all duration-300 font-semibold transform hover:scale-105 shadow-lg hover:shadow-yellow-600/50">
                        View Workshop Profile
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Why Choose Custom -->
<section class="py-20 bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 relative overflow-hidden">
    <!-- Animated Background -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-20 left-20 w-64 h-64 bg-yellow-500 rounded-full mix-blend-multiply filter blur-3xl animate-blob"></div>
        <div class="absolute top-40 right-20 w-64 h-64 bg-orange-500 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-2000"></div>
        <div class="absolute bottom-20 left-40 w-64 h-64 bg-red-500 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-4000"></div>
    </div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center mb-16 animate-fade-in">
            <span class="inline-block px-4 py-2 bg-yellow-600/20 border border-yellow-600 text-yellow-400 rounded-full text-sm font-semibold mb-3">
                WHY CHOOSE US
            </span>
            <h2 class="text-5xl font-bold mb-4 text-white">Why Choose Custom Furniture?</h2>
            <p class="text-gray-300 text-xl max-w-2xl mx-auto">Experience the perfect blend of craftsmanship, design, and personalization</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @php
            $benefits = [
                ['icon' => 'fa-ruler-combined', 'title' => 'Perfect Fit', 'desc' => 'Furniture designed to fit your exact space requirements and dimensions', 'color' => 'from-yellow-400 to-yellow-600'],
                ['icon' => 'fa-palette', 'title' => 'Unique Design', 'desc' => 'Create one-of-a-kind pieces that perfectly match your personal style', 'color' => 'from-orange-400 to-orange-600'],
                ['icon' => 'fa-award', 'title' => 'Quality Craftsmanship', 'desc' => 'Work with skilled craftsmen dedicated to superior quality', 'color' => 'from-red-400 to-red-600']
            ];
            @endphp

            @foreach($benefits as $benefit)
            <div class="group text-center p-8 bg-white/5 backdrop-blur-sm rounded-2xl hover:bg-white/10 transition-all duration-500 border border-white/10 hover:border-yellow-400/50 transform hover:-translate-y-2">
                <div class="w-24 h-24 bg-gradient-to-br {{ $benefit['color'] }} rounded-2xl flex items-center justify-center mx-auto mb-6 transform group-hover:rotate-6 group-hover:scale-110 transition-all duration-500 shadow-2xl">
                    <i class="fas {{ $benefit['icon'] }} text-4xl text-white"></i>
                </div>
                <h4 class="font-bold text-2xl mb-3 text-white group-hover:text-yellow-400 transition">{{ $benefit['title'] }}</h4>
                <p class="text-gray-300 text-lg leading-relaxed">{{ $benefit['desc'] }}</p>
            </div>
            @endforeach
        </div>

        <!-- Additional Benefits -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mt-16 pt-16 border-t border-white/10">
            <div class="text-center animate-fade-in">
                <i class="fas fa-leaf text-4xl text-yellow-400 mb-3"></i>
                <h4 class="text-white font-semibold mb-1">Eco-Friendly</h4>
                <p class="text-gray-400 text-sm">Sustainable materials</p>
            </div>
            <div class="text-center animate-fade-in animation-delay-200">
                <i class="fas fa-shield-alt text-4xl text-yellow-400 mb-3"></i>
                <h4 class="text-white font-semibold mb-1">Warranty</h4>
                <p class="text-gray-400 text-sm">5-year guarantee</p>
            </div>
            <div class="text-center animate-fade-in animation-delay-400">
                <i class="fas fa-truck text-4xl text-yellow-400 mb-3"></i>
                <h4 class="text-white font-semibold mb-1">Free Delivery</h4>
                <p class="text-gray-400 text-sm">Island-wide service</p>
            </div>
            <div class="text-center animate-fade-in animation-delay-600">
                <i class="fas fa-tools text-4xl text-yellow-400 mb-3"></i>
                <h4 class="text-white font-semibold mb-1">Installation</h4>
                <p class="text-gray-400 text-sm">Professional setup</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-gradient-to-r from-yellow-600 via-yellow-500 to-yellow-600 relative overflow-hidden">
    <!-- Animated Background Pattern -->
    <div class="absolute inset-0 opacity-20">
        <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full -ml-48 -mt-48"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-white rounded-full -mr-48 -mb-48"></div>
    </div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-3xl mx-auto text-center">
            <div class="mb-6 animate-fade-in">
                <i class="fas fa-pencil-ruler text-6xl text-white mb-6 inline-block"></i>
            </div>
            <h2 class="text-5xl font-bold text-white mb-6 animate-fade-in">Ready to Create Your Custom Furniture?</h2>
            <p class="text-white/90 text-xl mb-10 animate-fade-in animation-delay-200">Get started with your custom furniture project today and bring your vision to life</p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center animate-fade-in animation-delay-400">
                <a href="{{ route('custom-furniture.request') }}" class="bg-gray-900 hover:bg-gray-800 text-white px-12 py-5 rounded-2xl font-bold transition-all transform hover:scale-105 text-lg flex items-center justify-center gap-3 shadow-2xl">
                    <i class="fas fa-paper-plane"></i>
                    <span>Submit Your Request</span>
                </a>
                <a href="#how-it-works" class="bg-white/20 backdrop-blur-sm hover:bg-white/30 border-2 border-white text-white px-12 py-5 rounded-2xl font-bold transition-all transform hover:scale-105 text-lg flex items-center justify-center gap-3">
                    <i class="fas fa-question-circle"></i>
                    <span>Learn More</span>
                </a>
            </div>

            <!-- Social Proof -->
            <div class="flex items-center justify-center gap-4 mt-10 text-white/90">
                <div class="flex -space-x-3">
                    @for($i = 1; $i <= 5; $i++)
                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-white to-gray-200 border-4 border-yellow-600 flex items-center justify-center font-bold text-yellow-600">
                        {{ chr(64 + $i) }}
                    </div>
                    @endfor
                </div>
                <p class="text-lg font-semibold">Join 500+ satisfied customers</p>
            </div>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
    /* Animations */
    @keyframes fade-in-up {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fade-in {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    @keyframes blob {
        0%, 100% {
            transform: translate(0, 0) scale(1);
        }
        33% {
            transform: translate(30px, -50px) scale(1.1);
        }
        66% {
            transform: translate(-20px, 20px) scale(0.9);
        }
    }

    .animate-fade-in-up {
        animation: fade-in-up 1s ease-out;
    }

    .animate-fade-in {
        animation: fade-in 1s ease-out;
    }

    .animate-blob {
        animation: blob 7s infinite;
    }

    .animation-delay-200 {
        animation-delay: 0.2s;
    }

    .animation-delay-400 {
        animation-delay: 0.4s;
    }

    .animation-delay-600 {
        animation-delay: 0.6s;
    }

    .animation-delay-2000 {
        animation-delay: 2s;
    }

    .animation-delay-4000 {
        animation-delay: 4s;
    }

    /* Smooth Scrolling */
    html {
        scroll-behavior: smooth;
    }
</style>
@endpush
