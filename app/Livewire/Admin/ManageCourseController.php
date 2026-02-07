<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Course;
class ManageCourseController extends Component
{   
    use WithPagination;
    public $status = 1; // Default to 'Pending Review'
    public $admin_feedback = ''; 
    protected $paginationTheme = 'bootstrap';
    public $breadcrumbs = [];
    public function mount()
    {
        $this->breadcrumbs = [
            ['label' => 'Home', 'url' => url('/')],
            ['label' => 'Admin Manage Courses', 'url' => null],
        ];
    }
    public function setTab($status)
    {
        $this->status = $status;
        $this->resetPage();
    }
    public function approve($id)
    {
        $course = Course::findOrFail($id);
        $course->update([
            'status' => 2, // Published
            'approved_at' => now(),
            'approved_by' => auth()->id(), // Assuming admin is logged in
            'admin_feedback' => null
        ]);

        session()->flash('success', "Course '{$course->title}' has been published.");
    }

    public function reject($id)
    {
        $this->validate([
            'admin_feedback' => 'required|min:10'
        ]);

        $course = Course::findOrFail($id);
        $course->update([
            'status' => 3, // Rejected
            'admin_feedback' => $this->admin_feedback,
            'submitted_at' => null // Reset submission
        ]);

        $this->admin_feedback = '';
        session()->flash('info', 'Course rejected and feedback sent to instructor.');
    }

    public function moveToReview($id) {
        $course = Course::findOrFail($id);
        $course->update([
            'status' => 1, // Status becomes Pending
            'submitted_at' => now()
        ]);
        session()->flash('success', 'Course moved to Review Queue.');
    }

    public function render()
    {
        $courses = Course::where('status', $this->status)
            ->with(['instructor', 'category']) // Eager load for performance
            ->latest()
            ->paginate(10);

        // Calculate counts for the tab badges
        $counts = [
            'pending' => Course::where('status', 1)->count(),
            'published' => Course::where('status', 2)->count(),
            'drafts' => Course::where('status', 0)->count(),
        ];
        return view('livewire.admin.manage-courses', [
            'courses' => $courses,
            'counts'  => $counts,
        ])->layout('layouts.admin.main', ['title' => 'Manage Courses']);
    }
}
