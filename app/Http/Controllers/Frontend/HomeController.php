<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Course; // Import the Course Model

class HomeController extends Controller
{
    public function index()
    {
        // Fetch active banners
        $banners = Banner::where('status', 1)
            ->orderBy('order_priority', 'asc')
            ->get();

        // Fetch published courses (Status 2 = Published)
        $courses = Course::where('status', 2)
            ->with(['instructor', 'category']) // Load relations to show name and category
            ->orderBy('created_at', 'desc')
            ->take(8) // Show top 8 courses on home
            ->get();

        return view('index', compact('banners', 'courses'));
    }

        public function show($slug)
    {
        // Find course by slug, or fail with 404 if not found
        $course = Course::where('slug', $slug)->with(['instructor', 'category'])->firstOrFail();

        return view('instructor.course-details', compact('course'));
    }
}