<?php

namespace App\Livewire\Instructor;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Course;
use App\Models\AdminCategory;
use App\Models\Instructor;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CoursesController extends Component
{
    use WithPagination, WithFileUploads;

    public $isCreating = false;
    public $status = 2; // Tabs: 2=Published, 1=Pending, 0=Draft
    public $title, $category_id, $thumbnail;
    public $breadcrumbs = [];
    protected $paginationTheme = 'bootstrap';
    public function mount()
    {
        $this->breadcrumbs = [
            ['label' => 'Home', 'url' => url('/')],
            ['label' => 'Instructor Dashboard', 'url' => route('instructor.dashboard')],
            ['label' => 'My Courses', 'url' => null],
        ];
    }
    public function setTab($status)
    {
        $this->status = $status;
        $this->resetPage();
    }
    public function toggleCreateMode()
    {
        $this->isCreating = !$this->isCreating;
        $this->reset(['title', 'category_id', 'thumbnail']);
        $this->resetValidation();
    }
    public function store()
    {
        $this->validate([
            'title' => 'required|min:10|max:150|unique:courses,title',
            'category_id' => 'required|exists:categories,id',
            'thumbnail' => 'nullable|image|max:2048',
        ]);

        if (!Instructor::where('id', Auth::id())->exists()) {
            session()->flash('error', 'Authentication Error. Please re-login.');
            return;
        }

        try {
            Course::create([
                'user_id' => Auth::id(),
                'category_id' => $this->category_id,
                'title' => $this->title,
                'slug' => Str::slug($this->title),
                'thumbnail' => $this->thumbnail ? $this->thumbnail->store('thumbnails', 'public') : null,
                'status' => 0, 
            ]);

            $this->toggleCreateMode();
            session()->flash('success', 'Course shell created successfully!');
        } catch (\Exception $e) {
            session()->flash('error', 'Database Error: ' . $e->getMessage());
        }
    }

    public function submitForReview($id)
    {
        $course = Course::where('user_id', Auth::id())->findOrFail($id);
        $course->update([
            'status' => 1,
            'submitted_at' => now()
        ]);
        session()->flash('success', 'Course submitted for Admin review.');
    }

    public function deleteCourse($id)
    {
        $course = Course::where('user_id', Auth::id())->findOrFail($id);
        if ($course->thumbnail) {
            Storage::disk('public')->delete($course->thumbnail);
        }
        $course->delete();
        session()->flash('success', 'Course deleted permanently.');
    }

    public function render()
    {
        return view('livewire.instructor.courses', [
            'courses' => Course::where('user_id', Auth::id())
                ->where('status', $this->status)
                ->with('category')
                ->latest()
                ->paginate(10),
            'categories' => AdminCategory::all(),
            'counts' => [
                'published' => Course::where('user_id', Auth::id())->where('status', 2)->count(),
                'pending'   => Course::where('user_id', Auth::id())->where('status', 1)->count(),
                'draft'     => Course::where('user_id', Auth::id())->where('status', 0)->count(),
            ]
        ])->layout('layouts.instructor.dashboard', ['title' => 'My Courses']);
    }
}