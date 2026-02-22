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

                        <span>
                            <i class="bi bi-clock"></i>
                            {{ gmdate("H:i", $course->total_duration) }}
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
                            {!! $course->description !!}
                        </div>
                    </div>

                    {{-- Meta Info --}}
                    <div class="card mb-4 shadow-sm border-0">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">Course Details</h5>

                            <div class="row g-3">

                                <div class="col-6 col-md-4">
                                    <div class="border rounded p-3 text-center">
                                        <div class="fw-bold">Level</div>
                                        <div>{{ ucfirst($course->level) }}</div>
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
                                        <div>{{ gmdate("H:i", $course->total_duration) }}</div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>


                {{-- RIGHT SIDEBAR (Sticky Purchase Card) --}}
                <div class="col-lg-4">
                    <div class="card shadow border-0 position-sticky" style="top: 90px;">

                        {{-- Thumbnail --}}
                        <img src="{{ $course->thumbnail ? asset('storage/'.$course->thumbnail) : 'https://placehold.co/600x350' }}"
                             class="card-img-top">

                        <div class="card-body">

                            {{-- Pricing --}}
                            <div class="mb-3">

                                @if($course->discount_price > 0)
                                    <h3 class="fw-bold">
                                        ₹{{ number_format($course->discount_price,0) }}
                                        <span class="text-muted fs-6 text-decoration-line-through ms-2">
                                            ₹{{ number_format($course->price,0) }}
                                        </span>
                                    </h3>
                                @elseif($course->price > 0)
                                    <h3 class="fw-bold">
                                        ₹{{ number_format($course->price,0) }}
                                    </h3>
                                @else
                                    <h3 class="fw-bold text-success">FREE</h3>
                                @endif

                            </div>

                            {{-- Enroll Button --}}
                            <button class="btn btn-primary w-100 fw-bold mb-2">
                                Enroll Now
                            </button>

                            <button class="btn btn-outline-secondary w-100">
                                Add to Wishlist
                            </button>

                            <hr>

                            {{-- Course Includes --}}
                            <ul class="list-unstyled small">
                                <li><i class="bi bi-camera-video"></i> Full lifetime access</li>
                                <li><i class="bi bi-phone"></i> Access on mobile & TV</li>
                                <li><i class="bi bi-award"></i> Certificate of completion</li>
                            </ul>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    </div>
  </div> 
</div>