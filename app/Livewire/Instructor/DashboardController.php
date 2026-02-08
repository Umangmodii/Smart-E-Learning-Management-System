<?php

namespace App\Livewire\Instructor;

use Livewire\Component;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Component
{
    public $breadcrumbs = [];

    public function mount()
    {
        $this->breadcrumbs = [
            ['label' => 'Home', 'url' => url('/')],
            ['label' => 'Dashboard', 'url' => null],
        ];
    }
    public function render()
    {
       $instructorId = Auth::id();
        
        return view('livewire.instructor.dashboard', [
            'totalCourses'   => Course::where('user_id', $instructorId)->count(),
            'activeCourses'  => Course::where('user_id', $instructorId)->where('status', 2)->count(),
            'pendingCourses' => Course::where('user_id', $instructorId)->where('status', 1)->count(),
            'latestCourses'  => Course::where('user_id', $instructorId)->latest()->take(5)->get()
        ])->layout('layouts.instructor.dashboard',['title' => 'Instructor Dashboard']);
    }
}
