<?php

namespace App\Livewire\Instructor;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Course;
use App\Models\AdminCategory;
use App\Models\CourseSection;
use App\Models\CourseLecture;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Events\CourseUploaded;

class CoursesController extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';
    public $isEditing = false;
    public $isCreating = false;
    public $status = 2;
    public $course_id;

    public $title, $category_id, $thumbnail, $course_thumbnail_path;
    public $short_description, $description;
    public $price = 0, $discount_price;
    public $level = 'beginner', $language = 'English';
    public $is_published = 0;
    public $meta_keywords, $video_promo_path;

    public $sections = [];

    public $breadcrumbs = [];
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
        $this->isEditing = false;

        $this->reset([
            'course_id',
            'title',
            'category_id',
            'thumbnail',
            'short_description',
            'description',
            'price',
            'discount_price',
            'level',
            'language',
            'is_published',
            'meta_keywords',
            'video_promo_path',
            'sections'
        ]);

        $this->resetValidation();
    }
    public function addSection()
    {
        $this->sections[] = [
            'title' => '',
            'lectures' => []
        ];
    }

    public function removeSection($index)
    {
        unset($this->sections[$index]);
        $this->sections = array_values($this->sections);
    }
    public function addLecture($sectionIndex)
    {
        $this->sections[$sectionIndex]['lectures'][] = [
            'title' => '',
            'video_path' => '',
            'duration' => 0,
            'is_preview' => false,
        ];
    }

    public function removeLecture($sectionIndex, $lectureIndex)
    {
        unset($this->sections[$sectionIndex]['lectures'][$lectureIndex]);
        $this->sections[$sectionIndex]['lectures'] =
            array_values($this->sections[$sectionIndex]['lectures']);
    }
    public function store()
    {
        $this->validate([
            'title' => 'required|min:10|max:150|unique:courses,title',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
        ]);

        DB::transaction(function () {

            $course = Course::create([
                'user_id' => Auth::id(),
                'category_id' => $this->category_id,
                'title' => $this->title,
                'slug' => Str::slug($this->title),
                'thumbnail' => $this->thumbnail
                    ? $this->thumbnail->store('thumbnails', 'public')
                    : null,
                'status' => 0,
                'short_description' => $this->short_description,
                'description' => $this->description,
                'price' => $this->price,
                'discount_price' => $this->discount_price,
                'level' => $this->level,
                'language' => $this->language,
                'meta_keywords' => $this->meta_keywords,
                'video_promo_path' => $this->video_promo_path,
                'total_duration' => 0,
                'is_published' => $this->is_published ?? 0,
            ]);

            $totalDuration = 0;

            foreach ($this->sections as $sectionIndex => $sectionData) {

                $section = CourseSection::create([
                    'course_id' => $course->id,
                    'title' => $sectionData['title'],
                    'order' => $sectionIndex + 1,
                ]);

                foreach ($sectionData['lectures'] as $lectureIndex => $lectureData) {

                    CourseLecture::create([
                        'course_section_id' => $section->id,
                        'title' => $lectureData['title'],
                        'video_path' => $lectureData['video_path'],
                        'duration' => $lectureData['duration'],
                        'is_preview' => $lectureData['is_preview'],
                        'order' => $lectureIndex + 1,
                    ]);

                    $totalDuration += (int) $lectureData['duration'];
                }
            }

            $course->update([
                'total_duration' => $totalDuration
            ]);

            DB::afterCommit(function () use ($course) {
            CourseUploaded::dispatch($course);
        });
    });

        $this->toggleCreateMode();
        session()->flash('success', 'Course created successfully! It will be reviewed by admin before publishing.');
    }

    public function editCourse($id)
    {
        $course = Course::with('sections.lectures')
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        $this->course_id = $id;
        $this->title = $course->title;
        $this->category_id = $course->category_id;
        $this->short_description = $course->short_description;
        $this->description = $course->description;
        $this->price = $course->price;
        $this->discount_price = $course->discount_price;
        $this->level = $course->level;
        $this->language = $course->language;
        $this->is_published = $course->is_published;
        $this->meta_keywords = $course->meta_keywords;
        $this->video_promo_path = $course->video_promo_path;
        $this->course_thumbnail_path = $course->thumbnail;

        $this->sections = [];

        foreach ($course->sections as $section) {

            $sectionArray = [
                'title' => $section->title,
                'lectures' => []
            ];

            foreach ($section->lectures as $lecture) {
                $sectionArray['lectures'][] = [
                    'title' => $lecture->title,
                    'video_path' => $lecture->video_path,
                    'duration' => $lecture->duration,
                    'is_preview' => $lecture->is_preview,
                ];
            }

            $this->sections[] = $sectionArray;
        }

        $this->isEditing = true;
        $this->isCreating = false;
    }

    public function updateCourse()
    {
        $course = Course::where('user_id', Auth::id())
            ->findOrFail($this->course_id);

        DB::transaction(function () use ($course) {

            $course->update([
                'title' => $this->title,
                'slug' => Str::slug($this->title),
                'category_id' => $this->category_id,
                'short_description' => $this->short_description,
                'description' => $this->description,
                'price' => $this->price,
                'discount_price' => $this->discount_price,
                'level' => $this->level,
                'language' => $this->language,
                'is_published' => $this->is_published,
                'meta_keywords' => $this->meta_keywords,
                'video_promo_path' => $this->video_promo_path,
            ]);

            // delete old
            $course->sections()->delete();

            $totalDuration = 0;

            foreach ($this->sections as $sectionIndex => $sectionData) {

                $section = CourseSection::create([
                    'course_id' => $course->id,
                    'title' => $sectionData['title'],
                    'order' => $sectionIndex + 1,
                ]);

                foreach ($sectionData['lectures'] as $lectureIndex => $lectureData) {

                    CourseLecture::create([
                        'course_section_id' => $section->id,
                        'title' => $lectureData['title'],
                        'video_path' => $lectureData['video_path'],
                        'duration' => $lectureData['duration'],
                        'is_preview' => $lectureData['is_preview'],
                        'order' => $lectureIndex + 1,
                    ]);

                    $totalDuration += (int) $lectureData['duration'];
                }
            }

            $course->update([
                'total_duration' => $totalDuration
            ]);
        });

        $this->toggleCreateMode();
        session()->flash('success', 'Course updated successfully!');
    }
    public function deleteCourse($id)
    {
        $course = Course::where('user_id', Auth::id())->findOrFail($id);

        if ($course->thumbnail) {
            Storage::disk('public')->delete($course->thumbnail);
        }

        $course->delete();

        session()->flash('success', 'Course deleted.');
    }
    public function render()
    {
        return view('livewire.instructor.courses', [
            'courses' => Course::where('user_id', Auth::id())
                ->where('status', $this->status)
                ->with('category')
                ->latest()
                ->paginate(10),

            'categories' => AdminCategory::whereNull('parent_id')
                ->with('children')
                ->orderBy('order_priority')
                ->get(),
        ])->layout('layouts.instructor.dashboard', [
            'title' => 'My Courses'
        ]);
    }
}