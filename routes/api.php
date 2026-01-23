<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserProfileController;
use Illuminate\Support\Facades\Route;

// For User Registration
Route::post('/register',[AuthController::class,'register']);

// For User Login
Route::post('/login',[AuthController::class,'login']);

// For All Customer
Route::get('/fetch-users', [AuthController::class, 'fetchUsers']);

// For Authenticated User 
Route::middleware('auth:sanctum')->group(function() {
      Route::post('/logout', [AuthController::class,'logout']);
});

// For User Profile Authenticated by ID
Route::get('/profile/{user_id}',[UserProfileController::class,'show']);

// For User Profile Update from ID
Route::middleware('auth:sanctum')->group(function(){
      Route::put('/profiles/update/{user_Id}', [UserProfileController::class,'update']);
});