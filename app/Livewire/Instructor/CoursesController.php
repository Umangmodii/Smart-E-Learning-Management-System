<?php

namespace App\Livewire\Instructor;

use Livewire\Component;

class CoursesController extends Component
{
    public function render()
    {
        return view('livewire.instructor.courses')
         ->layout('layouts.instructor.dashboard',['title' => 'My Courses']);
    }
}
