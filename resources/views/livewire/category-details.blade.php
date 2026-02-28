<div x-data="{ initialLoading: true }" x-init="setTimeout(() => initialLoading = false, 700)">
    
    {{-- ================= BREADCRUMB ================= --}}
    <x-slot name="breadcrumbSlot">
        <nav aria-label="breadcrumb" class="py-2 bg-light border-bottom mb-4">
            <div class="container">
                <ol class="breadcrumb mb-0 small">
                    @foreach($breadcrumbs ?? [] as $item)
                        <li class="breadcrumb-item {{ $loop->last ? 'active fw-bold' : '' }}">
                            @if(!empty($item['url']) && !$loop->last)
                                <a href="{{ $item['url'] }}" class="text-decoration-none text-primary">{{ $item['label'] }}</a>
                            @else
                                {{ $item['label'] }}
                            @endif
                        </li>
                    @endforeach
                </ol>
            </div>
        </nav>
    </x-slot>

    {{-- ================= POPULAR TOPICS GRID (5 COLUMNS) ================= --}}
    <div class="container mb-5">
        <h4 class="fw-bold mb-3 text-dark">Popular topics</h4>
        <div class="row g-2">
            {{-- Main Category Box --}}
            <div class="col-6 col-md-4 col-lg-2-4">
                <a href="{{ route('category-details', $category->slug) }}" 
                   class="btn topic-btn w-100 py-3 fw-bold active-topic shadow-sm">
                    {{ $category->name }}
                </a>
            </div>

            {{-- Subcategory Boxes --}}
            @foreach($subCategories->take(9) as $sub)
                <div class="col-6 col-md-4 col-lg-2-4">
                    <a href="{{ route('category-details', $sub->slug) }}" 
                       class="btn topic-btn w-100 py-3 fw-bold text-truncate shadow-sm">
                        {{ $sub->name }}
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <div class="container py-4">
        {{-- Header: Results Info + View Toggles --}}

        {{-- ================= MOBILE FILTER BUTTON ================= --}}
<div class="d-lg-none mb-3">
    <button class="btn btn-outline-primary w-100 rounded-pill" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileFilter" aria-controls="mobileFilter">
        <i class="bi bi-funnel-fill me-2"></i> Filter Courses
    </button>
</div>

