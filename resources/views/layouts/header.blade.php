<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top py-2">
    <div class="container">

<!-- ================= MOBILE HEADER ================= -->
<div class="position-relative d-flex align-items-center w-100 d-lg-none py-2">

    <!-- LEFT : MENU -->
    <button class="btn border-0 shadow-none p-0"
            data-bs-toggle="offcanvas"
            data-bs-target="#mobileMenu">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- CENTER : LOGO + TEXT -->
    <a class="navbar-brand d-flex align-items-center fw-bold text-primary m-0 
              position-absolute start-50 translate-middle-x"
       href="{{ url('/') }}">

        <img src="{{ asset('images/smartlms_logo.png') }}"
             height="30"
             class="me-2">

        <span style="font-size:18px;">SmartLMS</span>
    </a>

    <!-- RIGHT : CART + SEARCH -->
    <div class="ms-auto d-flex align-items-center gap-2" style="z-index: 1060;">

        <!-- Search Button -->
        <button class="btn border-0 shadow-none p-0"
                data-bs-toggle="modal"
                data-bs-target="#mobileSearch">
            <svg xmlns="http://www.w3.org/2000/svg"
                 width="22"
                 height="22"
                 fill="currentColor"
                 viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 
                         1.398h-.001l3.85 
                         3.85a1 1 0 0 0 1.415-1.414l-3.867-3.834zM12 
                         6.5a5.5 5.5 0 1 1-11 0 
                         5.5 5.5 0 0 1 11 0z"/>
            </svg>
        </button>

         <li class="nav-item dropdown" 
                    onmouseover="bootstrap.Dropdown.getOrCreateInstance(this.querySelector('[data-bs-toggle]')).show()" 
                    onmouseout="bootstrap.Dropdown.getOrCreateInstance(this.querySelector('[data-bs-toggle]')).hide()">
                    
                    <a class="nav-link position-relative px-2 d-flex align-items-center" 
                    href="#" 
                    id="cartDropdown" 
                    role="button" 
                    data-bs-toggle="dropdown" 
                    aria-expanded="false">
                        
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-cart3" viewBox="0 0 16 16">
                            <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l.84 4.479 9.144-.459L13.89 4zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                        </svg>

                       @if(count(session('cart', [])) > 0)
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem; margin-top: 5px;">
                                {{ count(session('cart', [])) }}
                            </span>
                        @endif
                    </a>

                   <div class="dropdown-menu dropdown-menu-end p-3 shadow border-0 rounded-4"
                    style="width: 300px; max-height: 500px; overflow-y: auto;">

                    @php 
                        $cart = session('cart', []);
                        $totalPrice = 0;
                    @endphp

                    @if(count($cart) > 0)

                        <p class="fw-bold h5 mb-2">Items in Cart</p>
                        <hr>

                    @foreach($cart as $item)
                        @php $totalPrice += $item['price']; @endphp

                        <div class="d-flex align-items-start mb-3">

                            {{-- Course Thumbnail --}}
                            <a href="{{ route('course-details', ['course_slug' => $item['slug']]) }}" class="me-2">
                                <img src="{{ $item['image'] ? asset('storage/'.$item['image']) : 'https://placehold.co/50' }}"
                                    width="50"
                                    class="rounded">
                            </a>

                                {{-- Title & Price --}}
                                <div class="flex-grow-1">
                                    <a href="{{ route('course-details', ['course_slug' => $item['slug']]) }}" class="text-decoration-none text-dark">
                                        <h6 class="mb-1 fw-bold" style="
                                            line-height: 1.2rem;
                                            display: -webkit-box;
                                            -webkit-line-clamp: 2;
                                            -webkit-box-orient: vertical;
                                            overflow: hidden;
                                            font-size: 0.9rem;">
                                            {{ $item['title'] }}
                                        </h6>
                                    </a>
                                    <small class="text-muted">₹{{ number_format($item['price'], 0) }}</small>
                                </div>

                                {{-- Remove Button --}}
                                <a href="{{ route('remove.cart', $item['id']) }}" 
                                class="text-primary ms-2 btn p-0"
                                style="font-size: 1.2rem; line-height: 1;">
                                    <i class="bi bi-x-circle"></i>
                                </a>
                            </div>
                        @endforeach

                            <hr>

                            {{-- Total & Count --}}
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <strong>Total ({{ count($cart) }} items):</strong>
                                <strong>₹{{ number_format($totalPrice, 0) }}</strong>
                            </div>

                            <a href="{{ url('/cart') }}" class="btn btn-dark btn-sm w-100 rounded-pill">
                                View Cart
                            </a>

                        @else
                            <div class="text-center py-2">
                                <p class="fw-bold mb-1">Your cart is empty</p>
                                <p class="small text-muted mb-0">Add some courses to get started!</p>
                            </div>
                        @endif
                    </div>
                </li>

    </div>
