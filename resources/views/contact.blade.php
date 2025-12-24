@extends('layouts.app')

@section('title', 'Contact Us - Calista')

@section('content')
<!-- Breadcrumb -->
<div class="py-4 bg-gray-100">
    <div class="container px-4 mx-auto">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="/" class="text-gray-700 hover:text-yellow-600">
                        <i class="mr-2 fas fa-home"></i>Home
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="mx-2 text-gray-400 fas fa-chevron-right"></i>
                        <span class="text-gray-500">Contact Us</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>
</div>

<!-- Contact Section -->
<section class="py-16 bg-white">
    <div class="container px-4 mx-auto">
        <div class="mb-12 text-center">
            <h1 class="mb-4 text-4xl font-bold">Get in Touch</h1>
            <p class="max-w-2xl mx-auto text-gray-600">Have a question or need assistance? We're here to help! Send us a message and we'll respond as soon as possible.</p>
        </div>

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
            <!-- Contact Information -->
            <div class="lg:col-span-1">
                <div class="h-full p-8 rounded-lg bg-yellow-50">
                    <h2 class="mb-6 text-2xl font-bold">Contact Information</h2>

                    <div class="space-y-6">
                        <div class="flex items-start">
                            <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 bg-yellow-600 rounded-full">
                                <i class="text-white fas fa-map-marker-alt"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="mb-1 font-semibold text-gray-900">Address</h3>
                                <p class="text-gray-600">123 Furniture Street<br>Colombo, Sri Lanka</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 bg-yellow-600 rounded-full">
                                <i class="text-white fas fa-phone"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="mb-1 font-semibold text-gray-900">Phone</h3>
                                <p class="text-gray-600">+94 11 234 5678<br>+94 77 123 4567</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 bg-yellow-600 rounded-full">
                                <i class="text-white fas fa-envelope"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="mb-1 font-semibold text-gray-900">Email</h3>
                                <p class="text-gray-600">info@calista.lk<br>support@calista.lk</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 bg-yellow-600 rounded-full">
                                <i class="text-white fas fa-clock"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="mb-1 font-semibold text-gray-900">Business Hours</h3>
                                <p class="text-gray-600">Mon - Fri: 9:00 AM - 6:00 PM<br>Sat: 10:00 AM - 4:00 PM<br>Sun: Closed</p>
                            </div>
                        </div>
                    </div>

                    <!-- Social Media -->
                    <div class="mt-8">
                        <h3 class="mb-4 font-semibold text-gray-900">Follow Us</h3>
                        <div class="flex space-x-3">
                            <a href="#" class="flex items-center justify-center w-10 h-10 text-white transition bg-yellow-600 rounded-full hover:bg-yellow-700">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="flex items-center justify-center w-10 h-10 text-white transition bg-yellow-600 rounded-full hover:bg-yellow-700">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#" class="flex items-center justify-center w-10 h-10 text-white transition bg-yellow-600 rounded-full hover:bg-yellow-700">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="flex items-center justify-center w-10 h-10 text-white transition bg-yellow-600 rounded-full hover:bg-yellow-700">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="lg:col-span-2">
                <div class="p-8 bg-white border border-gray-200 rounded-lg">
                    <h2 class="mb-6 text-2xl font-bold">Send us a Message</h2>

                    @if(session('success'))
                        <div class="px-4 py-3 mb-6 text-green-700 bg-green-100 border border-green-400 rounded" role="alert">
                            <div class="flex items-center">
                                <i class="mr-2 fas fa-check-circle"></i>
                                <span>{{ session('success') }}</span>
                            </div>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="px-4 py-3 mb-6 text-red-700 bg-red-100 border border-red-400 rounded" role="alert">
                            <div class="flex items-center mb-2">
                                <i class="mr-2 fas fa-exclamation-circle"></i>
                                <span class="font-semibold">Please fix the following errors:</span>
                            </div>
                            <ul class="list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('contact.submit') }}" method="POST">
                        @csrf

                        <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-2">
                            <div>
                                <label for="name" class="block mb-2 font-semibold text-gray-700">
                                    Full Name <span class="text-red-500">*</span>
                                </label>
                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    value="{{ old('name') }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-yellow-600 @error('name') border-red-500 @enderror"
                                    placeholder="Enter your name"
                                    required
                                >
                                @error('name')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="email" class="block mb-2 font-semibold text-gray-700">
                                    Email Address <span class="text-red-500">*</span>
                                </label>
                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-yellow-600 @error('email') border-red-500 @enderror"
                                    placeholder="Enter your email"
                                    required
                                >
                                @error('email')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-2">
                            <div>
                                <label for="phone" class="block mb-2 font-semibold text-gray-700">
                                    Phone Number
                                </label>
                                <input
                                    type="tel"
                                    id="phone"
                                    name="phone"
                                    value="{{ old('phone') }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-yellow-600 @error('phone') border-red-500 @enderror"
                                    placeholder="Enter your phone"
                                >
                                @error('phone')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="subject" class="block mb-2 font-semibold text-gray-700">
                                    Subject <span class="text-red-500">*</span>
                                </label>
                                <select
                                    id="subject"
                                    name="subject"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-yellow-600 @error('subject') border-red-500 @enderror"
                                    required
                                >
                                    <option value="">Select a subject</option>
                                    <option value="General Inquiry" {{ old('subject') == 'General Inquiry' ? 'selected' : '' }}>General Inquiry</option>
                                    <option value="Product Question" {{ old('subject') == 'Product Question' ? 'selected' : '' }}>Product Question</option>
                                    <option value="Custom Furniture" {{ old('subject') == 'Custom Furniture' ? 'selected' : '' }}>Custom Furniture</option>
                                    <option value="Interior Design" {{ old('subject') == 'Interior Design' ? 'selected' : '' }}>Interior Design</option>
                                    <option value="Order Support" {{ old('subject') == 'Order Support' ? 'selected' : '' }}>Order Support</option>
                                    <option value="Technical Issue" {{ old('subject') == 'Technical Issue' ? 'selected' : '' }}>Technical Issue</option>
                                    <option value="Other" {{ old('subject') == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                                @error('subject')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="message" class="block mb-2 font-semibold text-gray-700">
                                Message <span class="text-red-500">*</span>
                            </label>
                            <textarea
                                id="message"
                                name="message"
                                rows="6"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-yellow-600 @error('message') border-red-500 @enderror"
                                placeholder="Type your message here..."
                                required
                            >{{ old('message') }}</textarea>
                            @error('message')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label class="flex items-center">
                                <input
                                    type="checkbox"
                                    name="newsletter"
                                    value="1"
                                    {{ old('newsletter') ? 'checked' : '' }}
                                    class="w-4 h-4 text-yellow-600 border-gray-300 rounded focus:ring-yellow-500"
                                >
                                <span class="ml-2 text-gray-700">Subscribe to our newsletter for updates and offers</span>
                            </label>
                        </div>

                        <button
                            type="submit"
                            class="w-full px-6 py-3 font-semibold text-white transition transform bg-yellow-600 rounded-lg hover:bg-yellow-700 hover:scale-105"
                        >
                            <i class="mr-2 fas fa-paper-plane"></i>Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="py-16 bg-gray-100">
    <div class="container px-4 mx-auto">
        <h2 class="mb-8 text-3xl font-bold text-center">Visit Our Store</h2>
        <div class="overflow-hidden rounded-lg shadow-lg">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.798467122768!2d79.8612463!3d6.9270786!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae253d10f7a7003%3A0x320b2e4d32d3838d!2sColombo%2C%20Sri%20Lanka!5e0!3m2!1sen!2s!4v1234567890"
                width="100%"
                height="450"
                style="border:0;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
                class="w-full"
            ></iframe>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-16 bg-white">
    <div class="container px-4 mx-auto">
        <div class="mb-12 text-center">
            <h2 class="mb-4 text-3xl font-bold">Frequently Asked Questions</h2>
            <p class="text-gray-600">Find quick answers to common questions</p>
        </div>

        <div class="max-w-3xl mx-auto space-y-4">
            <div class="border border-gray-200 rounded-lg">
                <button class="flex items-center justify-between w-full px-6 py-4 font-semibold text-left hover:bg-gray-50">
                    <span>What are your delivery times?</span>
                    <i class="text-gray-400 fas fa-chevron-down"></i>
                </button>
                <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                    <p class="text-gray-600">Standard delivery takes 5-7 business days within Colombo and 7-10 business days for other areas. Express delivery is available for an additional fee.</p>
                </div>
            </div>

            <div class="border border-gray-200 rounded-lg">
                <button class="flex items-center justify-between w-full px-6 py-4 font-semibold text-left hover:bg-gray-50">
                    <span>Do you offer custom furniture design?</span>
                    <i class="text-gray-400 fas fa-chevron-down"></i>
                </button>
            </div>

            <div class="border border-gray-200 rounded-lg">
                <button class="flex items-center justify-between w-full px-6 py-4 font-semibold text-left hover:bg-gray-50">
                    <span>What is your return policy?</span>
                    <i class="text-gray-400 fas fa-chevron-down"></i>
                </button>
            </div>

            <div class="border border-gray-200 rounded-lg">
                <button class="flex items-center justify-between w-full px-6 py-4 font-semibold text-left hover:bg-gray-50">
                    <span>Do you provide installation services?</span>
                    <i class="text-gray-400 fas fa-chevron-down"></i>
                </button>
            </div>
        </div>
    </div>
</section>
@endsection