{{-- ================= MOBILE FILTER OFFCANVAS ================= --}}
<div class="offcanvas offcanvas-start" tabindex="-1" id="mobileFilter" aria-labelledby="mobileFilterLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title fw-bold" id="mobileFilterLabel">Filter Courses</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        {{-- Include the same accordion as desktop --}}
        <div class="accordion shadow-sm border-0 rounded-3 overflow-hidden" id="filterAccordionMobile">

            {{-- 1. MAIN CATEGORY --}}
            <div class="accordion-item border-0 border-bottom">
                <h2 class="accordion-header">
                    <button class="accordion-button fw-bold py-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseMainMobile">
                        Category
                    </button>
                </h2>
                <div id="collapseMainMobile" class="accordion-collapse collapse show">
                    <div class="accordion-body py-2">
                        <div class="form-check d-flex justify-content-between align-items-center mb-1 ps-0">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" wire:model.live="selectedSubCategories" value="{{ $mainCategory->id }}" class="form-check-input ms-0 me-2" id="main-cat-mobile">
                                <label class="form-check-label small fw-bold cursor-pointer" for="main-cat-mobile">{{ $mainCategory->name }} (All)</label>
                            </div>
                            <span class="badge rounded-pill bg-light text-muted border tiny">{{ $mainCategory->courses_count }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 2. SUB CATEGORIES --}}
            @if($subCategories->isNotEmpty())
            <div class="accordion-item border-0 border-bottom">
                <h2 class="accordion-header">
                    <button class="accordion-button fw-bold py-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSubMobile">
                        Sub Categories
                    </button>
                </h2>
                <div id="collapseSubMobile" class="accordion-collapse collapse show">
                    <div class="accordion-body py-2">
                        @foreach($subCategories as $sub)
                            <div class="form-check d-flex justify-content-between align-items-center mb-1 ps-0">
                                <div class="d-flex align-items-center">
                                    <input type="checkbox" wire:model.live="selectedSubCategories" value="{{ $sub->id }}" class="form-check-input ms-0 me-2" id="sub-{{ $sub->id }}-mobile">
                                    <label class="form-check-label small cursor-pointer" for="sub-{{ $sub->id }}-mobile">{{ $sub->name }}</label>
                                </div>
                                <span class="badge rounded-pill bg-light text-muted border tiny">{{ $sub->courses_count }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            {{-- 3. LEVEL --}}
            <div class="accordion-item border-0 border-bottom">
                <h2 class="accordion-header">
                    <button class="accordion-button fw-bold py-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseLevelMobile">
                        Level
                    </button>
                </h2>
                <div id="collapseLevelMobile" class="accordion-collapse collapse show">
                    <div class="accordion-body py-2">
                        @foreach(['beginner', 'intermediate', 'advanced'] as $lvl)
                            <div class="form-check d-flex justify-content-between align-items-center mb-1 ps-0">
                                <div class="d-flex align-items-center">
                                    <input type="checkbox" wire:model.live="selectedLevels" value="{{ $lvl }}" class="form-check-input ms-0 me-2" id="L-{{ $lvl }}-mobile">
                                    <label class="form-check-label small cursor-pointer" for="L-{{ $lvl }}-mobile">{{ ucfirst($lvl) }}</label>
                                </div>
                                <span class="text-muted tiny">({{ $levelCounts[$lvl] ?? 0 }})</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- 4. DURATION --}}
            <div class="accordion-item border-0 border-bottom">
                <h2 class="accordion-header">
                    <button class="accordion-button fw-bold py-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDurMobile">
                        Duration
                    </button>
                </h2>
                <div id="collapseDurMobile" class="accordion-collapse collapse show">
                    <div class="accordion-body py-2">
                        @foreach(['short' => '0-3 Hours', 'medium' => '3-10 Hours', 'long' => '10+ Hours'] as $key => $label)
                            <div class="form-check d-flex justify-content-between align-items-center mb-1 ps-0">
                                <div class="d-flex align-items-center">
                                    <input type="checkbox" wire:model.live="selectedDuration" value="{{ $key }}" class="form-check-input ms-0 me-2" id="D-{{ $key }}-mobile">
                                    <label class="form-check-label small cursor-pointer" for="D-{{ $key }}-mobile">{{ $label }}</label>
                                </div>
                                <span class="text-muted tiny">({{ $durationCounts[$key] ?? 0 }})</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- 5. PRICE --}}
            <div class="accordion-item border-0">
                <h2 class="accordion-header">
                    <button class="accordion-button fw-bold py-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePriceMobile">
                        Price
                    </button>
                </h2>
                <div id="collapsePriceMobile" class="accordion-collapse collapse show">
                    <div class="accordion-body py-2">
                        <div class="form-check mb-1 ps-0">
                            <input type="radio" wire:model.live="selectedPrice" value="paid" class="form-check-input ms-0 me-2" id="p-paid-mobile">
                            <label class="form-check-label small cursor-pointer" for="p-paid-mobile">Paid</label>
                        </div>
                        <div class="form-check ps-0">
                            <input type="radio" wire:model.live="selectedPrice" value="free" class="form-check-input ms-0 me-2" id="p-free-mobile">
                            <label class="form-check-label small cursor-pointer" for="p-free-mobile">Free</label>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- Clear Button --}}
        <button wire:click="clearFilters" class="btn btn-danger btn-sm w-100 rounded-pill mt-3 shadow-sm py-2">
            <i class="bi bi-x-circle me-1"></i> Clear All Filters
        </button>
    </div>
