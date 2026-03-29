<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EnrollCourses;
class EnrollCourseController extends Controller
{
    public function enroll($courseId)
    {
      EnrollCourses::firstOrCreate([
            'user_id' => auth()->id(),
            'course_id' => $courseId,
        ], [
            'status' => 'active',
        ]);

        // dd($data);
        return redirect()->route('course-enroll')
            ->with('success', 'Course Enrolled successfully!');
    }
}
