@extends('layouts.app')

@section('title', 'Create Account - Calista Luxury Furniture')

@section('content')
<div class="min-h-screen flex items-center justify-center relative bg-gray-900 px-4 py-12">

    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80"
             class="w-full h-full object-cover opacity-60"
             alt="Luxury Interior Background">
        <div class="absolute inset-0 bg-black/50"></div>
    </div>

    <div class="relative z-10 w-full max-w-md bg-white rounded-3xl shadow-2xl overflow-hidden transform transition-all hover:scale-[1.01]">

        <div class="pt-8 pb-4 text-center">
            <div class="inline-flex items-center justify-center w-14 h-14 bg-yellow-500 rounded-full shadow-lg mb-4 text-white text-2xl">
                <i class="fas fa-user-plus"></i>
            </div>
            <h2 class="text-3xl font-serif font-bold text-gray-900">Create Account</h2>
            <p class="text-gray-500 text-sm mt-2">Join our exclusive community</p>
        </div>

        <div class="px-8 pb-8">

            @if ($errors->any())
                <div class="mb-5 bg-red-50 border-l-4 border-red-500 p-3 rounded-r flex items-center gap-3">
                    <i class="fas fa-exclamation-circle text-red-500"></i>
                    <p class="text-sm text-red-600 font-medium">{{ $errors->first() }}</p>
                </div>
            @endif

            <form class="space-y-4" action="{{ route('register.submit') }}" method="POST">
                @csrf

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1 ml-1">Full Name</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-user text-gray-400"></i>
                        </div>
                        <input type="text" name="name" required
                            class="block w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 focus:bg-white focus:border-yellow-500 focus:ring-4 focus:ring-yellow-500/10 transition-all outline-none"
                            placeholder="John Doe" value="{{ old('name') }}">
                    </div>
                </div>

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
                    <label class="block text-sm font-bold text-gray-700 mb-1 ml-1">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input type="password" name="password" required
                            class="block w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 focus:bg-white focus:border-yellow-500 focus:ring-4 focus:ring-yellow-500/10 transition-all outline-none"
                            placeholder="••••••••">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1 ml-1">Confirm Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-check-circle text-gray-400"></i>
                        </div>
                        <input type="password" name="password_confirmation" required
                            class="block w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 focus:bg-white focus:border-yellow-500 focus:ring-4 focus:ring-yellow-500/10 transition-all outline-none"
                            placeholder="••••••••">
                    </div>
                </div>

                <div class="flex items-start ml-1 mt-2">
                    <input type="checkbox" name="terms" required class="mt-1 w-4 h-4 text-yellow-600 border-gray-300 rounded focus:ring-yellow-500">
                    <label class="ml-2 block text-sm text-gray-600">
                        I agree to the <a href="#" class="text-yellow-600 font-bold hover:underline">Terms of Service</a> & <a href="#" class="text-yellow-600 font-bold hover:underline">Privacy Policy</a>
                    </label>
                </div>

                <button type="submit"
                    class="w-full py-3.5 px-4 bg-yellow-500 hover:bg-yellow-600 text-white font-bold rounded-xl shadow-lg shadow-yellow-500/30 transition-all transform hover:-translate-y-0.5 mt-2">
                    Create Account
                </button>
            </form>

            <p class="mt-6 text-center text-sm text-gray-600">
                Already have an account?
                <a href="{{ route('login') }}" class="font-bold text-yellow-600 hover:text-yellow-700">Sign In</a>
            </p>
        </div>
    </div>
</div>
@endsection
