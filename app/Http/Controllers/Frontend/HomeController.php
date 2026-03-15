<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Course; 
use App\Models\AdminCategory;
use App\Models\Instructor;
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

        $categories = AdminCategory::withCount(['courses' => function ($query) {
                $query->where('status', 2);
                }])->where('status', 1)
                ->orderBy('name')
                ->get();

       $instructors = Instructor::with('details')
            ->withCount(['courses' => function ($query) {
                $query->where('status', 2);
            }])
            ->latest()
            ->take(4)
            ->get();

        $viewType = 'grid';

        return view('index', compact('banners', 'courses','viewType','categories','instructors'));
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
