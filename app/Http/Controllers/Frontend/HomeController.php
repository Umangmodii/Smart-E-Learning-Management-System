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
        $banners = Banner::where('status', 1)
            ->orderBy('order_priority', 'asc')
            ->get();

        $courses = Course::where('status', 2)
            ->with(['instructor', 'category']) 
            ->orderBy('created_at', 'desc')
            ->take(8) 
            ->get();

        return view('index', compact('banners', 'courses'));
    }

    public function show($category_slug, $course_slug) 
    {
    $course = Course::where('slug', $course_slug)
        ->whereHas('category', function ($query) use ($category_slug) {
            $query->where('slug', $category_slug);
        })
        ->with(['instructor', 'category'])
        ->firstOrFail(); 

    return view('instructor.course-details', compact('course'));
    }
}