</div>
        <!-- ================= DESKTOP NAVBAR ================= -->
        <div class="collapse navbar-collapse d-none d-lg-flex" id="mainNavbar">

            <!-- Logo -->
            <a class="navbar-brand d-flex align-items-center me-3" href="{{ url('/') }}">
                <img src="{{ asset('images/smartlms_logo.png') }}" height="40" class="me-2">
                <span class="fw-bold text-primary">SmartLMS</span>
            </a>

            <!-- Explore -->
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item dropdown dropdown-hover position-static" wire:ignore>

                    <a class="nav-link dropdown-toggle d-flex align-items-center fw-bold text-dark border rounded-2 px-3 py-2"
                       href="javascript:void(0)" data-bs-toggle="dropdown">
                        Explore
                    </a>

                    <ul class="dropdown-menu main-category-menu shadow-lg p-0 mt-lg-2">

                        @foreach($categories as $parent)
                            <li class="dropdown-submenu">

                                <a class="dropdown-item d-flex justify-content-between align-items-center py-2 px-4 border-bottom border-light"
                                   href="{{ url('categories/course/'.$parent->slug.'?id='.$parent->id) }}">
                                    <span>{{ $parent->name }}</span>
                                </a>

                                @if($parent->children->count() > 0)
                                    <ul class="dropdown-menu sub-menu p-2 m-0 shadow-lg">
                                        @foreach($parent->children as $child)
                                            <li>
                                                <a class="dropdown-item rounded-2 py-1 px-3"
                                                   href="{{ url('categories/course/'.$parent->slug.'/'.$child->slug.'?id='.$child->id) }}">
                                                    {{ $child->name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif

                            </li>
                        @endforeach

                    </ul>
                </li>
            </ul>

            <!-- Search -->
            <div class="mx-4 flex-grow-1">
                @livewire('search')
            </div>

            <!-- Right Side -->
            <ul class="navbar-nav align-items-center gap-2">

                <li class="nav-item">
                    <a class="nav-link small fw-medium">Plans & Pricing</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link small fw-semibold"
                       href="{{ route('instructor.started_teach') }}">
                        Teach
                    </a>
                </li>

              <li class="nav-item dropdown" 
                    onmouseover="bootstrap.Dropdown.getOrCreateInstance(this.querySelector('[data-bs-toggle]')).show()" 
                    onmouseout="bootstrap.Dropdown.getOrCreateInstance(this.querySelector('[data-bs-toggle]')).hide()">
                    
                    <a class="nav-link position-relative px-2 d-flex align-items-center" 
                    href="#" 
                    id="cartDropdown" 
                    role="button" 
                    data-bs-toggle="dropdown" 
                    aria-expanded="false">
                        
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-cart3" viewBox="0 0 16 16">
                            <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l.84 4.479 9.144-.459L13.89 4zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                        </svg>

                       @if(count(session('cart', [])) > 0)
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem; margin-top: 5px;">
                                {{ count(session('cart', [])) }}
                            </span>
                        @endif
                    </a>

                   <div class="dropdown-menu dropdown-menu-end p-3 shadow border-0 rounded-4"
                    style="width: 360px; max-height: 450px; overflow-y: auto;">

                    @php 
                        $cart = session('cart', []);
                        $totalPrice = 0;
                    @endphp

                    @if(count($cart) > 0)

                        <p class="fw-bold h5 mb-2">Items in Cart</p>
                        <hr>

                    @foreach($cart as $item)
                        @php $totalPrice += $item['price']; @endphp

                        <div class="d-flex align-items-start mb-3">

                            <a href="{{ route('course-details', ['course_slug' => $item['slug']]) }}" class="me-2">
                                <img src="{{ $item['image'] ? asset('storage/'.$item['image']) : 'https://placehold.co/50' }}"
                                    width="50"
                                    class="rounded">
                            </a>

                                <div class="flex-grow-1">
                                    <a href="{{ route('course-details', ['course_slug' => $item['slug']]) }}" class="text-decoration-none text-dark">
                                        <h6 class="mb-1 fw-bold" style="
                                            line-height: 1.2rem;
                                            display: -webkit-box;
                                            -webkit-line-clamp: 2;
                                            -webkit-box-orient: vertical;
                                            overflow: hidden;
                                            font-size: 0.9rem;">
                                            {{ $item['title'] }}
                                        </h6>
                                    </a>
                                    <small class="fw-bold text-primary">₹{{ number_format($item['price'], 0) }}</small>
                                </div>

                                <a href="{{ route('remove.cart', $item['id']) }}" 
                                class="text-primary ms-2 btn p-0"
                                style="font-size: 1.2rem; line-height: 1;">
                                    <i class="bi bi-x-circle"></i>
                                </a>
                            </div>
                        @endforeach

                            <hr>

                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <strong>Total ({{ count($cart) }} items):</strong>
                                <strong>₹{{ number_format($totalPrice, 0) }}</strong>
                            </div>

                            <a href="{{ url('/cart') }}" class="btn btn-primary btn-sm w-100 rounded-pill">
                                View Cart
                            </a>

                        @else
                            <div class="text-center py-2">
                                <p class="fw-bold mb-1">Your cart is empty</p>
                                <p class="small text-muted mb-0">Add some courses to get started!</p>
                            </div>
                        @endif
                    </div>
                </li>

                @guest
                    <li class="nav-item ms-lg-2">
                        <a href="{{ route('login') }}"
                           class="btn btn-primary btn-sm px-4 rounded-pill fw-bold">
                            Sign In
                        </a>
                    </li>
                @else
                    <li class="nav-item dropdown ms-lg-3">
                        <a class="nav-link dropdown-toggle p-0" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}" class="rounded-circle" width="38" height="38"> </a>

                        <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-3 py-2" style="min-width: 200px;">
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="{{ route('dashboard') }}">
                                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <i class="bi bi-journal-bookmark me-2"></i> My Courses
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item d-flex align-items-center text-danger border-0 bg-transparent">
                                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest

            </ul>

        </div>
        <!-- ================= END DESKTOP NAVBAR ================= -->

    </div>
</nav>

<div class="offcanvas offcanvas-start" tabindex="-1" id="mobileMenu">

    <div class="offcanvas-header border-bottom">
        <h6 class="fw-bold">Explore</h6>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>

    <div class="offcanvas-body p-0">

        <div class="accordion" id="mobileAccordion">

            @foreach($categories as $parent)
                <div class="accordion-item border-0">

                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed shadow-none"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#cat{{ $parent->id }}">
                            {{ $parent->name }}
                        </button>
                    </h2>

                    <div id="cat{{ $parent->id }}"
                         class="accordion-collapse collapse"
                         data-bs-parent="#mobileAccordion">

                        <div class="accordion-body pt-0">

                            @foreach($parent->children as $child)
                                <a href="{{ url('categories/course/'.$parent->slug.'/'.$child->slug.'?id='.$child->id) }}"
                                   class="d-block py-2 text-dark text-decoration-none small">
                                    {{ $child->name }}
                                </a>
                            @endforeach

                        </div>

                    </div>

                </div>
            @endforeach

    </div>

     <div class="offcanvas-header border-bottom">
        <h6 class="fw-bold mb-0">More from SmartLMS</h6>
    </div>
    
    <div class="px-3 pb-4">
            <a href="#" class="d-block py-2 text-dark text-decoration-none">
                Plans & Pricing
            </a>

            <a href="{{ route('instructor.started_teach') }}"
               class="d-block py-2 text-dark text-decoration-none">
                Teach
            </a>

            @guest
                <a href="{{ route('login') }}"
                   class="btn btn-primary w-100 rounded-pill mt-3">
                    Sign In
                </a>
            @endguest
    </div>

    </div>
</div>

<!-- ================= MOBILE SEARCH MODAL ================= -->
<div class="modal fade d-lg-none" id="mobileSearch" tabindex="-1">

    <div class="modal-dialog modal-fullscreen-sm-down m-0">

        <div class="modal-content border-0 rounded-0">

            <div class="d-flex align-items-center p-3 border-bottom">

                <div class="flex-grow-1 me-3">
                    @livewire('search')
                </div>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close">
                </button>

            </div>

            <div class="modal-body">
            </div>

        </div>
    </div>
</div>

<style>

@media (min-width: 992px) {
    .dropdown-hover:hover > .dropdown-menu {
        display: block !important;
    }

    .dropdown-submenu {
        position: relative;
    }

    .dropdown-submenu > .sub-menu {
        position: absolute;
        top: 0;
        left: 100%;
        display: none;
    }

    .dropdown-submenu:hover > .sub-menu {
        display: block !important;
    }
}

</style>