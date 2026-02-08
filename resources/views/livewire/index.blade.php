<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Smart E-Learning | {{ $title ?? 'E-Learning' }} </title>
    <link rel="icon" href="{{ asset('images/smartlms_logo.png') }}" type="image/svg+xml">
    <link rel="icon" href="{{ asset('images/smartlms_logo.png') }}" sizes="32x32">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="{{ asset('admin/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> 
    
    <style>
        :root {
            --primary-color: #0d6efd;
            --text-dark: #2d2f31;
            --border-color: #d1d7dc;
        }

        /* --- SHIMMER ANIMATION --- */
        .shimmer-card { background: #fff; border-radius: 0.5rem; overflow: hidden; height: 100%; border: 1px solid #eee; }
        .shimmer-img { height: 160px; background: #f0f0f0; }
        .shimmer-text { height: 14px; background: #f0f0f0; margin: 12px; border-radius: 4px; }
        
        .animate-shimmer {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: shimmer-swipe 1.5s infinite linear;
        }
        @keyframes shimmer-swipe { 0% { background-position: -200% 0; } 100% { background-position: 200% 0; } }

        /* --- COURSE CARDS --- */
        #real-course-content { display: none; }
        .course-card-link { text-decoration: none; color: inherit; display: block; height: 100%; }
        
        .course-card { 
            border: 1px solid var(--border-color); 
            border-radius: 0.5rem; 
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1); 
            height: 100%; 
            overflow: hidden;
            background: #fff;
        }

        .course-card:hover { 
            box-shadow: 0 4px 12px rgba(0,0,0,0.15); 
            transform: translateY(-4px);
        }

        .card-img-container { position: relative; width: 100%; padding-top: 56.25%; overflow: hidden; }
        .card-img-top { 
            position: absolute; top: 0; left: 0; width: 100%; height: 100%; 
            object-fit: cover; transition: transform 0.5s ease;
        }
        .course-card:hover .card-img-top { transform: scale(1.05); }

        .course-title {
            font-size: 0.95rem;
            font-weight: 700;
            line-height: 1.2;
            color: var(--text-dark);
            height: 2.3rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            margin-bottom: 0.5rem;
        }

        /* --- SLIDER ARROWS --- */
        .course-slider-wrapper { position: relative; padding: 0 10px; }
        .course-control { 
            width: 44px; height: 44px; 
            background: #fff; 
            color: #000;
            border: 1px solid var(--border-color);
            border-radius: 50%; 
            top: 40%; 
            transform: translateY(-50%); 
            opacity: 0; 
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
            z-index: 10;
            display: flex; align-items: center; justify-content: center;
        }
        .course-slider-wrapper:hover .course-control { opacity: 1; }
        .course-control:hover { background: var(--text-dark); color: #fff; border-color: var(--text-dark); }
        
        .carousel-control-prev { left: -15px; }
        .carousel-control-next { right: -15px; }

        @media (max-width: 768px) {
            .course-control { display: none; }
            .col-6-mobile { width: 50% !important; flex: 0 0 auto; }
            .mobile-scroll { display: flex; flex-wrap: nowrap; overflow-x: auto; -webkit-overflow-scrolling: touch; }
            .no-scrollbar::-webkit-scrollbar { display: none; }
        }
    </style>
</head>
<body>

@include('layouts.header')

<div class="main-wrapper">
    {{-- Banner Section --}}
    @if($banners->count() > 0)
    <section id="hero-slider" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach($banners as $index => $banner)
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}" data-bs-interval="5000">
                    <div class="banner-bg" style="background-image: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.2)), url('{{ asset('Storage/' . $banner->image) }}'); height: 450px; background-size: cover; background-position: center;">
                        <div class="container h-100 d-flex align-items-center">
                            <div class="text-white col-md-7">
                                <h1 class="display-4 fw-bold animate__animated animate__fadeInDown">{{ $banner->title }}</h1>
                                <p class="lead fs-4 animate__animated animate__fadeInUp">{{ $banner->subtitle }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    @endif

    <section class="py-5 bg-white">
    <div class="container">
        {{-- Professional Header --}}
        <div class="d-flex justify-content-between align-items-end mb-4 px-2">
            <div class="text-start">
                <h2 class="fw-bold mb-1" style="color: #2d2f31; font-size: 1.75rem;">Skills to transform your career and life</h2>
                <p class="text-muted mb-0 d-none d-md-block">From critical skills to technical topics, SmartLMS supports your professional development.</p>
            </div>
            <div class="text-end">
                <a href="#" class="btn btn-link text-primary fw-bold text-decoration-none p-0">See All <i class="bi bi-arrow-right"></i></a>
            </div>
        </div>

        <div class="course-slider-wrapper">
            {{-- Shimmer Loader --}}
            <div id="shimmer-loader">
                <div class="row g-3 flex-nowrap overflow-hidden px-2">
                    @for ($i = 0; $i < 4; $i++)
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="shimmer-card shadow-sm border-0">
                            <div class="shimmer-img animate-shimmer"></div>
                            <div class="p-3">
                                <div class="shimmer-text animate-shimmer w-100 mb-2"></div>
                                <div class="shimmer-text animate-shimmer w-50 mb-3"></div>
                                <div class="d-flex justify-content-between mt-4">
                                    <div class="shimmer-text animate-shimmer w-25"></div>
                                    <div class="shimmer-text animate-shimmer w-25"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endfor
                </div>
            </div>

            {{-- Real Content --}}
            <div id="real-course-content" class="carousel slide" data-bs-ride="false" style="display: none;">
                <div class="carousel-inner">
                    @foreach($courses->chunk(4) as $chunkIndex => $chunk)
                    <div class="carousel-item {{ $chunkIndex == 0 ? 'active' : '' }}">
                        <div class="row g-3 px-2 mobile-scroll no-scrollbar">
                            @foreach($chunk as $course)
                            <div class="col-6 col-md-4 col-lg-3 col-6-mobile">
                                <a href="{{ route('course-details', ['category_slug' => $course->category->slug, 'course_slug' => $course->slug]) }}" class="course-card-link text-decoration-none">
                                    <div class="card h-100 course-card border-0 shadow-sm">
                                        {{-- Image Container --}}
                                        <div class="card-img-container position-relative">
                                            <img src="{{ $course->thumbnail ? asset('storage/' . $course->thumbnail) : 'https://placehold.co/400x225' }}" class="card-img-top" alt="{{ $course->title }}">
                                            <div class="position-absolute top-0 start-0 m-2">
                                                <span class="badge bg-dark bg-opacity-75 text-white fw-medium extra-small">{{ $course->category->name }}</span>
                                            </div>
                                            @if($course->level)
                                            <div class="position-absolute bottom-0 start-0 m-2">
                                                <span class="badge bg-white text-dark shadow-sm extra-small text-uppercase">
                                                    <i class="bi bi-bar-chart-fill me-1 text-primary"></i>{{ str_replace('_', ' ', $course->level) }}
                                                </span>
                                            </div>
                                            @endif
                                        </div>

                                        <div class="card-body p-3">
                                            {{-- Title --}}
                                            <h6 class="course-title fw-bold text-dark mb-1 line-clamp-2" style="height: 2.8rem; overflow: hidden;">{{ $course->title }}</h6>
                                            
                                            {{-- Instructor --}}
                                            <p class="small text-muted mb-1 text-truncate">{{ $course->instructor->name ?? 'Expert Instructor' }}</p>

                                            {{-- Rating (Mockup) --}}
                                            <div class="d-flex align-items-center mb-2">
                                                <span class="fw-bold me-1 text-warning small">4.8</span>
                                                <div class="text-warning extra-small d-flex gap-1">
                                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-half"></i>
                                                </div>
                                                <span class="text-muted ms-1 extra-small">(2.4k)</span>
                                            </div>

                                            {{-- Metadata: Duration & Language --}}
                                            <div class="d-flex gap-3 text-muted extra-small mb-3">
                                                <span><i class="bi bi-clock me-1"></i>{{ gmdate("H:i", $course->total_duration) }}</span>
                                                <span><i class="bi bi-globe me-1"></i>{{ $course->language ?? 'English' }}</span>
                                            </div>

                                            {{-- Pricing --}}
                                            <div class="d-flex justify-content-between align-items-center mt-auto border-top pt-2">
                                                <div>
                                                    @if($course->discount_price > 0)
                                                        <span class="fw-bold text-dark fs-5">₹{{ number_format($course->discount_price, 0) }}</span>
                                                        <span class="text-muted text-decoration-line-through extra-small ms-1">₹{{ number_format($course->price, 0) }}</span>
                                                    @elseif($course->price > 0)
                                                        <span class="fw-bold text-dark fs-5">₹{{ number_format($course->price, 0) }}</span>
                                                    @else
                                                        <span class="fw-bold text-success fs-5">FREE</span>
                                                    @endif
                                                </div>
                                                <div class="btn btn-primary btn-sm rounded-pill px-3 fw-bold shadow-none extra-small">Enroll</div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
                
                @if($courses->count() > 4)
                <button class="carousel-control-prev course-control" type="button" data-bs-target="#real-course-content" data-bs-slide="prev">
                    <i class="bi bi-chevron-left"></i>
                </button>
                <button class="carousel-control-next course-control" type="button" data-bs-target="#real-course-content" data-bs-slide="next">
                    <i class="bi bi-chevron-right"></i>
                </button>
                @endif
            </div>
        </div>
    </div>
</section>

<style>
    /* Typography & Core */
    .extra-small { font-size: 0.7rem; font-weight: 600; }
    .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
    
    /* Card Styles */
    .course-card { transition: transform 0.3s ease, box-shadow 0.3s ease; border-radius: 12px; height: 100%; }
    .course-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.08) !important; }
    .card-img-top { border-radius: 12px 12px 0 0; aspect-ratio: 16/9; object-fit: cover; }
    
    /* Shimmer Effect */
    .shimmer-card { border-radius: 12px; background: #fff; height: 320px; }
    .shimmer-img { height: 160px; background: #f0f0f0; border-radius: 12px 12px 0 0; }
    .shimmer-text { height: 12px; background: #f0f0f0; margin-bottom: 10px; border-radius: 4px; }
    .animate-shimmer {
        background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
        background-size: 200% 100%;
        animation: shimmer 1.5s infinite;
    }
    @keyframes shimmer { 0% { background-position: -200% 0; } 100% { background-position: 200% 0; } }

    /* Controls */
    .course-control { width: 40px; height: 40px; background: #fff; border-radius: 50%; top: 50%; transform: translateY(-50%); opacity: 1; box-shadow: 0 2px 10px rgba(0,0,0,0.1); color: #000; border: 1px solid #eee; }
    .course-control:hover { background: #000; color: #fff; }
    .carousel-control-prev { left: -20px; }
    .carousel-control-next { right: -20px; }

    /* Mobile Handling */
    @media (max-width: 768px) {
        .col-6-mobile { min-width: 240px; }
        .mobile-scroll { display: flex; flex-wrap: nowrap; overflow-x: auto; -webkit-overflow-scrolling: touch; }
        .course-control { display: none; }
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Updated to 6000ms as requested
        setTimeout(function() {
            const loader = document.getElementById('shimmer-loader');
            const content = document.getElementById('real-course-content');
            if(loader) loader.style.display = 'none';
            if(content) {
                content.style.display = 'block';
                content.classList.add('animate__animated', 'animate__fadeIn');
            }
        }, 6000); 
    });
</script>

@include('layouts.footer')

</body>
</html>