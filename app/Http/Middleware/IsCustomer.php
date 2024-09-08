<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use App\Models\Customer;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsCustomer
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();
            // Check if the user has a userable relationship
            if ($user->userable instanceof Customer) {
                return $next($request);
            }
        }
        // Return a 401 Unauthorized response
        return response()->view('errors.401', [], 401);
    }
}
