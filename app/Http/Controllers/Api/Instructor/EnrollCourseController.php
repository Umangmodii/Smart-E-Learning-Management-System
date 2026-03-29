<?php

namespace App\Http\Controllers\Api\Instructor;

use App\Http\Controllers\Controller;
use App\Models\EnrollCourses;

class EnrollCourseController extends Controller
{
    public function getEnrolledCourses()
    {
        $enrollments = EnrollCourses::with('course')
            ->where('user_id', auth()->id())
            ->orderBy('id', 'asc')
            ->get();
    
        if ($enrollments->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'No enrolled courses found',
                'data' => []
            ], 404);
        }

        // echo "<pre>";
        //     print_r($enrollments->toArray());
        //     die;
        // echo "</pre>";

        return response()->json([
            'status' => true,
            'message' => 'Course Enrollments retrieved successfully',
            'data' => $enrollments
        ], 200);
    }
}
