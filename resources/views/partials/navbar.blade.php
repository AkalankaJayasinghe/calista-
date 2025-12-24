<nav class="bg-white/90 backdrop-blur-md sticky top-0 z-50 shadow-sm border-b border-gray-100 transition-all duration-300" id="navbar">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center h-20">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                <div class="w-10 h-10 bg-gradient-to-br from-amber-500 to-orange-600 rounded-lg flex items-center justify-center text-white transform group-hover:rotate-12 transition-transform">
                    <i class="fas fa-couch"></i>
                </div>
                <span class="text-2xl font-extrabold text-gray-900 tracking-tight">
                    CALISTA<span class="text-amber-600">LK</span>
                </span>
            </a>

            {{-- Desktop Menu --}}
            <div class="hidden lg:flex items-center space-x-6">
                <a href="{{ route('home') }}" class="text-sm font-bold uppercase tracking-wide text-gray-600 hover:text-amber-600 transition-colors {{ request()->routeIs('home') ? 'text-amber-600' : '' }}">
                    Home
                </a>

                <a href="{{ route('marketplace.index') }}" class="text-sm font-bold uppercase tracking-wide text-gray-600 hover:text-amber-600 transition-colors {{ request()->routeIs('marketplace.*') ? 'text-amber-600' : '' }}">
                    Marketplace
                </a>

                <a href="{{ route('custom-furniture.index') }}" class="text-sm font-bold uppercase tracking-wide text-gray-600 hover:text-amber-600 transition-colors {{ request()->routeIs('custom-furniture.*') ? 'text-amber-600' : '' }}">
                    Customize
                </a>

                <a href="{{ route('interior-design.index') }}" class="text-sm font-bold uppercase tracking-wide text-gray-600 hover:text-amber-600 transition-colors {{ request()->routeIs('interior-design.*') ? 'text-amber-600' : '' }}">
                    Interior Design
                </a>

                <a href="{{ route('about') }}" class="text-sm font-bold uppercase tracking-wide text-gray-600 hover:text-amber-600 transition-colors {{ request()->routeIs('about') ? 'text-amber-600' : '' }}">
                    About
                </a>

                <a href="{{ route('contact') }}" class="text-sm font-bold uppercase tracking-wide text-gray-600 hover:text-amber-600 transition-colors {{ request()->routeIs('contact') ? 'text-amber-600' : '' }}">
                    Contact
                </a>
            </div>

            {{-- Icons --}}
            <div class="flex items-center gap-5">
                <a href="{{ route('marketplace.search') }}" class="text-gray-500 hover:text-amber-600 transition-colors">
                    <i class="fas fa-search text-xl"></i>
                </a>

                <a href="{{ route('cart.index') }}" class="relative text-gray-500 hover:text-amber-600 transition-colors">
                    <i class="fas fa-shopping-cart text-xl"></i>
                    <span class="absolute -top-2 -right-2 bg-amber-600 text-white text-[10px] font-bold w-5 h-5 rounded-full flex items-center justify-center">0</span>
                </a>

                {{-- Mobile Menu Button --}}
                <button class="lg:hidden text-gray-600 focus:outline-none" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div id="mobile-menu" class="hidden lg:hidden bg-white border-t border-gray-100 absolute w-full left-0 shadow-lg">
        <div class="flex flex-col p-6 space-y-4">
            <a href="{{ route('home') }}" class="font-bold text-gray-700 hover:text-amber-600">Home</a>
            <a href="{{ route('marketplace.index') }}" class="font-bold text-gray-700 hover:text-amber-600">Marketplace</a>
            <a href="{{ route('custom-furniture.index') }}" class="font-bold text-gray-700 hover:text-amber-600">Customize</a>
            <a href="{{ route('interior-design.index') }}" class="font-bold text-gray-700 hover:text-amber-600">Interior Design</a>
            <a href="{{ route('about') }}" class="font-bold text-gray-700 hover:text-amber-600">About</a>
            <a href="{{ route('contact') }}" class="font-bold text-gray-700 hover:text-amber-600">Contact</a>
        </div>
    </div>
</nav>
