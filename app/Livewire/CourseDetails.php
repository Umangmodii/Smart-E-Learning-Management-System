<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Course;
use App\Models\CourseFaq;
use App\Models\CourseReview;
class CourseDetails extends Component
{
    public $course;
    public $breadcrumbs = [];
    public $relatedCourses;
    public $faqs = [];
    public $question;
    public $rating;
    public $review;
    public $reviews = [];
    protected $rules = [
        'question' => 'required|string|max:1000',
    ];
    public function mount($course_slug)
    {
        $this->course = Course::with([
                'category',
                'sections.lectures',
                'instructor.details', 
            ])
            ->where('slug', $course_slug)
            ->where('status', 2)
            ->firstOrFail();

        $this->course->total_duration = $this->course->sections
            ->flatMap->lectures
            ->sum('duration');

        $this->relatedCourses = Course::where('status', 2)
            ->where('category_id', $this->course->category_id)
            ->where('id', '!=', $this->course->id)
            ->inRandomOrder()
            ->take(8)
            ->get();

        $this->loadFaqs();

        $this->CourseReview();

        $this->breadcrumbs = [
            ['label' => 'Home', 'url' => url('/')],
            [
                'label' => $this->course->category->name,
                'url' => route('category-details', ['category_slug' => $this->course->category->slug])
            ],
            ['label' => $this->course->title, 'url' => null],
        ];
    }
    public function loadFaqs()
    {
        $this->faqs = CourseFaq::where('course_id', $this->course->id)
            ->where('status', 1)
            ->latest()
            ->get();
    }

    public function CourseReview()
    {
        $this->reviews = CourseReview::where('course_id',$this->course->id)
            ->where('status',1)
            ->latest()
            ->get();
    }
    public function submitQuestion()
    {
        $this->validate();

        CourseFaq::create([
            'course_id' => $this->course->id,
            'question' => $this->question,
            'answer' => '',
            'status' => 0,
        ]);

        $this->question = '';

        session()->flash('success', 'Your question has been submitted. Instructor will answer soon.');

        $this->loadFaqs(); 
    }

    public function submitReview()
    {
        $this->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:1000'
        ]);

        CourseReview::create([
            'course_id' => $this->course->id,
            'user_id' => auth()->id(),
            'rating' => $this->rating,
            'review' => $this->review,
            'status' => 0 // pending approval
        ]);

        session()->flash('review_success','Review submitted and waiting for approval.');

        $this->reset(['rating','review']);
    }
    public function render()
    {
        return view('livewire.course-details')
            ->layout('layouts.app', [
                'title' => $this->course->title,
                'breadcrumbs' => $this->breadcrumbs,
            ]);
    }
}