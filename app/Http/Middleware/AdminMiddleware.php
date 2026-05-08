<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect('login');
        }

        if (!auth()->user()->isAdmin()) {
            return redirect('/dashboard')->with('error', 'Access denied. Admin privileges required.');
        }

        return $next($request);
    }
}
