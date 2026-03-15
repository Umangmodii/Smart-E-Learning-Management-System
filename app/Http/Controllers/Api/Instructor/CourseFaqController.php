<?php

namespace App\Http\Controllers\Api\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseFaq;
class CourseFaqController extends Controller
{
    public function getCourseFaqs($courseId)
    {
        $course = Course::where('id', $courseId);

        if(!$course){
            return response()->json(['message' => 'Course not found or access denied'], 404);
        }

        $faqs = CourseFaq::where('course_id', $courseId)
            ->orderBy('id', 'asc')
            ->get();
            
        return response()->json([
            'status' => true,
            'message' => 'Course FAQs retrieved successfully',
            'data' => $faqs
        ], 200);
    }
}
