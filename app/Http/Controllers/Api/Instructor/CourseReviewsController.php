<?php

namespace App\Http\Controllers\Api\Instructor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CourseReview;

class CourseReviewsController extends Controller
{
    public function getCourseReviews($courseId)
    {
        $course = Course::where('id', $courseId)->first();

        if(!$course){
            return response()->json(['message' => 'Course not found or access denied'], 404);
        }

        $reviews = CourseReview::where('course_id', $courseId)
            ->where('status', 1)
            ->orderBy('id', 'asc')
            ->get();

        return response()->json([
            'status' => true,
            'message' => 'Course reviews retrieved successfully',
            'data' => $reviews
        ], 200);
    }
}