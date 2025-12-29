@extends('layouts.app')

@section('title', 'Contact Us - Calista Luxury Furniture')

@section('content')

<div class="relative w-full h-[50vh] flex items-center justify-center overflow-hidden bg-gray-900">
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1596495577886-d920f1fb7238?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80"
             class="w-full h-full object-cover opacity-40"
             alt="Contact Support">
        <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/40 to-transparent"></div>
    </div>

    <div class="relative z-10 text-center px-4">
        <span class="text-yellow-500 font-bold tracking-[0.2em] uppercase text-sm mb-4 block animate-fade-in-down">24/7 Support</span>
        <h1 class="text-5xl md:text-6xl font-serif font-bold text-white mb-4 animate-fade-in-up">
            Get in <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-200 to-yellow-600">Touch</span>
        </h1>
        <p class="text-gray-300 text-lg font-light max-w-2xl mx-auto animate-fade-in-up delay-100">
            Connect with us on your favorite platform.
        </p>
    </div>
</div>

<div class="relative bg-gray-900 overflow-hidden py-4 shadow-lg z-20 border-b border-gray-800">
    <div class="absolute inset-0 bg-gray-900"></div>

    <div class="flex overflow-x-hidden group">
        <div class="py-1 animate-marquee whitespace-nowrap flex gap-16 text-white font-bold tracking-wider text-sm uppercase items-center">

            <a href="https://facebook.com" target="_blank" class="flex items-center gap-3 hover:text-blue-500 transition-colors duration-300">
                <span class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center border border-white/20"><i class="fab fa-facebook-f"></i></span>
                Facebook
            </a>

            <a href="https://wa.me/94771234567" target="_blank" class="flex items-center gap-3 hover:text-green-500 transition-colors duration-300">
                <span class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center border border-white/20"><i class="fab fa-whatsapp"></i></span>
                WhatsApp
            </a>

            <a href="https://instagram.com" target="_blank" class="flex items-center gap-3 hover:text-pink-500 transition-colors duration-300">
                <span class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center border border-white/20"><i class="fab fa-instagram"></i></span>
                Instagram
            </a>

            <a href="https://linkedin.com" target="_blank" class="flex items-center gap-3 hover:text-blue-400 transition-colors duration-300">
                <span class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center border border-white/20"><i class="fab fa-linkedin-in"></i></span>
                LinkedIn
            </a>

            <a href="https://m.me/calista" target="_blank" class="flex items-center gap-3 hover:text-blue-600 transition-colors duration-300">
                <span class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center border border-white/20"><i class="fab fa-facebook-messenger"></i></span>
                Messenger
            </a>

            <a href="https://twitter.com" target="_blank" class="flex items-center gap-3 hover:text-sky-400 transition-colors duration-300">
                <span class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center border border-white/20"><i class="fab fa-twitter"></i></span>
                Twitter
            </a>

            <span class="text-gray-600">|</span> <a href="https://facebook.com" target="_blank" class="flex items-center gap-3 hover:text-blue-500 transition-colors duration-300">
                <span class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center border border-white/20"><i class="fab fa-facebook-f"></i></span>
                Facebook
            </a>

            <a href="https://wa.me/94771234567" target="_blank" class="flex items-center gap-3 hover:text-green-500 transition-colors duration-300">
                <span class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center border border-white/20"><i class="fab fa-whatsapp"></i></span>
                WhatsApp
            </a>

            <a href="https://instagram.com" target="_blank" class="flex items-center gap-3 hover:text-pink-500 transition-colors duration-300">
                <span class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center border border-white/20"><i class="fab fa-instagram"></i></span>
                Instagram
            </a>

            <a href="https://linkedin.com" target="_blank" class="flex items-center gap-3 hover:text-blue-400 transition-colors duration-300">
                <span class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center border border-white/20"><i class="fab fa-linkedin-in"></i></span>
                LinkedIn
            </a>
        </div>
    </div>
</div>

