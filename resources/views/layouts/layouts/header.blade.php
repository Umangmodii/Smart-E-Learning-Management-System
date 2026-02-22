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

    <!-- RIGHT : SEARCH -->
    <button class="btn border-0 shadow-none p-0 ms-auto"
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

                @guest
                    <li class="nav-item ms-lg-2">
                        <a href="{{ route('login') }}"
                           class="btn btn-primary btn-sm px-4 rounded-pill fw-bold">
                            Sign In
                        </a>
                    </li>
                @else
                    <li class="nav-item dropdown ms-lg-2">
                        <a class="nav-link dropdown-toggle p-0"
                           data-bs-toggle="dropdown">
                            <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}"
                                 class="rounded-circle"
                                 width="38"
                                 height="38">
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-4 p-2">
                            <li><a class="dropdown-item small" href="#">Dashboard</a></li>
                            <li><a class="dropdown-item small" href="#">My Courses</a></li>
                            <li><hr></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item text-danger small border-0 bg-transparent">
                                        Logout
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
                Teach Instructor
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