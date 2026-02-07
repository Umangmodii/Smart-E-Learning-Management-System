<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\AdminCategory;
use Illuminate\Http\Request;
use App\Models\Course;
class CourseDetails extends Component
{
    public $category;
    public $courses;
    public $breadcrumbs = [];
    public function mount(Request $request, $category_slug, $course_slug = null)
    {
        $id = $request->query('id');
        $targetSlug = $course_slug ?: $category_slug;

        $this->category = AdminCategory::where('id', $id)
            ->where('slug', $targetSlug)   
            ->where('status', 1) 
            ->firstOrFail();

        $this->courses = Course::where('category_id', $this->category->id)
            ->where('status', 2) 
            ->with('instructor') 
            ->latest()
            ->get();

        $this->breadcrumbs = [
            ['label' => 'Home', 'url' => url('/')],
            ['label' => 'Course Details', 'url' => null],
            ['label' => $this->category->name, 'url' => null],
        ];
    }
    public function render()
    {
        return view('livewire.course-details')
         ->layout('layouts.app',[
            'title' => 'Course Details',
            'breadcrumbs' => $this->breadcrumbs
        ]);
    }
}
