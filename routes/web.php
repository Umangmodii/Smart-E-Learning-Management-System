<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Login;
use App\Livewire\Register;
use App\Livewire\Dashboard;
use App\Livewire\OtpVerify;
use App\Http\Controllers\GithubController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\FaceBookController;

// Home Route
Route::get('/', function () {
    return view('layouts.app');
});

// Login Route
Route::get('/login', Login::class)->name('login');

// Register Route
Route::get('/register', Register::class)->name('register');

//  Protected Routes
Route::middleware('auth')->group(function(){
    // Dashboard Route
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
});

// OTP Verification Route (Livewire component)
Route::get('/login/otp-verify', OtpVerify::class)->name('otp-verify');

// Logout Route
Route::post('/logout', [Dashboard::class, 'logout'])->name('logout');

// OAuth2.0 GitHub Login
Route::get('/auth/github', [GithubController::class,'redirect']);
Route::get('/github/callback', [GithubController::class, 'callback']);

// Oauth2.0 Google Login
Route::get('/auth/google',[GoogleController::class,'redirect']);
Route::get('/google/callback',[GoogleController::class,'callback']);

// Oauth2.0 Facebook Login
Route::get('/auth/facebook', [FaceBookController::class,'redirect']);
Route::get('/facebook/callback', [FaceBookController::class,'callback']);