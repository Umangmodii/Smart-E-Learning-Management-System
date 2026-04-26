<?php

namespace App\Livewire\Instructor;

use Livewire\Component;
use App\Models\EnrollCourses;
use App\Models\Instructor;

class CourseEnrollments extends Component
{
    public $breadcrumbs;
    public function mount()
    {        
        $this->breadcrumbs = [
            ['label' => 'Home', 'url' => url('/')],
            ['label' => 'Manage Course Enrollments', 'url' => null],
        ];
    }
    public function render()
    {
        $enrollments = EnrollCourses::with(['course','user'])
        ->whereHas('course', function ($query) {
            $query->where('user_id', auth()->id()); 
        })
        ->latest()
        ->get();
          
        // echo '<pre>';
        //     echo print_r($enrollments->toArray());
        //     die;
        // echo '</pre>';

        return view('livewire.instructor.course-enrollments', compact('enrollments'))
        ->layout('layouts.instructor.dashboard',['title' => 'Course Enrollments']);
    }
}
