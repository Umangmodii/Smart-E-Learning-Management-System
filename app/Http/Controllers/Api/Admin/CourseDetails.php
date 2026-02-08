<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class CourseDetails extends Controller
{
    // For fetching course details API endpoint
    public function index()
    {
       $courses = Course::with('category:id,name')
            ->latest()
            ->get();

        // echo '<pre>';
        // print_r($courses);
        // echo '</pre>';

        return response()->json([
            'success' => true, 
            'data' => $courses
        ], 200);
    }
}
