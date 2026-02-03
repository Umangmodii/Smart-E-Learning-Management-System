<?php

return [

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'users'),
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        
        // Admin Web Guard
        'admin' => [
            'driver' => 'session',
            'provider' => 'admins', // Renamed to plural for consistency
        ],

        // Instructor Web Guard
        'instructor' => [
            'driver' => 'session',
            'provider' => 'instructors', // Renamed to plural for consistency
        ],

        // For Admin API (Sanctum)
        'admin_api' => [
            'driver' => 'sanctum',
            'provider' => 'admins',
        ],

        // For Instructor API (Sanctum)
        'instructor_api' => [
            'driver' => 'sanctum',
            'provider' => 'instructors',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        'admins' => [
            'driver' => 'eloquent',
            'model' => App\Models\Admin::class,
        ],

        'instructors' => [
            'driver' => 'eloquent',
            'model' => App\Models\Instructor::class,
        ],
    ],

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];