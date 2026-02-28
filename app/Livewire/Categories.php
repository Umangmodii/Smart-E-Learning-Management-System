<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\AdminCategory;
use App\Models\Course;

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
    public $viewType = 'grid';
    protected $queryString = [
        'selectedSubCategories' => ['except' => []],
        'selectedLevels' => ['except' => []],
        'selectedLanguages' => ['except' => []],
        'selectedDuration' => ['except' => []],
        'selectedPrice' => ['except' => null],
    ];
    public function mount($category_slug)
    {
        $this->category = AdminCategory::where('slug', $category_slug)->where('status', 1)->firstOrFail();

       $this->breadcrumbs = [
            ['label' => 'Home', 'url' => url('/')],
            ['label' => $this->category->name, 'url' => null],
        ];
    }
    public function updating($property)
    {
        if (in_array($property, ['selectedSubCategories', 'selectedLevels', 'selectedLanguages', 'selectedDuration', 'selectedPrice'])) {
            $this->resetPage();
        }
    }
    public function clearFilters()
    {
        $this->reset(['selectedSubCategories', 'selectedLevels', 'selectedLanguages', 'selectedDuration', 'selectedPrice']);
        $this->resetPage();
    }
    public function setView($type) { $this->viewType = $type; }
    public function render()
    {
        // 1. Separate Parent and Sub Categories
        $mainCategory = AdminCategory::where('id', $this->category->id)
            ->withCount(['courses' => fn($q) => $q->where('status', 2)])->first();

        $subCategories = AdminCategory::where('parent_id', $this->category->id)
            ->where('status', 1)
            ->withCount(['courses' => fn($q) => $q->where('status', 2)])->get();

        // 2. Base Query
        $query = Course::where('status', 2)->with('instructor');

        $courses = $query->latest()->paginate(3);

        // 3. Dynamic Filtering Logic
        if (!empty($this->selectedSubCategories)) {
            $query->whereIn('category_id', $this->selectedSubCategories);
        } else {
            $query->where('category_id', $this->category->id);
        }

        if (!empty($this->selectedLevels)) $query->whereIn('level', $this->selectedLevels);
        if (!empty($this->selectedLanguages)) $query->whereIn('language', $this->selectedLanguages);
        
        // 4. Duration Filter Logic
        if (!empty($this->selectedDuration)) {
        $query->where(function($q) {
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

        if ($this->selectedPrice === 'free') $query->where('price', 0);
        if ($this->selectedPrice === 'paid') $query->where('price', '>', 0);

        // 5. Sidebar Counts
        $levelCounts = Course::where('category_id', $this->category->id)->selectRaw('level, count(*) as total')->groupBy('level')->pluck('total', 'level');
        $langCounts = Course::where('category_id', $this->category->id)->selectRaw('language, count(*) as total')->groupBy('language')->pluck('total', 'language');
        $durationCounts = [
            'short' => Course::where('category_id', $this->category->id)
                ->where('status', 2)
                ->where('total_duration', '<=', 180) // Changed from duration
                ->count(),
            'medium' => Course::where('category_id', $this->category->id)
                ->where('status', 2)
                ->whereBetween('total_duration', [181, 600]) // Changed from duration
                ->count(),
            'long' => Course::where('category_id', $this->category->id)
                ->where('status', 2)
                ->where('total_duration', '>', 600) // Changed from duration
                ->count(),
        ];

        $relatedCourses = Course::where('status', 2)
            ->where('category_id', $this->category->id)
            ->inRandomOrder()
            ->take(8)
            ->get();

        $courses = $query->latest()->paginate(6);

        return view('livewire.category-details', [
            'courses' => $courses,
            'mainCategory' => $mainCategory,
            'relatedCourses' => $relatedCourses,
            'subCategories' => $subCategories,
            'levelCounts' => $levelCounts,
            'langCounts' => $langCounts,
            'durationCounts' => $durationCounts,
            'totalResults' => $courses->total(),
            'breadcrumbs' => $this->breadcrumbs
        ])->layout('layouts.app')
         ->with('title', 'Smart E-Learning - '. $this->category->name);
    }
}