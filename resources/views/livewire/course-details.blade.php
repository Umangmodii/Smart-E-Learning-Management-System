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

    <div class="container py-4">
        {{-- Category Header --}}
        <div class="mb-4 mb-md-5">
            <h2 class="fw-bold text-dark display-6 fs-2 fs-md-1">{{ $category->name }} Courses</h2>
            <p class="text-muted lead fs-6">Explore our top-rated professional courses in {{ $category->name }}.</p>
        </div>

        {{-- Shimmer Container --}}
        <div id="shimmer-container">
            <div class="row g-2 g-md-4">
                @for ($i = 0; $i < 8; $i++)
                <div class="col-6 col-md-6 col-lg-3">
                    <div class="shimmer-card border-0 shadow-sm rounded-3 overflow-hidden">
                        <div class="shimmer-img animate-shimmer"></div>
                        <div class="p-3">
                            <div class="shimmer-line animate-shimmer w-100 mb-2"></div>
                            <div class="shimmer-line animate-shimmer w-50 mb-3"></div>
                            <div class="d-flex justify-content-between mt-4">
                                <div class="shimmer-line animate-shimmer w-25"></div>
                                <div class="shimmer-line animate-shimmer w-25"></div>
                            </div>
                        </div>
                    </div>
                </div>
                @endfor
            </div>
        </div>

        {{-- Real Content --}}
        <div id="real-content" style="display: none;">
            <div class="row g-2 g-md-4">
                @forelse($courses as $course)
                    <div class="col-6 col-md-6 col-lg-3">
                        <a href="{{ route('course-details', ['category_slug' => $category->slug, 'course_slug' => $course->slug]) }}" 
                           class="card h-100 border-0 shadow-sm text-decoration-none transition-hover rounded-3 overflow-hidden course-card">
                            
                            <div class="card-img-wrapper position-relative">
                                <img src="{{ $course->thumbnail ? asset('storage/' . $course->thumbnail) : 'https://placehold.co/400x225' }}" 
                                     class="card-img-top" alt="{{ $course->title }}">
                                
                                {{-- Level Badge --}}
                                <div class="position-absolute bottom-0 start-0 m-2">
                                    <span class="badge bg-white text-dark shadow-sm extra-small text-uppercase">
                                        <i class="bi bi-bar-chart-fill me-1 text-primary"></i>{{ str_replace('_', ' ', $course->level) }}
                                    </span>
                                </div>
                            </div>
                            
                            <div class="card-body p-2 p-md-3 d-flex flex-column">
                                <h6 class="fw-bold text-dark mb-1 text-truncate-2 course-title">{{ $course->title }}</h6>
                                <p class="extra-small text-muted mb-2 text-truncate">By {{ $course->instructor->name ?? 'Expert Instructor' }}</p>
                                
                                {{-- Ratings --}}
                                <div class="d-flex align-items-center mb-2">
                                    <span class="text-warning extra-small me-1">
                                        <i class="bi bi-star-fill"></i> 4.8
                                    </span>
                                    <span class="text-muted extra-small d-none d-md-inline">(2.4k)</span>
                                </div>

                                {{-- Metadata: Duration & Language --}}
                                <div class="d-flex gap-2 text-muted extra-small mb-3">
                                    <span><i class="bi bi-clock me-1"></i>{{ gmdate("H:i", $course->total_duration) }}</span>
                                    <span class="d-none d-md-inline">|</span>
                                    <span><i class="bi bi-globe me-1"></i>{{ $course->language }}</span>
                                </div>
                                
                                {{-- Pricing --}}
                                <div class="mt-auto pt-2 border-top">
                                    @if($course->discount_price > 0)
                                        <span class="fw-bold text-dark fs-6 fs-md-5">₹{{ number_format($course->discount_price, 0) }}</span>
                                        <span class="text-muted text-decoration-line-through extra-small ms-1">₹{{ number_format($course->price, 0) }}</span>
                                    @elseif($course->price > 0)
                                        <span class="fw-bold text-dark fs-6 fs-md-5">₹{{ number_format($course->price, 0) }}</span>
                                    @else
                                        <span class="fw-bold text-success fs-6 fs-md-5">FREE</span>
                                    @endif
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <i class="bi bi-search display-1 text-light mb-3"></i>
                        <h4 class="text-muted">No courses found in this category yet.</h4>
                        <a href="{{ url('/') }}" class="btn btn-primary mt-3 rounded-pill">Explore Other Categories</a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <style>
        .course-card { background: #fff; transition: transform 0.3s ease, box-shadow 0.3s ease; }
        .course-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.08) !important; }

        .card-img-wrapper { position: relative; width: 100%; padding-top: 56.25%; overflow: hidden; }
        .card-img-top { position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; }

        .shimmer-card { background: #fff; height: 100%; border: 1px solid #eee; }
        .shimmer-img { height: 120px; background: #f0f0f0; }
        @media (min-width: 768px) { .shimmer-img { height: 160px; } }
        
        .shimmer-line { height: 10px; background: #f0f0f0; border-radius: 4px; }
        .animate-shimmer {
            background: linear-gradient(90deg, #f6f7f8 0%, #edeef1 20%, #f6f7f8 40%, #f6f7f8 100%);
            background-size: 1000px 100%;
            animation: shimmer-animation 1.5s infinite linear;
        }

        @keyframes shimmer-animation {
            0% { background-position: -1000px 0; }
            100% { background-position: 1000px 0; }
        }

        /* --- UI POLISH --- */
        .extra-small { font-size: 0.7rem; font-weight: 600; }
        .course-title { font-size: 0.85rem; line-height: 1.3; height: 2.3rem; overflow: hidden; }
        @media (min-width: 768px) {
            .course-title { font-size: 1rem; height: 2.6rem; }
        }

        .text-truncate-2 { 
            display: -webkit-box; 
            -webkit-line-clamp: 2; 
            -webkit-box-orient: vertical; 
            overflow: hidden; 
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            setTimeout(function() {
                const shimmer = document.getElementById('shimmer-container');
                const content = document.getElementById('real-content');
                if(shimmer) shimmer.style.display = 'none';
                if(content) {
                    content.style.display = 'block';
                    content.classList.add('animate__animated', 'animate__fadeIn');
                }
            }, 3000); // 3 seconds delay
        });
    </script>
</div>