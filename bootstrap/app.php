<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        
        // 1. Redirect guests (Unauthenticated)
        $middleware->redirectGuestsTo(function (Request $request) {
            // Industrial Fix: Prevent API from returning HTML Login Page
            if ($request->is('api/*') || $request->expectsJson()) {
                return null; 
            }

            if ($request->is('admin/*') || $request->is('admin')) {
                return route('admin.admin_login');
            }

            if ($request->is('instructor/*') || $request->is('instructor')) {
                return route('instructor.login');
            }

            return route('login');
        }); 

        // 2. Redirect logged-in users (Already Authenticated)
        $middleware->redirectUsersTo(function (Request $request) {
            if (auth('admin')->check()) {
                return route('admin.dashboard');
            }

            if (auth('instructor')->check()) {
                return route('dashboard');
            }

            return route('dashboard');
        });

        // 3. Register Middleware Aliases
        $middleware->alias([
            'isAdmin' => \App\Http\Middleware\AdminMiddleware::class,
            'isInstructor' => \App\Http\Middleware\InstructorMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Enforce JSON for all API errors (401, 403, 404, 500)
        $exceptions->shouldRenderJsonWhen(function (Request $request, Throwable $e) {
            if ($request->is('api/*')) {
                return true;
            }
            return $request->expectsJson();
        });
    })->create();