<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\EnrollCourses;
class CourseEnroll extends Component
{
    public $breadcrumbs = [];
    public $enrollments = [];
     public function mount()
    {
        $this->breadcrumbs = [
            ['label' => 'Home', 'url' => url('/')],
            ['label' => 'Course Enroll', 'url' => null],
        ];

        $this->enrollments = EnrollCourses::with('course')
            ->where('user_id', auth()->id())
            ->where('status', 'active')
            ->get();

        // echo "<pre>";
        //     print_r($this->enrollments->toArray());
        //     die;
    }
    public function render()
    {
        return view('livewire.course-enroll')
        ->layout('layouts.app',['title' => 'Course Enroll']);
    }
}
