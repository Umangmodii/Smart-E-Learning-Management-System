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
use App\Http\Controllers\Frontend\HomeController;
use App\Livewire\CourseDetails;
use App\Livewire\Instructor\CoursesController;
use App\Livewire\Admin\ManageCourseController;

/*
|--------------------------------------------------------------------------
| Public Frontend Routes
|--------------------------------------------------------------------------
*/

// Route::get('/test-me', function() {
//     return "If you see this, redirects are NOT happening here.";
// });

// Home Route (Fixed: Only one definition)
Route::get('/', [HomeController::class, 'index'])->name('home');

// Categories Details Route
Route::get('/categories/course/{category_slug}/{course_slug?}', CourseDetails::class)
    ->name('course-details');

// Guest Only Routes (Login/Register)
Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
});

// OAuth Routes
Route::prefix('auth')->group(function () {
    Route::get('/github', [GithubController::class, 'redirect']);
    Route::get('/github/callback', [GithubController::class, 'callback']);
    Route::get('/google', [GoogleController::class, 'redirect']);
    Route::get('/google/callback', [GoogleController::class, 'callback']);
    Route::get('/facebook', [FaceBookController::class, 'redirect']);
    Route::get('/facebook/callback', [FaceBookController::class, 'callback']);
});

/*
|--------------------------------------------------------------------------
| Student / User Protected Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    // Fixed: Combined Dashboard and Profile Edit
    Route::get('/dashboard', EditProfile::class)->name('dashboard');
    Route::get('/account-settings', AccountSettings::class)->name('account-settings');
    Route::get('/login/otp-verify', OtpVerify::class)->name('otp-verify');
    Route::post('/logout', [Dashboard::class, 'logout'])->name('logout');
});

/*
|--------------------------------------------------------------------------
| Admin Routes (Guard: admin)
|--------------------------------------------------------------------------
*/

Route::get('/admin/login', LoginAdmin::class)
    ->name('admin.login')
    ->middleware('guest:admin');

Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', AdminDashboard::class)->name('dashboard');
    Route::get('/profile', AdminProfile::class)->name('profile');
    Route::get('/users', Users::class)->name('users');
    Route::get('/instructors/pending', PendingRequests::class)->name('pending_requests');
    Route::get('/instructors/active', ActiveInstructors::class)->name('active-requests');
    Route::get('/categories', Categories::class)->name('categories');
    Route::get('/banner', Banner::class)->name('banners');
    Route::get('/manage-courses', ManageCourseController::class)->name('manage-courses');
    Route::post('/logout', [AdminProfile::class, 'logout'])->name('logout');
});

/*
|--------------------------------------------------------------------------
| Instructor Routes (Guard: instructor)
|--------------------------------------------------------------------------
*/

Route::prefix('instructor')->name('instructor.')->group(function () {
    
    // Public Instructor Landing
    Route::get('/started-teach', StartedTeach::class)->name('started_teach');

    // Guest Instructor Routes
    Route::middleware('guest:instructor')->group(function () {
        Route::get('/register', Registers::class)->name('register');
        Route::get('/login', LoginUser::class)->name('login');
    });

    // Protected Instructor Routes
    Route::middleware(['auth:instructor'])->group(function () {
        
        // Approved Instructors Only
        Route::middleware(['isInstructor'])->group(function () {
            Route::get('/dashboard', DashboardController::class)->name('dashboard');
            Route::get('/profile', InstructorProfile::class)->name('profile');
            Route::get('/courses', CoursesController::class)->name('courses');
        });

        // Pending Approval Page
        Route::get('/pending-approval', function () {
            $instructor = auth('instructor')->user();
            if ($instructor->status == 1) {
                return redirect()->route('instructor.dashboard');
            }
            if ($instructor->status == 2) {
                return redirect()->route('instructor.register')->with('error', 'Application declined.');
            }
            return view('instructor.pending');
        })->name('pending');
    });
});