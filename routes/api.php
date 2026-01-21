<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;

// For User Registration
Route::post('/register',[AuthController::class,'register']);

// For User Login
Route::post('/login',[AuthController::class,'login']);

// For All Customer
Route::get('/fetch-users', [AuthController::class, 'fetchUsers']);

// For Authenticated User Profile
Route::middleware('auth:sanctum')->group(callback: function() {
      Route::post('/logout', [AuthController::class,'logout']);
});