</div>


        <div class="row align-items-center mb-4">
            <div class="col-md-6">
                <h4 class="fw-bold mb-0 text-dark">{{ $category->name }} Courses</h4>
                <p class="text-muted mb-0 small">Showing {{ $courses->firstItem() ?? 0 }} to {{ $courses->lastItem() ?? 0 }} of {{ $totalResults }} results</p>
            </div>
            <div class="col-md-6 text-md-end mt-3 mt-md-0">
                <div class="btn-group btn-group-sm shadow-sm rounded">
                    <button wire:click="setView('grid')" class="btn btn-outline-primary {{ $viewType == 'grid' ? 'active' : '' }}">
                        <i class="bi bi-grid-3x3-gap-fill"></i> Grid
                    </button>
                    <button wire:click="setView('list')" class="btn btn-outline-primary {{ $viewType == 'list' ? 'active' : '' }}">
                        <i class="bi bi-list-task"></i> List
                    </button>
                </div>
            </div>
        </div>

        <div class="row align-items-start">
            
            {{-- ================= SIDEBAR (STICKY ACCORDION) ================= --}}
            <aside class="col-lg-3 d-none d-lg-block">
                <div class="sticky-sidebar">
                    <div class="accordion shadow-sm border-0 rounded-3 overflow-hidden" id="filterAccordion">
                        
                        {{-- 1. MAIN CATEGORY --}}
                        <div class="accordion-item border-0 border-bottom">
                            <h2 class="accordion-header">
                                <button class="accordion-button fw-bold py-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseMain">
                                    Category
                                </button>
                            </h2>
                            <div id="collapseMain" class="accordion-collapse collapse show">
                                <div class="accordion-body py-2">
                                    <div class="form-check d-flex justify-content-between align-items-center mb-1 ps-0">
                                        <div class="d-flex align-items-center">
                                            <input type="checkbox" wire:model.live="selectedSubCategories" value="{{ $mainCategory->id }}" class="form-check-input ms-0 me-2" id="main-cat">
                                            <label class="form-check-label small fw-bold cursor-pointer" for="main-cat">{{ $mainCategory->name }} (All)</label>
                                        </div>
                                        <span class="badge rounded-pill bg-light text-muted border tiny">{{ $mainCategory->courses_count }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- 2. SUB CATEGORIES --}}
                        @if($subCategories->isNotEmpty())
                        <div class="accordion-item border-0 border-bottom">
                            <h2 class="accordion-header">
                                <button class="accordion-button fw-bold py-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSub">
                                    Sub Categories
                                </button>
                            </h2>
                            <div id="collapseSub" class="accordion-collapse collapse show">
                                <div class="accordion-body py-2">
                                    @foreach($subCategories as $sub)
                                        <div class="form-check d-flex justify-content-between align-items-center mb-1 ps-0">
                                            <div class="d-flex align-items-center">
                                                <input type="checkbox" wire:model.live="selectedSubCategories" value="{{ $sub->id }}" class="form-check-input ms-0 me-2" id="sub-{{ $sub->id }}">
                                                <label class="form-check-label small cursor-pointer" for="sub-{{ $sub->id }}">{{ $sub->name }}</label>
                                            </div>
                                            <span class="badge rounded-pill bg-light text-muted border tiny">{{ $sub->courses_count }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endif

                        {{-- 3. DIFFICULTY LEVEL --}}
                        <div class="accordion-item border-0 border-bottom">
                            <h2 class="accordion-header">
                                <button class="accordion-button fw-bold py-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseLevel">
                                    Level
                                </button>
                            </h2>
                            <div id="collapseLevel" class="accordion-collapse collapse show">
                                <div class="accordion-body py-2">
                                    @foreach(['beginner', 'intermediate', 'advanced'] as $lvl)
                                        <div class="form-check d-flex justify-content-between align-items-center mb-1 ps-0">
                                            <div class="d-flex align-items-center">
                                                <input type="checkbox" wire:model.live="selectedLevels" value="{{ $lvl }}" class="form-check-input ms-0 me-2" id="L-{{ $lvl }}">
                                                <label class="form-check-label small cursor-pointer" for="L-{{ $lvl }}">{{ ucfirst($lvl) }}</label>
                                            </div>
                                            <span class="text-muted tiny">({{ $levelCounts[$lvl] ?? 0 }})</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        {{-- 4. DURATION --}}
                        <div class="accordion-item border-0 border-bottom">
                            <h2 class="accordion-header">
                                <button class="accordion-button fw-bold py-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDur">
                                    Duration
                                </button>
                            </h2>
                            <div id="collapseDur" class="accordion-collapse collapse show">
                                <div class="accordion-body py-2">
                                    @foreach(['short' => '0-3 Hours', 'medium' => '3-10 Hours', 'long' => '10+ Hours'] as $key => $label)
                                        <div class="form-check d-flex justify-content-between align-items-center mb-1 ps-0">
                                            <div class="d-flex align-items-center">
                                                <input type="checkbox" wire:model.live="selectedDuration" value="{{ $key }}" class="form-check-input ms-0 me-2" id="D-{{ $key }}">
                                                <label class="form-check-label small cursor-pointer" for="D-{{ $key }}">{{ $label }}</label>
                                            </div>
                                            <span class="text-muted tiny">({{ $durationCounts[$key] ?? 0 }})</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        {{-- 5. PRICE --}}
                        <div class="accordion-item border-0">
                            <h2 class="accordion-header">
                                <button class="accordion-button fw-bold py-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePrice">
                                    Price
                                </button>
                            </h2>
                            <div id="collapsePrice" class="accordion-collapse collapse show">
                                <div class="accordion-body py-2">
                                    <div class="form-check mb-1 ps-0">
                                        <input type="radio" wire:model.live="selectedPrice" value="paid" class="form-check-input ms-0 me-2" id="p-paid">
                                        <label class="form-check-label small cursor-pointer" for="p-paid">Paid</label>
                                    </div>
                                    <div class="form-check ps-0">
                                        <input type="radio" wire:model.live="selectedPrice" value="free" class="form-check-input ms-0 me-2" id="p-free">
                                        <label class="form-check-label small cursor-pointer" for="p-free">Free</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button wire:click="clearFilters" class="btn btn-danger btn-sm w-100 rounded-pill mt-3 shadow-sm py-2">
                        <i class="bi bi-x-circle me-1"></i> Clear All Filters
                    </button>
                </div>
            </aside>

            {{-- ================= MAIN CONTENT SECTION ================= --}}
            <main class="col-lg-9">

                {{-- ACTUAL COURSE GRID --}}
           <div x-show="!initialLoading" wire:loading.remove x-cloak>
    <div class="row g-3">
        @forelse($courses as $course)
            <div class="{{ $viewType == 'grid' ? 'col-6 col-md-4' : 'col-12' }}">
                <div class="card border-0 shadow-sm h-100 course-card {{ $viewType == 'list' ? 'flex-md-row p-2' : '' }}">
                    
                    {{-- COURSE IMAGE --}}
                    <div class="{{ $viewType == 'list' ? 'col-md-4' : '' }}">
                        <div class="card-img-wrapper rounded overflow-hidden">
                            <img src="{{ $course->thumbnail ? asset('storage/'.$course->thumbnail) : 'https://placehold.co/400x225' }}" 
                                 class="card-img-top" alt="{{ $course->title }}" style="aspect-ratio:16/9; object-fit:cover;">
                        </div>
                    </div>

                    {{-- COURSE CONTENT --}}
                    <div class="card-body p-3 d-flex flex-column position-relative">
                        <h6 class="fw-bold mb-1 {{ $viewType == 'list' ? 'fs-5' : 'text-truncate-2' }}">
                            {{ $course->title }}
                        </h6>
                        <p class="text-muted small mb-2 {{ $viewType == 'grid' ? 'text-truncate-2' : '' }}" 
                           style="font-size: 0.85rem; line-height: 1.4;">
                            {{ $course->short_description ?? 'Learn the essentials of ' . $course->title . ' and advance your skills with professional training.' }}
                        </p>
                        <p class="extra-small text-muted mb-1">By {{ $course->instructor->name ?? 'Expert' }}</p>
                        <div class="extra-small text-warning mb-2">
                            <i class="bi bi-star-fill"></i> 4.9 
                            <span class="text-muted small">(1,250 reviews)</span>
                        </div>

                        {{-- PRICE --}}
                        <span class="fw-bold text-dark fs-5">₹{{ number_format($course->price, 0) }}</span>

                        {{-- ADD TO CART BUTTON --}}
                        <form action="{{ route('add.to.cart', $course->id) }}" method="POST" class="mt-2">
                            @csrf
                            <button type="submit" 
                                    class="btn btn-primary btn-sm rounded-pill px-3 fw-bold shadow-none w-100 w-md-auto"
                                    onclick="event.stopPropagation();">
                                Add to Cart
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-5 w-100">
                <i class="bi bi-search display-1 text-light"></i>
                <h5 class="text-muted mt-3">No courses match your criteria.</h5>
                <button wire:click="clearFilters" class="btn btn-primary btn-sm mt-2 rounded-pill px-4">
                    Reset Filters
                </button>
            </div>
        @endforelse
    </div>

    {{-- PAGINATION --}}
    @if ($courses->hasPages())
        <div class="mt-5 d-flex justify-content-center">
            <nav aria-label="Page navigation">
                <ul class="pagination pagination-lg border-0">
                    <li class="page-item mx-1 {{ $courses->onFirstPage() ? 'disabled' : '' }}">
                        <button class="page-link border-0 rounded-circle text-dark shadow-sm" wire:click="previousPage">
                            <i class="bi bi-arrow-left"></i>
                        </button>
                    </li>

                    @foreach ($courses->getUrlRange(1, $courses->lastPage()) as $page => $url)
                        <li class="page-item mx-1">
                            <button class="page-link border-0 rounded-circle shadow-sm {{ $page == $courses->currentPage() ? 'bg-dark text-white' : 'text-dark bg-white' }}" 
                                    wire:click="gotoPage({{ $page }})">
                                {{ $page }}
                            </button>
                        </li>
                    @endforeach

                    <li class="page-item mx-1 {{ !$courses->hasMorePages() ? 'disabled' : '' }}">
                        <button class="page-link border-0 rounded-circle text-dark shadow-sm" wire:click="nextPage">
                            <i class="bi bi-arrow-right"></i>
                        </button>
                    </li>
                </ul>
            </nav>
        </div>
    @endif
  </div>
</main>
{{-- ================= RELATED COURSES SLIDER ================= --}}
@if($relatedCourses->count() > 0)
<section class="py-5 bg-white mt-2">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0">Explore More Courses</h4>
        </div>

        <div wire:ignore>

            {{-- DESKTOP: 4 per slide --}}
            <div id="relatedCoursesCarouselDesktop" class="carousel slide d-none d-lg-block" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach($relatedCourses->chunk(4) as $index => $chunk)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            <div class="row g-4">
                                @foreach($chunk as $course)
                                    <div class="col-lg-3">
                                        <a href="{{ route('course-details', $course->slug) }}" class="text-decoration-none text-dark">
                                            <div class="card border-0 shadow-sm related-course-card">

                                                <img src="{{ asset('storage/'.$course->thumbnail) }}"
                                                     class="card-img-top"
                                                     style="aspect-ratio:16/9; object-fit:cover;">

                                                <div class="card-body">
                                                    <h6 class="fw-bold mb-2 line-clamp-2 text-truncate-2">{{ $course->title }}</h6>

                                                    <p class="text-muted small mb-2 course-description">
                                                        {{ $course->short_description ?? 'Learn the essentials of ' . $course->title . ' and advance your skills with professional training.' }}
                                                    </p>

                                                    <p class="extra-small text-muted mb-1">By {{ $course->instructor->name ?? 'Expert' }}</p>

                                                    <div class="extra-small text-warning mb-2">
                                                        <i class="bi bi-star-fill"></i> 4.9
                                                        <span class="text-muted small">(1,250 reviews)</span>
                                                    </div>

                                                    <span class="fw-bold text-dark fs-5">₹{{ number_format($course->price, 0) }}</span>

                                                    <form action="{{ route('add.to.cart', $course->id) }}" method="POST" class="mt-2">
                                                        @csrf
                                                        <button type="submit" 
                                                                class="btn btn-primary btn-sm rounded-pill px-3 fw-bold shadow-none w-100 w-md-auto"
                                                                onclick="event.stopPropagation();">
                                                            Add to Cart
                                                        </button>
                                                    </form>
                                                </div>

                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

                @if($relatedCourses->count() > 4)
                <button class="carousel-control-prev" type="button" data-bs-target="#relatedCoursesCarouselDesktop" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bg-dark rounded-circle p-3"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#relatedCoursesCarouselDesktop" data-bs-slide="next">
                    <span class="carousel-control-next-icon bg-dark rounded-circle p-3"></span>
                </button>
                @endif
            </div>

            {{-- MOBILE: 2 per slide --}}
            <div id="relatedCoursesCarouselMobile" class="carousel slide d-block d-lg-none" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach($relatedCourses->chunk(2) as $index => $chunk)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            <div class="row g-4">
                                @foreach($chunk as $course)
                                    <div class="col-6">
                                        <a href="{{ route('course-details', $course->slug) }}" class="text-decoration-none text-dark">
                                            <div class="card border-0 shadow-sm related-course-card">

                                                <img src="{{ asset('storage/'.$course->thumbnail) }}"
                                                     class="card-img-top"
                                                     style="aspect-ratio:16/9; object-fit:cover;">

                                                <div class="card-body">
                                                    <h6 class="fw-bold mb-2 line-clamp-2">{{ $course->title }}</h6>


                                                    <p class="text-muted small mb-2 course-description">
                                                        {{ $course->short_description ?? 'Learn the essentials of ' . $course->title . ' and advance your skills with professional training.' }}
                                                    </p>

                                                    <p class="extra-small text-muted mb-1">By {{ $course->instructor->name ?? 'Expert' }}</p>

                                                    <div class="extra-small text-warning mb-2">
                                                        <i class="bi bi-star-fill"></i> 4.9
                                                        <span class="text-muted small">(1,250 reviews)</span>
                                                    </div>

                                                    <span class="fw-bold text-dark fs-5">₹{{ number_format($course->price, 0) }}</span>

                                                    <form action="{{ route('add.to.cart', $course->id) }}" method="POST" class="mt-2">
                                                        @csrf
                                                        <button type="submit" 
                                                                class="btn btn-primary btn-sm rounded-pill px-3 fw-bold shadow-none w-100 w-md-auto"
                                                                onclick="event.stopPropagation();">
                                                            Add to Cart
                                                        </button>
                                                    </form>
                                                </div>

                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

                @if($relatedCourses->count() > 2)
                <button class="carousel-control-prev" type="button" data-bs-target="#relatedCoursesCarouselMobile" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bg-dark rounded-circle p-2"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#relatedCoursesCarouselMobile" data-bs-slide="next">
                    <span class="carousel-control-next-icon bg-dark rounded-circle p-2"></span>
                </button>
                @endif
            </div>

        </div>
    </div>
</section>
@endif

        </div>
    </div>

    {{-- ================= STYLES ================= --}}
    <style>
        [x-cloak] { display: none !important; }

        /* Popular Topics Grid (5 Columns) */
        @media (min-width: 992px) { .col-lg-2-4 { flex: 0 0 auto; width: 20%; } }
        .topic-btn { background-color: #fff; border: 1px solid #d1d7dc; color: #1c1d1f; border-radius: 0; font-size: 1rem; transition: all 0.2s ease; height: 100%; display: flex; align-items: center; justify-content: center; }
        .topic-btn:hover { background-color: #f7f9fa; border-color: #1c1d1f; }
        .active-topic { border: 2px solid #1c1d1f; }

        /* Sticky Sidebar Accordion */
        .sticky-sidebar { position: -webkit-sticky; position: sticky; top: 100px; z-index: 10; max-height: calc(100vh - 120px); overflow-y: auto; padding-right: 5px; }
        .sticky-sidebar::-webkit-scrollbar { width: 4px; }
        .sticky-sidebar::-webkit-scrollbar-thumb { background: #eee; border-radius: 10px; }
        .accordion-button:not(.collapsed) { background-color: #f8f9fa; color: #0d6efd; box-shadow: none; }
        .accordion-button { font-size: 0.9rem; }

        /* Custom Form Check Styling */
        .form-check { padding-left: 0 !important; width: 100%; display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px; }
        .form-check-input { width: 1.15rem; height: 1.15rem; margin: 0 10px 0 0 !important; cursor: pointer; flex-shrink: 0; }
        .form-check-label { cursor: pointer; user-select: none; flex-grow: 1; line-height: 1.2; font-size: 0.85rem; }
        .tiny { font-size: 0.72rem; font-weight: 600; color: #6c757d; }

        /* Course Card Effects */
        .course-card { transition: all 0.3s ease; border: 1px solid rgba(0,0,0,0.05); }
        .card-hover-link:hover .course-card { transform: translateY(-5px); box-shadow: 0 12px 24px rgba(0,0,0,0.1) !important; }
        .text-truncate-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; height: 2.6rem; }
        
        /* Shimmer Loading Animation */
        .shimmer-wrapper { display: flex !important; }
        .shimmer-card { height: 100%; border: 1px solid #eee; }
        .shimmer-img { height: 160px; background: #f6f7f8; }
        .shimmer-line { height: 12px; background: #f6f7f8; border-radius: 6px; }
        .shimmer-img, .shimmer-line { background: linear-gradient(90deg, #f6f7f8 0%, #edeef1 20%, #f6f7f8 40%); background-size: 1000px 100%; animation: shimmer-anim 1.5s infinite linear; }
        @keyframes shimmer-anim { 0% { background-position: -1000px 0; } 100% { background-position: 1000px 0; } }
        [wire\:loading] { display: none !important; } 
        [wire\:loading].shimmer-wrapper { display: flex !important; }

        .related-course-card {
            height: 380px; /* fixed height for all cards */
            display: flex;
            flex-direction: column;
        }

        .related-course-card .card-body {
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .line-clamp-2 {
                display: -webkit-box;       /* required for WebKit */
                -webkit-box-orient: vertical;
                -webkit-line-clamp: 2;      /* number of lines to show */
                overflow: hidden;
                text-overflow: ellipsis;
            }

        .related-course-card .course-description {
            flex: 1; /* takes remaining space */
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 3; /* max 3 lines */
            -webkit-box-orient: vertical;
        }
    </style>
</div>