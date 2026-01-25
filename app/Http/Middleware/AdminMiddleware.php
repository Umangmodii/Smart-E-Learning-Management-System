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
        if (!auth()->check() || !auth()->user()->isSuperAdmin()) {
        
        if (auth()->check()) {
            auth()->logout(); 
        }

        return redirect()->route('admin.admin_login')
            ->with('error', 'Unauthorized access. Admins only.');
    }
        return $next($request);
    } 
}