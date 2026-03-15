<div>
    <x-slot name="breadcrumbSlot">
        <nav aria-label="breadcrumb" class="py-2 bg-light border-bottom mb-4">
            <div class="container">
                <ol class="breadcrumb mb-0 small">
                    @foreach($breadcrumbs as $item)
                        <li class="breadcrumb-item {{ $loop->last ? 'active fw-bold' : '' }}">
                            @if($item['url'] && !$loop->last)
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

<div>
    <x-slot name="breadcrumbSlot">
        <nav aria-label="breadcrumb" class="py-2 bg-light border-bottom mb-4">
            <div class="container">
                <ol class="breadcrumb mb-0 small">
                    @foreach($breadcrumbs as $item)
                        <li class="breadcrumb-item {{ $loop->last ? 'active fw-bold' : '' }}">
                            @if($item['url'] && !$loop->last)
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

    <div>

    {{-- HERO SECTION --}}
    <section class="bg-dark text-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">

                    <h1 class="fw-bold display-6">
                        {{ $course->title }}
                    </h1>

                    <p class="lead text-light">
                        {{ $course->short_description }}
                    </p>

                    <div class="d-flex flex-wrap align-items-center gap-3 small">

                        <span class="badge bg-warning text-dark">
                            {{ ucfirst($course->level ?? 'All Levels') }}
                        </span>

                        <span>
                            <i class="bi bi-globe"></i>
                            {{ $course->language ?? 'English' }}
                        </span>

                        {{-- <span>
                            <i class="bi bi-clock"></i>
                            {{ gmdate("H:i", $course->total_duration) }}
                        </span> --}}

                        @php
                            $totalMinutes = $course->sections->flatMap->lectures->sum('duration');

                            $hours = floor($totalMinutes / 60);
                            $minutes = $totalMinutes % 60;
                        @endphp

                        <span>
                            <i class="bi bi-clock"></i>
                            {{ $hours }}h {{ $minutes }}m total length
                        </span>

                        <span>
                            Instructor: 
                            <strong>{{ $course->instructor->name ?? 'Expert Instructor' }}</strong>
                        </span>

                    </div>
                </div>
            </div>
        </div>
    </section>


    {{-- MAIN CONTENT --}}
    <section class="py-5">
        <div class="container">
            <div class="row">

                {{-- LEFT CONTENT --}}
                <div class="col-lg-8">

                 {{-- Description --}}
                    <div class="card mb-4 shadow-sm border-0">
                        <div class="card-body">
                            <h4 class="fw-bold mb-3">Course Description</h4>
                            <hr>
                            @if($course->description)
                                {{-- Convert new lines to <br> --}}
                                {!! nl2br(e($course->description)) !!}
                            @else
                                <p class="text-muted">No description available.</p>
                            @endif
                        </div>
                    </div>

                    {{-- Meta Info --}}
                    <div class="card mb-4 shadow-sm border-0">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">Course Details</h5> <hr>

                            <div class="row g-3">

                             <div class="col-6 col-md-4">
                                    <div class="border rounded p-3 text-center">
                                        <div class="fw-bold">Level</div>
                                        <div>
                                            @php
                                                $level = $course->level ?? 'all_levels';
                                                $formattedLevel = ucwords(str_replace('_', ' ', strtolower($level)));
                                            @endphp
                                            {{ $formattedLevel }}
                                        </div>
                                    </div>
                             </div>

                                <div class="col-6 col-md-4">
                                    <div class="border rounded p-3 text-center">
                                        <div class="fw-bold">Language</div>
                                        <div>{{ $course->language }}</div>
                                    </div>
                                </div>

                                <div class="col-6 col-md-4">
                                    <div class="border rounded p-3 text-center">
                                        <div class="fw-bold">Duration</div>

                                          @php
                                                $totalMinutes = $course->sections->flatMap->lectures->sum('duration');

                                                $hours = floor($totalMinutes / 60);
                                                $minutes = $totalMinutes % 60;
                                            @endphp

                                            <span class="text-muted small">
                                                {{ $hours }}h {{ $minutes }}m total length
                                            </span>

                                        {{-- <div>{{ gmdate("H:i", $course->total_duration) }}</div> --}}
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    {{-- ================= COURSE CURRICULUM ================= --}}
                    <div class="card mb-4 shadow-sm border-0">
                        <div class="card-body">

                           <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="fw-bold mb-0">Course Curriculum</h4>

                                @php
                                    $totalMinutes = $course->sections->flatMap->lectures->sum('duration');

                                    $hours = floor($totalMinutes / 60);
                                    $minutes = $totalMinutes % 60;
                                @endphp

                                <span class="text-muted small">
                                    {{ $course->sections->count() }} Sections •
                                    {{ $course->sections->flatMap->lectures->count() }} Lectures 
                                    {{-- {{ $hours }}h {{ $minutes }}m total length --}}
                                </span>
                            </div>
                             <hr>
                            <div class="accordion" id="courseCurriculum">

                                @foreach($course->sections as $section)

                                    <div class="accordion-item mb-2 border-0 shadow-sm rounded">

                                        {{-- SECTION HEADER --}}
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed fw-semibold"
                                                    type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#section{{ $section->id }}"
                                                    aria-expanded="false">

                                                {{ $section->title }}
                                                    <span class="lecture-count-center small text-muted">
                                                    {{ $section->lectures->count() }}
                                                    {{ $section->lectures->count() == 1 ? 'Lecture' : 'Lectures' }}
                                                </span>
                                            </button>
                                        </h2>

                                        {{-- SECTION BODY --}}
                                        <div id="section{{ $section->id }}"
                                            class="accordion-collapse collapse"
                                            data-bs-parent="#courseCurriculum">

                                            <div class="accordion-body p-0">

                                                <ul class="list-group list-group-flush">

                                                    @foreach($section->lectures as $lecture)

                                                        <li class="list-group-item d-flex justify-content-between align-items-center">

                                                            <div class="d-flex align-items-center gap-2">

                                                                @if($lecture->is_preview)
                                                                    <i class="bi bi-play-circle text-success"></i>
                                                                @else
                                                                    <i class="bi bi-lock text-muted"></i>
                                                                @endif

                                                                <span>
                                                                    {{ $lecture->title }}

                                                                    @if($lecture->is_preview)
                                                                        <span class="badge bg-success ms-2">
                                                                            PREVIEW
                                                                        </span>
                                                                    @endif
                                                                </span>

                                                            </div>

                                                          @php
                                                                $duration = $lecture->duration ?? 0; // duration in seconds
                                                                $hours = floor($duration / 3600);
                                                                $minutes = floor(($duration % 3600) / 60);
                                                                $seconds = $duration % 60;

                                                                $displayDuration = '';
                                                                if ($hours > 0) {
                                                                    $displayDuration .= $hours . ' hr ';
                                                                }
                                                                if ($minutes > 0) {
                                                                    $displayDuration .= $minutes . ' min ';
                                                                }
                                                                if ($seconds > 0 && $hours == 0) { // only show seconds if less than 1 hour
                                                                    $displayDuration .= $seconds . ' min';
                                                                }
                                                            @endphp

                                                            <span class="small text-muted">
                                                                {{ $displayDuration ?: '0 min' }}
                                                            </span>

                                                        </li>

                                                    @endforeach

                                                </ul>

                                            </div>
                                        </div>

                                    </div>

                                @endforeach

                            </div>

                        </div>
                    </div>

                    <div class="mb-5">
                        <h4 class="fw-bold mb-3" style="color: #2d2f31;">Skills You’ll Gain</h4>

                        <div class="d-flex flex-wrap gap-2">
                            @php
                                $keywords = array_filter(array_map('trim', explode(',', $course->meta_keywords)));
                            @endphp

                            @foreach($keywords as $tag)
                                <span class="badge rounded-pill text-dark px-3 py-2" 
                                    title="Search courses related to {{ $tag }}" 
                                    style="background-color: #f1f1f1; border: 1px solid #6a6f73; font-size: 0.9rem;">
                                    {{ $tag }}
                                </span>
                            @endforeach
                        </div>
                    </div>

                    {{-- ================= FAQ SECTION ================= --}}
                 <div class="card mb-4 shadow-sm border-0">
                    <div class="card-body">

                        <h4 class="fw-bold mb-3">Frequently Asked Questions</h4>
                        <hr>

                        {{-- Success Message --}}
                        @if(session()->has('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        {{-- Student Ask Form --}}
                        <form wire:submit.prevent="submitQuestion" class="mb-4">
                            <div class="mb-3">
                                <label for="question" class="form-label">Ask a Question</label>
                                <textarea wire:model.defer="question" id="question" class="form-control" rows="3" placeholder="Type your question here..." required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm fw-bold">Submit Question</button>
                        </form>

                        {{-- Display FAQs --}}
                        @if($faqs->count() > 0)
                            <div class="accordion" id="courseFaq">
                                @foreach($faqs as $faq)
                                    <div class="accordion-item border-0 shadow-sm mb-2 rounded">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed fw-semibold"
                                                    type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#faq{{ $faq->id }}"
                                                    aria-expanded="false">
                                                {{ $faq->question }}
                                            </button>
                                        </h2>
                                        <div id="faq{{ $faq->id }}" class="accordion-collapse collapse" data-bs-parent="#courseFaq">
                                            <div class="accordion-body text-muted">
                                                {!! nl2br(e($faq->answer)) !!}
                                                <div class="mt-2 small text-muted">
                                                    Answered by Instructor
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="alert alert-light text-muted">
                                <i class="bi bi-info-circle me-1"></i> No answered questions yet. Be the first to ask!
                            </div>
                        @endif

                    </div>
                </div>

           <div>

                <div class="card mb-4 shadow-sm border-0 rounded-4">
                    <div class="card-body">
                        <h4 class="fw-bold mb-3">Reviews & Ratings</h4>
                        <hr>

                        @if(session()->has('review_success'))
                            <div class="alert alert-success border-0 shadow-sm">
                                <i class="bi bi-check-circle me-1"></i> {{ session('review_success') }}
                            </div>
                        @endif

                        <form wire:submit.prevent="submitReview" class="mb-5 bg-light p-3 rounded shadow-sm">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label small fw-bold">Your Rating</label>
                                    <div class="d-flex gap-2 align-items-center">
                                        @for($i = 1; $i <= 5; $i++)
                                            <span wire:click="$set('rating', {{ $i }})" style="cursor: pointer;">
                                                <i class="bi {{ $rating >= $i ? 'bi-star-fill text-warning' : 'bi-star text-muted opacity-50' }} fs-3"></i>
                                            </span>
                                        @endfor
                                        @if($rating)
                                            <span class="badge bg-white text-dark border ms-2">{{ $rating }}/5</span>
                                        @endif
                                    </div>
                                    @error('rating') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>
                                
                                <div class="col-12">
                                    <label class="form-label small fw-bold">Write Review</label>
                                    <textarea wire:model.defer="review" class="form-control border-0 shadow-sm" rows="3" placeholder="Share your experience..."></textarea>
                                    @error('review') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>
                                
                                <div class="col-12 text-end">
                                    <button type="submit" class="btn btn-primary btn-sm fw-bold">Submit Review</button>
                                </div>
                            </div>
                        </form>

                        <div class="list-group list-group-flush">
                            @forelse($reviews as $item)
                                <div class="list-group-item border-0 px-0 mb-3">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <span class="fw-bold text-dark">{{ $item->user->name ?? 'Student' }}</span>
                                        <span class="text-warning small">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="bi {{ $i <= $item->rating ? 'bi-star-fill' : 'bi-star' }}"></i>
                                            @endfor
                                        </span>
                                    </div>
                                    <div class="text-muted small mb-2">
                                        {{ $item->review }}
                                    </div>
                                    <div class="small text-muted opacity-75">
                                        <i class="bi bi-calendar3 me-1"></i>{{ $item->created_at->format('d-m-Y') }}
                                    </div>
                                </div>
                                @if(!$loop->last) <hr class="opacity-25"> @endif
                            @empty
                                <div class="text-muted py-3">No reviews yet.</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
                    <div class="card border-0 shadow-sm mb-4 rounded-4">
                        <div class="card-body p-4">
                            <div class="row align-items-center">
                                <div class="col-md-4 text-center border-end">
                                    <h2 class="fw-bold mb-0">{{ number_format($reviews->avg('rating'), 1) }}</h2>
                                    <div class="text-warning mb-1">
                                        @php $avg = $reviews->avg('rating'); @endphp
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="bi {{ $i <= $avg ? 'bi-star-fill' : ($i - 0.5 <= $avg ? 'bi-star-half' : 'bi-star') }}"></i>
                                        @endfor
                                    </div>
                                    <div class="text-muted small">{{ $reviews->count() }} reviews</div>
                                </div>
                                
                                <div class="col-md-8 px-md-5">
                                    @foreach(range(5, 1) as $star)
                                        @php 
                                            $count = $reviews->where('rating', $star)->count();
                                            $percent = $reviews->count() > 0 ? ($count / $reviews->count()) * 100 : 0;
                                        @endphp
                                        <div class="d-flex align-items-center mb-1">
                                            <span class="small me-2" style="min-width: 25px;">{{ $star }}★</span>
                                            <div class="progress flex-grow-1" style="height: 6px;">
                                                <div class="progress-bar bg-success" style="width: {{ $percent }}%"></div>
                                            </div>
                                            <span class="small ms-2 text-muted" style="min-width: 30px;">{{ $count }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="instructor-section mb-5 py-4 border-top">
                        <h4 class="fw-bold mb-4" style="color: #2d2f31;">Instructor</h4>

                        @php
                            $instructor = $this->course->instructor;
                            $details = $instructor?->details; 
                        @endphp

                        @if($instructor)
                            <div class="row g-4">
                                <div class="col-md-auto text-center text-md-start">
                                    <div class="mb-3">
                                        <img src="{{ $details?->avatar ? asset('storage/' . $details->avatar) : 'https://ui-avatars.com/api/?name='.urlencode($instructor->name).'&background=5624d0&color=fff' }}" 
                                            class="rounded-circle border shadow-sm" 
                                            style="width: 120px; height: 120px; object-fit: cover;"
                                            alt="{{ $instructor->name }}">
                                    </div>

                                    <div class="d-flex justify-content-center justify-content-md-start gap-2 mb-3">
                                        @if($details?->linkedin_url)
                                            <a href="{{ $details->linkedin_url }}" target="_blank" class="btn btn-sm btn-outline-secondary rounded-circle"><i class="bi bi-linkedin"></i></a>
                                        @endif
                                        @if($details?->youtube_url)
                                            <a href="{{ $details->youtube_url }}" target="_blank" class="btn btn-sm btn-outline-secondary rounded-circle"><i class="bi bi-youtube"></i></a>
                                        @endif
                                    </div>
                                </div>

                                {{-- Instructor Info --}}
                                <div class="col-md">
                                    <h5 class="fw-bold mb-1">
                                        <a href="{{ $details?->website ?? '#' }}" class="text-decoration-none" style="color: #5624d0; border-bottom: 1px solid #5624d0;">
                                            {{ $instructor->name }}
                                        </a>
                                    </h5>
                                    <p class="text-muted fw-medium small mb-3">{{ $details?->headline ?? 'Professional Instructor' }}</p>

                                    {{-- Stats Bar --}}
                                    <div class="d-flex flex-wrap gap-3 mb-3 small fw-bold text-dark">
                                        <span><i class="bi bi-star-fill text-warning me-1"></i> 4.6 Instructor Rating</span>
                                        <span><i class="bi bi-people-fill me-1"></i> {{ number_format($instructor->students_count ?? 0) }} Students</span>
                                        <span><i class="bi bi-play-circle-fill me-1"></i> {{ number_format($instructor->courses_count ?? 0) }} Courses</span>
                                    </div>

                                    {{-- Dynamic Biography --}}
                                    <div class="instructor-bio text-dark" style="line-height: 1.6; font-size: 0.95rem;">
                                        @if($details?->bio)
                                            {!! $details->bio !!}
                                        @else
                                            <div class="alert alert-light border-0 p-0 text-muted italic">
                                                <i class="bi bi-info-circle me-1"></i> No biography provided yet.
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

            <style>
                .accordion-button {
                    position: relative;
                }

                .lecture-count-center {
                    position: absolute;
                    left: 50%;
                    transform: translateX(-50%);
                }
            </style>
            

                {{-- RIGHT SIDEBAR (Sticky Purchase Card) --}}
                <div class="col-lg-4">
                    <div class="card shadow border-0 position-sticky" style="top: 90px;">

                        {{-- Thumbnail --}}
                        {{-- <img src="{{ $course->thumbnail ? asset('storage/'.$course->thumbnail) : 'https://placehold.co/600x350' }}"
                             class="card-img-top"> --}}

                            @php
                            $firstLectureVideo = $course->sections
                                                        ->flatMap->lectures
                                                        ->first()?->video_path ?? null;

                            $videoId = null;
                            if ($firstLectureVideo) {
                                if (str_contains($firstLectureVideo, 'youtu.be/')) {
                                    $videoId = last(explode('/', parse_url($firstLectureVideo, PHP_URL_PATH)));
                                } elseif (str_contains($firstLectureVideo, 'youtube.com/watch')) {
                                    parse_str(parse_url($firstLectureVideo, PHP_URL_QUERY), $query);
                                    $videoId = $query['v'] ?? null;
                                }
                            }
                        @endphp

                        @if($videoId)
                            <div class="ratio ratio-16x9">
                                <iframe src="https://www.youtube.com/embed/{{ $videoId }}"
                                        title="Course Preview"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen>
                                </iframe>
                            </div>
                        @else
                            <img src="{{ $course->thumbnail ? asset('storage/'.$course->thumbnail) : 'https://placehold.co/600x350' }}"
                                class="card-img-top">
                        @endif

                        <div class="card-body">

                            {{-- Pricing --}}
                          <div class="mb-3">
                                    @php
                                        $price = $course->price;
                                        $discount = $course->discount_price;
                                        $discountPercent = 0;

                                        if($price > 0 && $discount > 0) {
                                            $discountPercent = round((($price - $discount) / $price) * 100);
                                        }
                                    @endphp

                                    @if($discount > 0 && $price > 0)
                                        <h3 class="fw-bold">
                                            ₹{{ number_format($discount,0) }}
                                            <span class="text-muted fs-6 text-decoration-line-through ms-2">
                                                ₹{{ number_format($price,0) }}
                                            </span>
                                           <span class="badge bg-success ms-2" 
                                                    style="font-size: 0.75rem; padding: 0.25rem 0.4rem; border-radius: 0.25rem;">
                                                    {{ $discountPercent }}% OFF
                                            </span>
                                        </h3>
                                    @elseif($price > 0)
                                        <h3 class="fw-bold">
                                            ₹{{ number_format($price,0) }}
                                        </h3>
                                    @else
                                        <h3 class="fw-bold text-success">FREE</h3>
                                    @endif
                                </div>

                            {{-- Enroll Button --}}
                                <form action="{{ route('add.to.cart', $course->id) }}" method="POST" class="mt-2">
                                        @csrf
                                        <button type="submit" 
                                                class="btn btn-primary w-100 fw-bold active text-white">
                                            Add to Cart
                                        </button>
                                </form>

                            {{-- <button class="btn btn-outline-secondary w-100">
                                Add to Wishlist
                            </button> --}}

                            <hr>

                            {{-- Course Includes --}}
                       <div class="mb-5">
                                <h4 class="fw-bold mb-4" style="color: #2d2f31;">This course includes:</h4>

                                <div class="row g-3">
                                    <div class="col-12 col-md-6">
                                        <div class="d-flex align-items-center border rounded p-3 h-100">
                                            <i class="bi bi-camera-video fs-4 me-3 text-primary"></i>
                                            <div>
                                                 @php
                                                        $totalMinutes = $course->sections->flatMap->lectures->sum('duration');

                                                        $hours = floor($totalMinutes / 60);
                                                        $minutes = $totalMinutes % 60;
                                                    @endphp

                                                    <span class="text-muted small">
                                                       • {{ $course->sections->count() }} Sections <br>
                                                       • {{ $course->sections->flatMap->lectures->count() }} Lectures  <br>
                                                       • {{ $hours }}h {{ $minutes }}m total length
                                                    </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <div class="d-flex align-items-center border rounded p-3 h-100">
                                            <i class="bi bi-file-text fs-4 me-3 text-primary"></i>
                                            <div>
                                                <strong>16</strong> articles
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <div class="d-flex align-items-center border rounded p-3 h-100">
                                            <i class="bi bi-file-earmark-arrow-down fs-4 me-3 text-primary"></i>
                                            <div>
                                                <strong>67</strong> downloadable resources
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <div class="d-flex align-items-center border rounded p-3 h-100">
                                            <i class="bi bi-phone fs-4 me-3 text-primary"></i>
                                            <div>
                                                Access on <strong>mobile & TV</strong>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <div class="d-flex align-items-center border rounded p-3 h-100">
                                            <i class="bi bi-cc fs-4 me-3 text-primary"></i>
                                            <div>
                                                Closed captions
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <div class="d-flex align-items-center border rounded p-3 h-100">
                                            <i class="bi bi-award fs-4 me-3 text-primary"></i>
                                            <div>
                                                Certificate of completion
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

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

                                                    {{-- <form action="{{ route('add.to.cart', $course->id) }}" method="POST" class="mt-2">
                                                        @csrf   
                                                        <button type="submit" 
                                                                class="btn btn-primary btn-sm rounded-pill px-3 fw-bold shadow-none w-100 w-md-auto"
                                                                onclick="event.stopPropagation();">
                                                            Add to Cart
                                                        </button> --}}
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
                                                        <h6 class="fw-bold mb-2 line-clamp-2 text-truncate-2">{{ $course->title }}</h6>

                                                    <p class="text-muted small mb-2 course-description">
                                                        {{ $course->short_description ?? 'Learn the essentials of ' . $course->title . ' and advance your skills with professional training.' }}
                                                    </p>

                                                    <p class="extra-small text-muted mb-1">By {{ $course->instructor->name ?? 'Expert' }}</p>

                                                  <div class="extra-small text-warning mb-2">
                                                        <i class="bi bi-star-fill"></i> 
                                                        {{ number_format($reviews->avg('rating'), 1) }}
                                                        
                                                        <span class="text-muted small">({{ number_format($reviews->count()) }} reviews)</span>
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

<style>

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