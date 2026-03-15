<div class="container py-4">
    {{-- Breadcrumbs --}}
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

    <h1 class="fw-bold mb-4">Shopping Cart</h1>

    <div class="row">
        {{-- Left Column: Cart Items --}}
        <div class="col-lg-8">
            <p class="fw-bold mb-1">{{ count($cart) }} Courses in Cart</p>
            <hr class="mt-0 mb-4">

            @if(count($cart) > 0)
                @foreach($cart as $id => $item)
                    <div class="row g-0 py-3 border-bottom align-items-start">
                        <div class="col-3 col-md-2">
                            <img src="{{ $item['image'] ? asset('storage/' . $item['image']) : 'https://placehold.co/400x225' }}" 
                                 class="img-fluid rounded" alt="{{ $item['title'] }}">
                        </div>

                        <div class="col-6 col-md-7 px-3">
                            <h5 class="fw-bold mb-1" style="font-size: 1rem; line-height: 1.2;">{{ $item['title'] }}</h5>
                            <p class="text-muted small mb-1">By {{ $item['instructor_name'] ?? 'Expert Instructor' }}</p>
                            
                            <div class="d-flex align-items-center flex-wrap gap-2 mb-1">
                                <span class="badge bg-warning text-dark fw-bold small" style="background-color: #eceb98 !important;">Bestseller</span>
                                <span class="fw-bold text-warning small">{{ $item['avg_rating'] }}</span>
                                <div class="text-warning small" style="font-size: 0.7rem;">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-half"></i>
                                </div>
                                <span class="text-muted small">({{ $item['review_count'] }} ratings)</span>
                            </div>

                            <p class="text-muted extra-small mb-2">{{ $item['total_duration'] }} total hours • {{ $item['lecture_count'] }} lectures • All Levels</p>

                            <div class="d-flex gap-3">
                                <button wire:click="removeFromCart({{ $id }})" class="btn btn-link text-primary p-0 text-decoration-none small fw-bold">Remove</button>
                                <button class="btn btn-link text-primary p-0 text-decoration-none small fw-bold">Save for Later</button>
                                <button class="btn btn-link text-primary p-0 text-decoration-none small fw-bold">Move to Wishlist</button>
                            </div>
                        </div>

                        <div class="col-3 col-md-3 text-end">
                            <h5 class="text-primary fw-bold mb-0">₹{{ number_format($item['price'], 0) }}</h5>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="text-center py-5">
                    <img src="https://s.udemycdn.com/browse_components/flyout/empty-shopping-cart-v2.jpg" width="240" class="mb-4">
                    <p class="text-muted">Your cart is empty. Keep shopping to find a course!</p>
                    <a href="{{ url('/') }}" class="btn btn-primary fw-bold px-4 py-2">Keep Shopping</a>
                </div>
            @endif
        </div>

        {{-- Right Column: Total --}}
        @if(count($cart) > 0)
        <div class="col-lg-4">
            <div class="ps-lg-4">
                <h5 class="text-muted fw-bold small mb-1">Total:</h5>
                <h1 class="fw-bold mb-3">₹{{ number_format($totalPrice, 0) }}</h1>
                <button class="btn btn-primary btn-lg w-100 fw-bold py-3 mb-2 rounded-0 border-0">Proceed to Checkout</button>
                <p class="text-muted extra-small text-center mb-4">You won't be charged yet</p>
                <hr>
                <div class="mt-4">
                    <p class="fw-bold small mb-2">Promotions</p>
                    <div class="input-group mb-2">
                        <input type="text" class="form-control rounded-0 border-dark shadow-none" placeholder="Enter Coupon">
                        <button class="btn btn-dark fw-bold px-3 rounded-0" type="button">Apply</button>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>

    {{-- YOU MIGHT ALSO LIKE SECTION --}}
    <div class="mt-5 pt-5">
        <h3 class="fw-bold mb-4">You might also like</h3>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-4">
            @foreach($recommendedCourses as $course)
                <div class="col">
                    <a href="{{ route('course-details', ['course_slug' => $course->slug]) }}" class="text-decoration-none text-dark">
                        <div class="card h-100 border-0 shadow-sm course-hover">
                            <img src="{{ $course->thumbnail ? asset('storage/' . $course->thumbnail) : 'https://placehold.co/400x225' }}" 
                                 class="card-img-top rounded-0" alt="{{ $course->title }}">
                            <div class="card-body p-2">
                                <h6 class="fw-bold mb-1 line-clamp-2" style="font-size: 0.9rem; min-height: 2.4rem;">{{ $course->title }}</h6>
                                <p class="text-muted extra-small mb-1">{{ $course->instructor->name ?? 'Expert' }}</p>
                                <div class="d-flex align-items-center gap-1 mb-1">
                                    <span class="text-warning fw-bold extra-small"> {{ $item['avg_rating'] }}  </span>
                                    <div class="text-warning extra-small" style="font-size: 0.6rem;">
                                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-half"></i>
                                    </div>
                                    <span class="text-muted extra-small">({{ $item['review_count'] }})</span>
                                </div>
                                <h6 class="fw-bold mb-2">₹{{ number_format($course->discount_price > 0 ? $course->discount_price : $course->price, 0) }}</h6>
                                <div class="d-flex gap-1">
                                    <span class="badge bg-primary extra-small px-2 py-1 rounded-0">Premium</span>
                                    <span class="badge bg-light text-dark border extra-small px-2 py-1 rounded-0">Bestseller</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>

<style>
    .extra-small { font-size: 0.75rem; }
    .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
    .btn-link:hover { text-decoration: underline !important; }
    .text-primary { color: blue !important; }
    .btn-primary { background-color: blue !important; }
    .course-hover { transition: transform 0.2s; }
    .course-hover:hover { transform: translateY(-5px); }
</style>