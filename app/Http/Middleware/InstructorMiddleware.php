<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InstructorMiddleware
{
   public function handle(Request $request, Closure $next)
{
    $instructor = auth()->guard('instructor')->user();

    if ($instructor) {
        // Status Logic
        if ($instructor->status == 1) {
            return $next($request); // Approved - Proceed to Dashboard
        }

        if ($instructor->status == 0) {
            // If they are on the pending page, don't redirect (prevent loop)
            if ($request->routeIs('instructor.pending')) {
                return $next($request);
            }
            return redirect()->route('instructor.pending');
        }
    }

    return redirect()->route('login')->with('error', 'Access Denied.');
  }
}