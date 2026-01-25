<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Login;
use App\Livewire\Register;
use App\Livewire\Dashboard;
use App\Livewire\OtpVerify;
use App\Http\Controllers\GithubController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\FaceBookController;
use App\Livewire\EditProfile;
use App\Livewire\AccountSettings;
use App\Livewire\Admin\Login as LoginAdmin;
use App\Livewire\Admin\AdminDashboard;
use App\Livewire\Admin\AdminProfile;
use App\Livewire\Admin\Users;

// ----------------------------  Student Login ---------------------------------------------

// Home Route
Route::get('/', function () {
    return view('layouts.app');
});

// Login Route
Route::get('/login', Login::class)->name('login');

// Register Route
Route::get('/register', Register::class)->name('register');

//  Protected Routes
// Find the generic dashboard route and update it to this:
Route::middleware(['auth'])->get('/dashboard', function () {
    // If the logged-in user is a Super Admin, kick them out of the student area
    if (auth()->user()->isSuperAdmin()) {
        return redirect()->route('admin.dashboard');
    }

    // Only actual students get to stay here
    return view('dashboard'); 
})->name('dashboard');

// OTP Verification Route (Livewire component)
Route::get('/login/otp-verify', OtpVerify::class)->name('otp-verify');

// Logout Route
Route::post('/logout', [Dashboard::class, 'logout'])->name('logout');

// // Edit Profile
Route::get('/dashboard',EditProfile::class)->name('dashboard');

// Security setting
Route::get('/account-settings',AccountSettings::class)->name('account-settings');

// OAuth2.0 GitHub Login
Route::get('/auth/github', [GithubController::class,'redirect']);
Route::get('/github/callback', [GithubController::class, 'callback']);

// Oauth2.0 Google Login
Route::get('/auth/google',[GoogleController::class,'redirect']);
Route::get('/google/callback',[GoogleController::class,'callback']);

// Oauth2.0 Facebook Login
Route::get('/auth/facebook', [FaceBookController::class,'redirect']);
Route::get('/facebook/callback', [FaceBookController::class,'callback']);

// ----------------------------  Admin Login ---------------------------------------------

Route::get('/admin/login', LoginAdmin::class)->name('admin.admin_login')->middleware('guest'); 

Route::middleware(['auth', 'isAdmin'])->name('admin.')->group(function() {
        Route::get('/admin/dashboard', AdminDashboard::class)->name('dashboard'); 
});

Route::post('/admin/logout', [AdminProfile::class, 'logout'])->name('admin.logout');

// For Admin Profile
Route::get('/admin/profile',AdminProfile::class);

// For Customer Users list
Route::get('/admin/users',Users::class);