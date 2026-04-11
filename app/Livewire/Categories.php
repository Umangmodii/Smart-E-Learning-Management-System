<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\AdminCategory;
use App\Models\Course;
use App\Models\CourseReview;

class Categories extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $category;
    public $breadcrumbs = [];

    public $selectedSubCategories = [];
    public $selectedLevels = [];
    public $selectedLanguages = [];
    public $selectedDuration = [];
    public $selectedPrice = null;
    public $selectedRating = [];

    public $viewType = 'grid';

    protected $queryString = [
        'selectedSubCategories' => ['except' => []],
        'selectedLevels' => ['except' => []],
        'selectedLanguages' => ['except' => []],
        'selectedDuration' => ['except' => []],
        'selectedPrice' => ['except' => null],
        'selectedRating' => ['except' => []],
    ];

    public function mount($category_slug)
    {
        $this->category = AdminCategory::where('slug', $category_slug)
            ->where('status', 1)
            ->firstOrFail();

        $this->breadcrumbs = [
            ['label' => 'Home', 'url' => url('/')],
            ['label' => $this->category->name, 'url' => null],
        ];
    }

    public function updating($property)
    {
        if (in_array($property, [
            'selectedSubCategories',
            'selectedLevels',
            'selectedLanguages',
            'selectedDuration',
            'selectedPrice',
            'selectedRating'
        ])) {
            $this->resetPage();
        }
    }

    public function clearFilters()
    {
        $this->reset([
            'selectedSubCategories',
            'selectedLevels',
            'selectedLanguages',
            'selectedDuration',
            'selectedPrice',
            'selectedRating'
        ]);
        $this->resetPage();
    }

    public function setView($type)
    {
        $this->viewType = $type;
    }

    public function render()
    {
        $categoryIds = AdminCategory::where('parent_id', $this->category->id)
            ->pluck('id')
            ->push($this->category->id);

        $mainCategory = AdminCategory::where('id', $this->category->id)
            ->withCount(['courses' => fn($q) => $q->where('status', 2)])
            ->first();

        $subCategories = AdminCategory::where('parent_id', $this->category->id)
            ->where('status', 1)
            ->withCount(['courses' => fn($q) => $q->where('status', 2)])
            ->get();

        $query = Course::where('status', 2)->with('instructor');

        if (!empty($this->selectedSubCategories)) {
            $query->whereIn('category_id', $this->selectedSubCategories);
        } else {
            $query->whereIn('category_id', $categoryIds);
        }

        if (!empty($this->selectedLevels)) {
            $query->whereIn('level', $this->selectedLevels);
        }

        if (!empty($this->selectedLanguages)) {
            $query->whereIn('language', $this->selectedLanguages);
        }

        if (!empty($this->selectedDuration)) {
            $query->where(function ($q) {
                if (in_array('short', $this->selectedDuration)) {
                    $q->orWhere('total_duration', '<=', 180);
                }
                if (in_array('medium', $this->selectedDuration)) {
                    $q->orWhereBetween('total_duration', [181, 600]);
                }
                if (in_array('long', $this->selectedDuration)) {
                    $q->orWhere('total_duration', '>', 600);
                }
            });
        }

        if ($this->selectedPrice === 'free') {
            $query->where('price', 0);
        }

        if ($this->selectedPrice === 'paid') {
            $query->where('price', '>', 0);
        }

        if (!empty($this->selectedRating)) {

            $minRating = min($this->selectedRating);

            $query->whereHas('reviews', function ($q) use ($minRating) {
                $q->where('status', 1)
                  ->where('rating', '>=', $minRating);
            });
        }

        $levelCounts = Course::whereIn('category_id', $categoryIds)
            ->selectRaw('level, count(*) as total')
            ->groupBy('level')
            ->pluck('total', 'level');

        $langCounts = Course::whereIn('category_id', $categoryIds)
            ->selectRaw('language, count(*) as total')
            ->groupBy('language')
            ->pluck('total', 'language');

        $durationCounts = [
            'short' => Course::whereIn('category_id', $categoryIds)->where('status', 2)->where('total_duration', '<=', 180)->count(),
            'medium' => Course::whereIn('category_id', $categoryIds)->where('status', 2)->whereBetween('total_duration', [181, 600])->count(),
            'long' => Course::whereIn('category_id', $categoryIds)->where('status', 2)->where('total_duration', '>', 600)->count(),
        ];

        $courseIds = Course::whereIn('category_id', $categoryIds)->pluck('id');

        $ratingsData = CourseReview::whereIn('course_id', $courseIds)
            ->where('status', 1)
            ->selectRaw('rating, COUNT(*) as total')
            ->groupBy('rating')
            ->pluck('total', 'rating')
            ->toArray();

        $ratings = [
            5 => $ratingsData[5] ?? 0,
            4 => $ratingsData[4] ?? 0,
            3 => $ratingsData[3] ?? 0,
            2 => $ratingsData[2] ?? 0,
            1 => $ratingsData[1] ?? 0,
        ];

        $courses = $query->latest()->paginate(6);

        $relatedCourses = Course::where('status', 2)
            ->whereIn('category_id', $categoryIds)
            ->inRandomOrder()
            ->take(8)
            ->get();

        return view('livewire.category-details', [
            'courses' => $courses,
            'mainCategory' => $mainCategory,
            'relatedCourses' => $relatedCourses,
            'subCategories' => $subCategories,
            'levelCounts' => $levelCounts,
            'langCounts' => $langCounts,
            'durationCounts' => $durationCounts,
            'ratings' => $ratings,
            'totalResults' => $courses->total(),
            'breadcrumbs' => $this->breadcrumbs
        ])->layout('layouts.app')
          ->with('title', 'Smart E-Learning - ' . $this->category->name);
    }
}