<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\CourseReview;

class CourseReviews extends Component
{
    public $breadcrumbs = [];
    public $reviews = [];
    public function mount()
    {
        $this->breadcrumbs = [
            ['label' => 'Home', 'url' => url('/')],
            ['label' => 'Course Reviews', 'url' => null],
        ];

        $this->reviews = CourseReview::with('course')
            ->where('user_id', auth()->id())
            ->where('status', 1)
            ->latest()
            ->get();

            // echo "<pre>";
            // print_r($this->reviews->toArray());
            // die;
    }
    public function render()
    {
        return view('livewire.course-reviews')
        ->layout('layouts.app',['title' => 'Course Reviews']);
    }
}
