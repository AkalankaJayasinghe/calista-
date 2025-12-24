<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SellerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please login to access seller area.');
        }

        if (!auth()->user()->is_seller) {
            abort(403, 'Unauthorized access. Seller account required.');
        }

        // Check if seller account is approved
        if (auth()->user()->seller && auth()->user()->seller->status !== 'approved') {
            return redirect()->route('seller.pending')
                ->with('warning', 'Your seller account is pending approval.');
        }

        return $next($request);
    }
}
