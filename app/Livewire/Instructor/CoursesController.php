<?php

namespace App\Livewire\Instructor;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Course;
use App\Models\AdminCategory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CoursesController extends Component
{
    use WithPagination, WithFileUploads;

    // States
    public $isEditing = false;
    public $isCreating = false;
    public $status = 2; 
    public $course_id;
    public $title, $category_id, $thumbnail, $course_thumbnail_path;
    public $short_description, $description, $price = 0, $discount_price;
    public $level = 'beginner', $language = 'English', $is_published = 0;
    public $meta_keywords, $video_promo_path;
    public $breadcrumbs = [];
    protected $paginationTheme = 'bootstrap';

    public function mount() {
        $this->breadcrumbs = [
            ['label' => 'Home', 'url' => url('/')],
            ['label' => 'Instructor Dashboard', 'url' => route('instructor.dashboard')],
            ['label' => 'My Courses', 'url' => null],
        ];
    }

    public function setTab($status) {
        $this->status = $status;
        $this->resetPage();
    }

    public function toggleCreateMode() {
        $this->isCreating = !$this->isCreating;
        $this->isEditing = false;
        $this->reset(['title', 'category_id', 'thumbnail', 'short_description', 'description', 'price', 'discount_price', 'level', 'language', 'is_published', 'meta_keywords', 'video_promo_path']);
        $this->resetValidation();
    }

    public function editCourse($id) {
        $course = Course::where('user_id', Auth::id())->findOrFail($id);

        $this->course_id = $id;
        $this->title = $course->title;
        $this->category_id = $course->category_id;
        $this->course_thumbnail_path = $course->thumbnail;
        
        $this->short_description = $course->short_description;
        $this->description = $course->description;
        $this->price = $course->price;
        $this->discount_price = $course->discount_price;
        $this->level = $course->level;
        $this->language = $course->language;
        $this->is_published = $course->is_published;
        $this->meta_keywords = $course->meta_keywords;
        $this->video_promo_path = $course->video_promo_path;

        $this->isEditing = true;
        $this->isCreating = false;
        $this->resetValidation();
}

    public function cancelEdit() {
        $this->isEditing = false;
        $this->reset(['course_id', 'title', 'thumbnail', 'category_id', 'course_thumbnail_path', 'short_description', 'description', 'price', 'discount_price', 'level', 'language', 'is_published', 'meta_keywords', 'video_promo_path']);
    }

   public function updateCourse() {
    $course = Course::where('user_id', Auth::id())->findOrFail($this->course_id);

    $this->validate([
        'title'             => 'required|min:10|max:150|unique:courses,title,' . $this->course_id,
        'category_id'       => 'required|exists:categories,id',
        'thumbnail'         => 'nullable|image|max:2048',
        'short_description' => 'nullable|string|max:255',
        'description'       => 'nullable|string',
        'price' => 'required|numeric|min:0|max:9999999.99',
        'discount_price'    => 'nullable|numeric|lt:price',
        'level'             => 'required|in:beginner,intermediate,advanced,all_levels',
        'language'          => 'required|string|max:50',
        'is_published'      => 'boolean',
        'meta_keywords'     => 'nullable|string',
        'video_promo_path'  => 'nullable|string|max:255',
    ]);

    $data = [
        'title'             => $this->title,
        'slug'              => Str::slug($this->title),
        'category_id'       => $this->category_id,
        'short_description' => $this->short_description,
        'description'       => $this->description,
        'price'             => $this->price,
        'discount_price'    => $this->discount_price,
        'level'             => $this->level,
        'language'          => $this->language,
        'is_published'      => $this->is_published,
        'meta_keywords'     => $this->meta_keywords,
        'video_promo_path'  => $this->video_promo_path,
    ];

    if ($this->thumbnail) {
        if ($course->thumbnail) Storage::disk('public')->delete($course->thumbnail);
        $data['thumbnail'] = $this->thumbnail->store('thumbnails', 'public');
    }

    $course->update($data);
    $this->cancelEdit();
    session()->flash('success', 'Course updated successfully!');
 }

    public function store() {
        $this->validate([
            'title' => 'required|min:10|max:150|unique:courses,title',
            'category_id' => 'required|exists:categories,id',
            'thumbnail' => 'nullable|image|max:2048',
            'short_description' => 'nullable|string|max:255',
            'description'       => 'nullable|string',
            'price' => 'required|numeric|min:0|max:9999999.99',
            'discount_price'    => 'nullable|numeric|lt:price',
            'level'             => 'required|in:beginner,intermediate,advanced,all_levels',
            'language'          => 'required|string|max:50',
            'is_published'      => 'boolean',
            'meta_keywords'     => 'nullable|string',
            'video_promo_path'  => 'nullable|string|max:255',
        ]);

        Course::create([
            'user_id' => Auth::id(),
            'category_id' => $this->category_id,
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'thumbnail' => $this->thumbnail ? $this->thumbnail->store('thumbnails', 'public') : null,
            'status' => 0, 
            'short_description' => $this->short_description,
            'description'       => $this->description,
            'price'             => $this->price ?? 0.00,
            'discount_price'    => $this->discount_price,
            'level'             => $this->level ?? 'beginner',
            'language'          => $this->language ?? 'English',
            'meta_keywords'     => $this->meta_keywords,
            'video_promo_path'  => $this->video_promo_path,
            'total_duration'    => 0, 
            'is_published'      => $this->is_published ?? 0,
        ]);

        $this->toggleCreateMode();
        session()->flash('success', 'Course created successfully!');
    }

    public function deleteCourse($id) {
        $course = Course::where('user_id', Auth::id())->findOrFail($id);
        if ($course->thumbnail) Storage::disk('public')->delete($course->thumbnail);
        $course->delete();
        session()->flash('success', 'Course deleted permanently.');
    }

    public function render() {
        return view('livewire.instructor.courses', [
            'courses' => Course::where('user_id', Auth::id())
                ->where('status', $this->status)
                ->with('category')->latest()->paginate(10),
            'categories' => AdminCategory::all(),
            'counts' => [
                'published' => Course::where('user_id', Auth::id())->where('status', 2)->count(),
                'pending' => Course::where('user_id', Auth::id())->where('status', 1)->count(),
                'draft' => Course::where('user_id', Auth::id())->where('status', 0)->count(),
            ]
        ])->layout('layouts.instructor.dashboard', ['title' => 'My Courses']);
    }
}