<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin\AdminUserController;
use App\Http\Controllers\Api\Instructor\InstructorAuthController;
use App\Http\Controllers\Api\Instructor\InstructorProfile;
use App\Http\Controllers\Api\Admin\CategoryApiController;
use App\Http\Controllers\Api\Admin\BannerApiController;

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

// ----------------------------  Admin ---------------------------------------------

// For Fetched admin users API
Route::post('/admin/login', [AdminUserController::class, 'adminLogin']);

Route::middleware(['auth:admin_api', 'isAdmin'])->group(function () {
      Route::get('/admin-users', [AdminUserController::class, 'admin_users']);
      Route::get('/admin-profile', [AdminUserController::class, 'admin_profile']);
      Route::put('/admin-profile-details/{id}', [AdminUserController::class,'update_admin_profile']);
      Route::get('/categories', [CategoryApiController::class, 'index']);
      Route::get('/banners-list', [BannerApiController::class, 'fetch_banner']);
      Route::post('/banners', [BannerApiController::class, 'store']);
});

// ----------------------------  Instructor ---------------------------------------------

Route::prefix('instructor')->group(function () {
      Route::get('/fetch-profile', [InstructorProfile::class, 'getallprofile']);
});

Route::prefix('instructor')->group(function () {
    Route::post('/register', [InstructorAuthController::class, 'register']);
    Route::post('/login', action: [InstructorAuthController::class, 'login']);
    Route::get('/instructor-profile/{instructor_id}', [InstructorProfile::class, 'getinstructorprofile']);
});

// Route::middleware(middleware: ['auth:instructor_api'])->prefix('instructor')->group(function () {
      
// });
