<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // User Model එක import කරන්න අමතක කරන්න එපා
use Illuminate\Support\Facades\Hash; // Hash එකත් import කරන්න
class AuthController extends Controller
{
    // 1. Register Form එක පෙන්වීම
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // 2. අලුත් User කෙනෙක් හැදීම
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed', // confirmed කියන්නේ password_confirmation field එකත් එක්ක check කරනවා
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'customer', // Default role එක customer විදියට දාමු
        ]);

        Auth::login($user); // හැදුණු ගමන් Auto Login වෙනවා

        return redirect()->route('home')->with('success', 'Account created successfully!');
    }

    // Login Form එක පෙන්වීම
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Login Data Check කිරීම
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            // Login වුණාම යන්න ඕන තැන (උදා: Home)
            return redirect()->intended(route('home'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
}
