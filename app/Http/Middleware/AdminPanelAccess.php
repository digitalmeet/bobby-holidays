<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminPanelAccess
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated and can access admin
        if (auth()->check() && auth()->user()->canAccessAdmin()) {
            return $next($request);
        }

        // Redirect to login if not authenticated
        if (!auth()->check()) {
            return redirect()->route('filament.admin.auth.login');
        }

        // Show 403 if authenticated but no admin access
        abort(403, 'You do not have permission to access the admin panel.');
    }
}