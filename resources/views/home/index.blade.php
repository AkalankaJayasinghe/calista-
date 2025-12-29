@extends('layouts.app')

@section('title', 'Login - Calista Luxury Furniture')

@section('content')
<div class="min-h-screen flex items-center justify-center relative bg-gray-900 px-4">

    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80"
             class="w-full h-full object-cover opacity-60"
             alt="Luxury Interior Background">
        <div class="absolute inset-0 bg-black/50"></div>
    </div>

    <div class="relative z-10 w-full max-w-md bg-white rounded-3xl shadow-2xl overflow-hidden transform transition-all hover:scale-[1.01]">

        <div class="pt-10 pb-6 text-center">
            <div class="inline-flex items-center justify-center w-14 h-14 bg-yellow-500 rounded-full shadow-lg mb-4 text-white text-2xl">
                <i class="fas fa-couch"></i>
            </div>
            <h2 class="text-3xl font-serif font-bold text-gray-900">Welcome Back</h2>
            <p class="text-gray-500 text-sm mt-2">Sign in to your account</p>
        </div>

        <div class="px-8 pb-10">

            @if ($errors->any())
                <div class="mb-5 bg-red-50 border-l-4 border-red-500 p-3 rounded-r flex items-center gap-3">
                    <i class="fas fa-exclamation-circle text-red-500"></i>
                    <p class="text-sm text-red-600 font-medium">{{ $errors->first() }}</p>
                </div>
            @endif

            <form class="space-y-5" action="{{ route('login.submit') }}" method="POST">
                @csrf

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1 ml-1">Email Address</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-400"></i>
                        </div>
                        <input type="email" name="email" required
                            class="block w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 focus:bg-white focus:border-yellow-500 focus:ring-4 focus:ring-yellow-500/10 transition-all outline-none"
                            placeholder="name@example.com" value="{{ old('email') }}">
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-1 ml-1">
                        <label class="block text-sm font-bold text-gray-700">Password</label>
                        {{-- Forgot Password Link (Use # if route is missing) --}}
                        <a href="#" class="text-xs font-bold text-yellow-600 hover:text-yellow-700">Forgot Password?</a>
                    </div>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input type="password" name="password" required
                            class="block w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 focus:bg-white focus:border-yellow-500 focus:ring-4 focus:ring-yellow-500/10 transition-all outline-none"
                            placeholder="••••••••">
                    </div>
                </div>

                <div class="flex items-center ml-1">
                    <input type="checkbox" name="remember" id="remember" class="w-4 h-4 text-yellow-600 border-gray-300 rounded focus:ring-yellow-500">
                    <label for="remember" class="ml-2 block text-sm text-gray-600 cursor-pointer">Remember me</label>
                </div>

                <button type="submit"
                    class="w-full py-3.5 px-4 bg-yellow-500 hover:bg-yellow-600 text-white font-bold rounded-xl shadow-lg shadow-yellow-500/30 transition-all transform hover:-translate-y-0.5">
                    Sign In
                </button>
            </form>

            <div class="my-8 relative text-center">
                <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-gray-200"></div></div>
                <span class="relative px-4 bg-white text-xs font-bold text-gray-400 uppercase tracking-wider">Or continue with</span>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <button class="flex items-center justify-center px-4 py-2.5 border border-gray-200 rounded-xl hover:bg-gray-50 transition-all">
                    <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="w-5 h-5 mr-2" alt="Google">
                    <span class="text-sm font-semibold text-gray-700">Google</span>
                </button>
                <button class="flex items-center justify-center px-4 py-2.5 border border-gray-200 rounded-xl hover:bg-gray-50 transition-all">
                    <i class="fab fa-facebook text-blue-600 text-lg mr-2"></i>
                    <span class="text-sm font-semibold text-gray-700">Facebook</span>
                </button>
            </div>

            <p class="mt-8 text-center text-sm text-gray-600">
                Don't have an account?
                <a href="{{ route('register') }}" class="font-bold text-yellow-600 hover:text-yellow-700">Create Account</a>
            </p>
        </div>
    </div>
</div>
@endsection
