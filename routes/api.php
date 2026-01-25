<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin\AdminUserController;

// ----------------------------  Student Login ---------------------------------------------

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

// ----------------------------  Admin Login ---------------------------------------------

// For Fetched admin users API

Route::post('/admin/login', [AdminUserController::class, 'adminLogin']);

Route::middleware(['auth:sanctum', 'isAdmin'])->group(function () {
      Route::get('/admin-users', [AdminUserController::class, 'admin_users']);
      Route::get('/admin-profile', [AdminUserController::class, 'admin_profile']);
      Route::put('/admin-profile-details/{id}', [AdminUserController::class,'update_admin_profile']);
});

