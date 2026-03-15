<?php

namespace App\Livewire;

use Livewire\Component;

class CourseEnroll extends Component
{
    public function render()
    {
        return view('livewire.course-enroll')
        ->layout('layouts.app',['title' => 'Course Enroll']);
    }
}
