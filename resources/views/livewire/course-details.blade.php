<div>
    <x-slot name="breadcrumbSlot">
        <nav aria-label="breadcrumb" class="py-2 bg-light border-bottom mb-4">
            <div class="container">
                <ol class="breadcrumb mb-0 small">
                    @foreach($breadcrumbs as $item)
                        <li class="breadcrumb-item {{ $loop->last ? 'active fw-bold' : '' }}">
                            @if($item['url'] && !$loop->last)
                                <a href="{{ $item['url'] }}" class="text-decoration-none">{{ $item['label'] }}</a>
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
            <p class="text-muted lead fs-6">Explore our top-rated courses in {{ $category->name }}.</p>
        </div>

        <div id="shimmer-container">
            <div class="row g-2 g-md-4">
                @for ($i = 0; $i < 8; $i++)
                <div class="col-6 col-md-6 col-lg-3">
                    <div class="shimmer-card border-0 shadow-sm rounded-3 overflow-hidden">
                        <div class="shimmer-img animate-shimmer"></div>
                        <div class="p-2 p-md-3">
                            <div class="shimmer-line animate-shimmer w-75 mb-2"></div>
                            <div class="shimmer-line animate-shimmer w-50 mb-3"></div>
                            <div class="d-flex justify-content-between">
                                <div class="shimmer-line animate-shimmer w-25"></div>
                                <div class="shimmer-line animate-shimmer w-25"></div>
                            </div>
                        </div>
                    </div>
                </div>
                @endfor
            </div>
        </div>

        <div id="real-content" style="display: none;">
            <div class="row g-2 g-md-4">
                @forelse($courses as $course)
                    <div class="col-6 col-md-6 col-lg-3">
                        <a href="{{ route('course-details', ['category_slug' => $category->slug, 'course_slug' => $course->slug]) }}" 
                           class="card h-100 border-0 shadow-sm text-decoration-none transition-hover rounded-3 overflow-hidden">
                            
                            <div class="card-img-wrapper">
                                <img src="{{ $course->thumbnail ? asset('storage/' . $course->thumbnail) : 'https://placehold.co/400x225' }}" 
                                     class="card-img-top" alt="{{ $course->title }}">
                            </div>
                            
                            <div class="card-body p-2 p-md-3">
                                <h6 class="fw-bold text-dark mb-1 text-truncate-2 course-title">{{ $course->title }}</h6>
                                <p class="small text-muted mb-1 mb-md-2 text-truncate">By {{ $course->instructor->name ?? 'Expert' }}</p>
                                
                                <div class="text-warning extra-small mb-1 mb-md-2">
                                    <i class="bi bi-star-fill"></i>
                                    <span class="fw-bold">4.5</span>
                                    <span class="text-muted d-none d-md-inline ms-1">(1.2k)</span>
                                </div>
                                
                                <div class="fw-bold text-dark fs-6 fs-md-5">FREE</div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <h4 class="text-muted">No courses found in this category yet.</h4>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <style>
        /* Industry Standard Card Height Fix */
        .card-img-wrapper {
            position: relative;
            width: 100%;
            padding-top: 56.25%; /* 16:9 Aspect Ratio */
            overflow: hidden;
        }
        .card-img-top {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* --- SHIMMER CSS --- */
        .shimmer-card { background: #fff; height: 100%; border: 1px solid #eee; }
        .shimmer-img { height: 120px; background: #f0f0f0; }
        @media (min-width: 768px) { .shimmer-img { height: 160px; } }
        
        .shimmer-line { height: 10px; background: #f0f0f0; border-radius: 4px; }
        
        .animate-shimmer {
            background: linear-gradient(90deg, #f6f7f8 0%, #edeef1 20%, #f6f7f8 40%, #f6f7f8 100%);
            background-size: 1000px 100%;
            animation: shimmer-animation 2s infinite linear;
        }

        @keyframes shimmer-animation {
            0% { background-position: -1000px 0; }
            100% { background-position: 1000px 0; }
        }

        /* --- UI POLISH --- */
        .extra-small { font-size: 0.75rem; }
        .course-title { font-size: 0.85rem; line-height: 1.2; height: 2rem; }
        @media (min-width: 768px) {
            .course-title { font-size: 1rem; height: 2.5rem; }
        }

        .transition-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1) !important;
            transition: 0.3s;
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
                document.getElementById('shimmer-container').style.display = 'none';
                document.getElementById('real-content').style.display = 'block';
            }, 3000);
        });
    </script>
</div>