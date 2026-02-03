<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth('admin_api')->check() && auth('admin_api')->user()->role_id == 1) {
            return $next($request);
        }

        return response()->json([
            'status' => false,
            'message' => 'Access Denied: Admin privileges required.'
        ], 403);
        }
}