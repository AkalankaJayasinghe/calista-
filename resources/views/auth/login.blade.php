@extends('layouts.app')

@section('title', 'Sign In - Calista Luxury Furniture')

@section('content')
<div class="min-h-screen flex items-center justify-center relative overflow-hidden bg-gray-900 py-8 px-4">

    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80"
             class="w-full h-full object-cover opacity-50 blur-md scale-110 animate-slow-zoom"
             alt="Background">
        <div class="absolute inset-0 bg-gradient-to-br from-black/80 via-black/60 to-black/80"></div>
    </div>

    <div class="relative z-10 w-full max-w-sm">

        <div class="bg-white/95 backdrop-blur-xl rounded-2xl shadow-2xl overflow-hidden border border-white/20">

            <div class="pt-6 pb-4 text-center bg-gradient-to-b from-gray-50/80 to-transparent">
                <div class="inline-flex items-center justify-center w-12 h-12 bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-xl shadow-md mb-3 transform transition-transform hover:scale-110 group cursor-pointer">
                    <i class="fas fa-couch text-white text-lg group-hover:rotate-12 transition-transform"></i>
                </div>
                <h2 class="text-2xl font-serif font-bold text-gray-900 tracking-tight">Welcome Back</h2>
            </div>

            <div class="px-6 pb-6">

                @if ($errors->any())
                    <div class="mb-4 bg-red-50 border-l-2 border-red-500 p-2.5 rounded-r-lg shadow-sm animate-shake flex items-center gap-2">
                        <i class="fas fa-exclamation-circle text-red-500 text-sm"></i>
                        <p class="text-xs text-red-600 font-medium">{{ $errors->first() }}</p>
                    </div>
                @endif

                <form class="space-y-4" action="{{ route('login.submit') }}" method="POST" id="loginForm">
                    @csrf

                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-400 text-sm group-focus-within:text-yellow-500 transition-colors"></i>
                        </div>
                        <input id="email" name="email" type="email" autocomplete="email" required
                            class="block w-full pl-9 pr-3 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-gray-900 placeholder-gray-400 focus:outline-none focus:border-yellow-500 focus:bg-white focus:ring-2 focus:ring-yellow-500/20 transition-all text-sm"
                            placeholder="Email Address" value="{{ old('email') }}">
                    </div>

                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400 text-sm group-focus-within:text-yellow-500 transition-colors"></i>
                        </div>
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                            class="block w-full pl-9 pr-9 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-gray-900 placeholder-gray-400 focus:outline-none focus:border-yellow-500 focus:bg-white focus:ring-2 focus:ring-yellow-500/20 transition-all text-sm"
                            placeholder="Password">

                        <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 cursor-pointer focus:outline-none">
                            <i class="fas fa-eye text-xs" id="toggleIcon"></i>
                        </button>
                    </div>

                    <div class="flex items-center justify-between text-xs">
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" name="remember" class="h-3.5 w-3.5 text-yellow-600 border-gray-300 rounded focus:ring-yellow-500">
                            <span class="ml-1.5 text-gray-600">Remember me</span>
                        </label>
                        <a href="{{ route('password.request') }}" class="font-bold text-yellow-600 hover:text-yellow-700">Forgot?</a>
                    </div>

                    <button type="submit"
                        class="w-full py-2.5 px-4 bg-gradient-to-r from-yellow-500 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700 text-white rounded-lg shadow-md text-sm font-bold transition-all transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-yellow-500/50">
                        Sign In
                    </button>
                </form>

                <div class="my-4 relative">
                    <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-gray-200"></div></div>
                    <div class="relative flex justify-center text-[10px] uppercase"><span class="px-2 bg-white text-gray-400 font-bold">Or</span></div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <a href="#" class="flex items-center justify-center px-3 py-2 border border-gray-200 rounded-lg shadow-sm text-xs font-semibold text-gray-600 bg-white hover:bg-gray-50 transition-all hover:-translate-y-0.5">
                        <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="h-4 w-4 mr-1.5" alt="Google"> Google
                    </a>
                    <a href="#" class="flex items-center justify-center px-3 py-2 border border-gray-200 rounded-lg shadow-sm text-xs font-semibold text-gray-600 bg-white hover:bg-gray-50 transition-all hover:-translate-y-0.5">
                        <i class="fab fa-facebook text-blue-600 text-sm mr-1.5"></i> Facebook
                    </a>
                </div>

                <p class="mt-5 text-center text-xs text-gray-500">
                    New here? <a href="{{ route('register') }}" class="font-bold text-yellow-600 hover:underline">Create Account</a>
                </p>
            </div>
        </div>
    </div>
</div>

<script>
function togglePassword() {
    const input = document.getElementById('password');
    const icon = document.getElementById('toggleIcon');
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}
</script>

<style>
@keyframes slow-zoom { 0%, 100% { transform: scale(1.1); } 50% { transform: scale(1.15); } }
@keyframes shake { 0%, 100% { transform: translateX(0); } 25% { transform: translateX(-3px); } 75% { transform: translateX(3px); } }
.animate-slow-zoom { animation: slow-zoom 20s ease-in-out infinite; }
.animate-shake { animation: shake 0.3s ease-in-out; }
</style>
@endsection
