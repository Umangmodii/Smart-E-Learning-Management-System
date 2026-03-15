<?php

namespace App\Livewire\Instructor;

use Livewire\Component;
use App\Models\CourseReview;

class CourseReviews extends Component
{
    public $breadcrumbs = [];
    public $status = 'pending';

    public function mount()
    {
        $this->breadcrumbs = [
            ['label' => 'Home', 'url' => url('/')],
            ['label' => 'Course Reviews', 'url' => null],
        ];
    }

    public function approve($id)
    {
        CourseReview::findOrFail($id)->update([
            'status' => 1
        ]);

        session()->flash('success','Review approved successfully.');
    }

    public function reject($id)
    {
        CourseReview::findOrFail($id)->update([
            'status' => 0
        ]);

        session()->flash('success','Review moved to pending.');
    }

    public function delete($id)
    {
        CourseReview::findOrFail($id)->delete();

        session()->flash('success','Review deleted.');
    }

    public function render()
    {
        $reviews = CourseReview::with(['user','course'])
            ->when($this->status == 'pending', function ($q) {
                $q->where('status',0);
            })
            ->when($this->status == 'approved', function ($q) {
                $q->where('status',1);
            })
            ->latest()
            ->get();

        return view('livewire.instructor.course-reviews',compact('reviews'))
            ->layout('layouts.instructor.dashboard', ['title' => 'Course Reviews']);
    }
}