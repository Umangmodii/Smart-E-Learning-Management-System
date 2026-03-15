<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
class CourseDetails extends Controller
{
    // For fetching course details API endpoint
    public function index()
    {
       $courses = Course::with([
            'category.courses',
            'sections.lectures', 
            'instructor.details'
        ])
            ->latest()
            ->get();

        // echo '<pre>';
        //     print_r($courses);
        // echo '</pre>';

        return response()->json([
            'Total Course' => count($courses),
            'success' => true, 
            'data' => $courses
        ], 200);
    }
}
