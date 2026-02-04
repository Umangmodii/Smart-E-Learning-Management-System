<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\AdminCategory;
use Illuminate\Http\Request;
class CourseDetails extends Component
{
    public $category;
    public $breadcrumbs = [];
    public function mount(Request $request, $category_slug, $course_slug = null)
    {
        $id = $request->query('id');
        $targetSlug = $course_slug ?: $category_slug;

        $this->category = AdminCategory::where('id', $id)
            ->where('slug', $targetSlug)   
            ->where('status', 1) 
            ->firstOrFail();

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
