<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Login;
use App\Livewire\Register;
use App\Livewire\Dashboard;
use App\Livewire\OtpVerify;

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