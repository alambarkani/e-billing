<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsSuperAdmin
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
            if ($user->userable instanceof Admin) {
                $admin = $user->userable; // This will already be the Admin instance
                // Check if the admin's authorization level is 'super-admin'
                if ($admin->authorize === 'super-admin') {
                    return $next($request);
                }
            }
        }
        // Return a 401 Unauthorized response
        return response()->view('errors.401', [], 401);
    }
}
