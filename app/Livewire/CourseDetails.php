<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Course;

class CourseDetails extends Component
{
    public $course;
    public $breadcrumbs = [];
    public $selectedLevels = [];
    public $selectedLanguages = [];
    public $selectedPrice = null; // free / paid
    public $courses;
     public function mount($course_slug)
    {
        $this->course = Course::with('category')
            ->where('slug', $course_slug)
            ->where('status', 2)
            ->firstOrFail();

        $this->relatedCourses = Course::where('category_id', $this->course->category_id)
            ->where('id','!=',$this->course->id)
            ->where('status',2)
            ->take(4)
            ->get();

        $this->breadcrumbs = [
            ['label' => 'Home', 'url' => url('/')],
            ['label' => $this->course->category->name, 'url' => route('category-details', ['category_slug' => $this->course->category->slug])],
            ['label' => $this->course->title, 'url' => null],
        ];
    }

    public function render()
    {
        return view('livewire.course-details')
             ->layout('layouts.app', [
                'title' => $this->course->title,
                'breadcrumbs' => $this->breadcrumbs
            ]);
    }
}