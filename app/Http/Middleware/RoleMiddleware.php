<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $role
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        // Check role
        switch ($role) {
            case 'admin':
                if (!$user->is_admin) {
                    abort(403, 'Unauthorized access.');
                }
                break;
            case 'seller':
                if (!$user->is_seller) {
                    abort(403, 'Seller account required.');
                }
                break;
            case 'customer':
                // All authenticated users are customers
                break;
            default:
                abort(403, 'Invalid role.');
        }

        return $next($request);
    }
}