<section class="py-16 bg-white">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="bg-white p-8 rounded-2xl shadow-xl text-center border-b-4 border-yellow-500 hover:-translate-y-2 transition duration-300">
                <div class="w-14 h-14 bg-yellow-100 text-yellow-600 rounded-full flex items-center justify-center text-2xl mx-auto mb-4"><i class="fas fa-phone-alt"></i></div>
                <h3 class="font-bold text-gray-900 text-lg mb-2">Call Us</h3>
                <p class="text-gray-500 text-sm">+94 11 234 5678</p>
            </div>
            <div class="bg-white p-8 rounded-2xl shadow-xl text-center border-b-4 border-yellow-500 hover:-translate-y-2 transition duration-300">
                <div class="w-14 h-14 bg-yellow-100 text-yellow-600 rounded-full flex items-center justify-center text-2xl mx-auto mb-4"><i class="fas fa-envelope"></i></div>
                <h3 class="font-bold text-gray-900 text-lg mb-2">Email Us</h3>
                <p class="text-gray-500 text-sm">info@calista.lk</p>
            </div>
            <div class="bg-white p-8 rounded-2xl shadow-xl text-center border-b-4 border-yellow-500 hover:-translate-y-2 transition duration-300">
                <div class="w-14 h-14 bg-yellow-100 text-yellow-600 rounded-full flex items-center justify-center text-2xl mx-auto mb-4"><i class="fas fa-map-marker-alt"></i></div>
                <h3 class="font-bold text-gray-900 text-lg mb-2">Visit Us</h3>
                <p class="text-gray-500 text-sm">Colombo 03, LK</p>
            </div>
            <div class="bg-white p-8 rounded-2xl shadow-xl text-center border-b-4 border-yellow-500 hover:-translate-y-2 transition duration-300">
                <div class="w-14 h-14 bg-yellow-100 text-yellow-600 rounded-full flex items-center justify-center text-2xl mx-auto mb-4"><i class="fas fa-clock"></i></div>
                <h3 class="font-bold text-gray-900 text-lg mb-2">Hours</h3>
                <p class="text-gray-500 text-sm">9am - 6pm</p>
            </div>
        </div>
    </div>
</section>

<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-6">
        <div class="flex flex-col lg:flex-row gap-12 bg-white rounded-3xl shadow-2xl overflow-hidden">
            <div class="lg:w-1/2 p-10 lg:p-16">
                <span class="text-yellow-600 font-bold tracking-widest text-sm uppercase">Send a Message</span>
                <h2 class="text-3xl font-serif font-bold text-gray-900 mt-2 mb-6">How can we help?</h2>
                <form action="#" method="POST" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div><label class="block text-sm font-bold text-gray-700 mb-2">Your Name</label><input type="text" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:border-yellow-500"></div>
                        <div><label class="block text-sm font-bold text-gray-700 mb-2">Phone</label><input type="text" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:border-yellow-500"></div>
                    </div>
                    <div><label class="block text-sm font-bold text-gray-700 mb-2">Email</label><input type="email" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:border-yellow-500"></div>
                    <div><label class="block text-sm font-bold text-gray-700 mb-2">Message</label><textarea rows="4" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:border-yellow-500"></textarea></div>
                    <button type="submit" class="w-full py-4 bg-gray-900 text-white font-bold rounded-lg hover:bg-yellow-600 transition shadow-lg">Send Message</button>
                </form>
            </div>
            <div class="lg:w-1/2 bg-gray-200 relative min-h-[400px]">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63371.80385597899!2d79.82118589178494!3d6.921922576115982!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae253d10f7a7003%3A0x320b2e4d32d3838d!2sColombo%2C%20Sri%20Lanka!5e0!3m2!1sen!2slk!4v1625567891234!5m2!1sen!2slk" width="100%" height="100%" style="border:0; position: absolute; inset: 0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
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
    /* Stop on hover so user can click */
    .group:hover .animate-marquee {
        animation-play-state: paused;
    }

    @keyframes fade-in-up { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    .animate-fade-in-up { animation: fade-in-up 0.8s ease-out forwards; }

    @keyframes fade-in-down { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
    .animate-fade-in-down { animation: fade-in-down 0.8s ease-out forwards; }

    .delay-100 { animation-delay: 0.2s; opacity: 0; animation-fill-mode: forwards; }
</style>

@endsection
