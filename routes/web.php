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
use App\Livewire\Instructor\StartedTeach;
use App\Livewire\Instructor\Registers;
use App\Livewire\Instructor\LoginUser;
use App\Livewire\Admin\PendingRequests;
use App\Livewire\Instructor\DashboardController;
use App\Livewire\Admin\ActiveInstructors;
use App\Livewire\Instructor\InstructorProfile;
use App\Livewire\Admin\Categories;
use App\Livewire\Admin\Banner;
use App\Http\Controllers\frontend\HomeController;
use App\Livewire\CourseDetails;
use App\Livewire\Instructor\CoursesController;
use App\Livewire\Admin\ManageCourseController;

// ----------------------------  Student Login ---------------------------------------------

// Home Route
Route::get('/', function () {
return view('layouts.app');
});
// Banner Route
Route::get('/', [HomeController::class, 'index']);

// Course Details Route
Route::get('/categories/course/{category_slug}/{course_slug?}', CourseDetails::class)
    ->name('course-details');
    

// Login Route
Route::get('/login', Login::class)->name('login');

// Register Route
Route::get('/register', Register::class)->name('register');

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

// ----------------------------  Admin  ---------------------------------------------

// 1. Keep this OUTSIDE any auth groups
Route::get('/admin/login', LoginAdmin::class)
    ->name('admin.admin_login')
    ->middleware('guest:admin'); // Use guest:admin to allow only logged-out admins

// 2. Only protect the dashboard and other internal pages
Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function() {
        Route::get('/dashboard', AdminDashboard::class)->name('dashboard'); 
        //  Route::get('/admin/dashboard', AdminDashboard::class)->name('dashboard');  // For Admin Profile
        Route::get('/admin/profile',AdminProfile::class);
        // For Customer Users list
        Route::get('/users',Users::class);
        Route::post('/logout', [AdminProfile::class, 'logout'])->name('admin.logout');
        Route::get('/profile', AdminProfile::class)->name('profile');
        Route::get('/instructors/pending',PendingRequests::class)->name('admin.pending_requests');
        Route::get('/instructors/active',ActiveInstructors::class)->name('admin.active-requests');
        Route::get('/categories',Categories::class)->name('admin.categories');
        Route::get('/banner', Banner::class)->name('admin.banners');
        Route::get('/manage-courses', ManageCourseController::class)->name('admin.manage-courses');
});

// ----------------------------  Instructor  ---------------------------------------------

Route::prefix('instructor')->group(function () {
    // Landing Page
    Route::get('/started-teach', StartedTeach::class)->name('instructor.started_teach');

    // Guest routes: Only accessible if NOT logged in as instructor
    Route::middleware('guest:instructor')->group(function () {
        Route::get('/register', Registers::class)->name('instructor.register');
        Route::get('/login', LoginUser::class)->name('instructor.login');
    });
});

// ----------------------------  Instructor (Protected) --------------------------------

Route::middleware(['auth:instructor'])->prefix('instructor')->name('instructor.')->group(function (){
    
    // Approval Middleware: You should create this to check if status == 1
    Route::middleware(['isInstructor'])->group(function() {
        Route::get('/dashboard', DashboardController::class)->name('dashboard');
        Route::get('/profile', InstructorProfile::class)->name('profile');

        // For Course
        Route::get('/courses',CoursesController::class)->name('courses');
    });

    Route::get('/pending-approval', function () {

        $instructor = auth('instructor')->user();

        if ($instructor->status == 1) {
            return redirect()->route('dashboard');
        }
        if ($instructor->status == 2) {
            return redirect()->route('register')->with('error', 'Application declined.');
        }

        return view('instructor.pending');
    })->name('pending');
});