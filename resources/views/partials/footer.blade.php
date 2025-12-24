<!-- Footer Component -->
<footer class="text-white bg-gray-900">
    <div class="container px-4 py-12 mx-auto">
        <div class="grid grid-cols-1 gap-8 md:grid-cols-4">
            <!-- About -->
            <div>
                <h3 class="mb-4 text-2xl font-bold text-yellow-600">CALISTA</h3>
                <p class="mb-4 text-gray-400">Sri Lanka's premier furniture marketplace offering ready-made products, custom furniture, and interior design services.</p>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 transition hover:text-yellow-600">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="text-gray-400 transition hover:text-yellow-600">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="text-gray-400 transition hover:text-yellow-600">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-gray-400 transition hover:text-yellow-600">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="mb-4 text-lg font-semibold">Quick Links</h4>
                <ul class="space-y-2 text-gray-400">
                    <li><a href="{{ route('marketplace.index') }}" class="transition hover:text-yellow-600">Marketplace</a></li>
                    <li><a href="{{ route('custom-furniture.index') }}" class="transition hover:text-yellow-600">Custom Furniture</a></li>
                    <li><a href="{{ route('interior-design.index') }}" class="transition hover:text-yellow-600">Interior Design</a></li>
                    <li><a href="#" class="transition hover:text-yellow-600">Become a Seller</a></li>
                </ul>
            </div>

            <!-- Customer Service -->
            <div>
                <h4 class="mb-4 text-lg font-semibold">Customer Service</h4>
                <ul class="space-y-2 text-gray-400">
                    <li><a href="#" class="transition hover:text-yellow-600">Help Center</a></li>
                    <li><a href="#" class="transition hover:text-yellow-600">Shipping Info</a></li>
                    <li><a href="#" class="transition hover:text-yellow-600">Returns</a></li>
                    <li><a href="#" class="transition hover:text-yellow-600">Privacy Policy</a></li>
                    <li><a href="#" class="transition hover:text-yellow-600">Terms & Conditions</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h4 class="mb-4 text-lg font-semibold">Contact Us</h4>
                <ul class="space-y-2 text-gray-400">
                    <li><i class="mr-2 text-yellow-600 fas fa-map-marker-alt"></i> Colombo, Sri Lanka</li>
                    <li><i class="mr-2 text-yellow-600 fas fa-phone"></i> +94 11 234 5678</li>
                    <li><i class="mr-2 text-yellow-600 fas fa-envelope"></i> info@calista.lk</li>
                </ul>
            </div>
        </div>

        <div class="pt-8 mt-8 text-center text-gray-400 border-t border-gray-800">
            <p>&copy; {{ date('Y') }} Calista. All rights reserved. Designed with <i class="text-red-500 fas fa-heart"></i> in Sri Lanka</p>
        </div>
    </div>
</footer>

<!-- Scroll to Top Button -->
<button id="scrollTop" class="fixed z-40 hidden w-12 h-12 text-white transition-all duration-300 bg-yellow-600 rounded-full shadow-lg bottom-8 right-8 hover:bg-yellow-700 hover:scale-110">
    <i class="fas fa-arrow-up"></i>
</button>

@push('scripts')
<script>
    // Scroll to top functionality
    const scrollTopBtn = document.getElementById('scrollTop');

    window.addEventListener('scroll', function() {
        if (window.scrollY > 300) {
            scrollTopBtn.classList.remove('hidden');
        } else {
            scrollTopBtn.classList.add('hidden');
        }
    });

    scrollTopBtn.addEventListener('click', function() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
</script>
@endpush
