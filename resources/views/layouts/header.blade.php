<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top py-2">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center me-3" href="{{ url('/') }}">
            <img src="{{ asset('images/smartlms_logo.png') }}" alt="Smart LMS Logo" height="40" class="me-2">
            <span class="fw-bold text-primary">SmartLMS</span>
        </a>

        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">
            
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item dropdown dropdown-hover position-static" wire:ignore>
                    <a class="nav-link dropdown-toggle d-flex align-items-center fw-bold text-dark border rounded-2 px-3 py-2" 
                       href="javascript:void(0)" id="catDrop" data-bs-toggle="dropdown" style=" font-size: 0.9rem;">
                        <i class="bi bi-list me-2 fs-5"></i> Explore
                    </a>
                    
                    <ul class="dropdown-menu main-category-menu shadow-lg p-0 mt-lg-2">
                        @if(isset($categories) && count($categories) > 0)
                            @foreach($categories as $parent)
                                <li class="dropdown-submenu">
                                    <a class="dropdown-item d-flex justify-content-between align-items-center py-2 px-4 border-bottom border-light" 
                                       href="{{ url('categories/course/'.$parent->slug.'?id='.$parent->id) }}">
                                        <span>{{ $parent->name }}</span>
                                        @if($parent->children->count() > 0)
                                            <i class="bi bi-chevron-right ms-2 d-none d-lg-block" style="font-size: 10px;"></i>
                                            <i class="bi bi-chevron-down ms-2 d-lg-none" style="font-size: 10px;"></i>
                                        @endif
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
                        @else
                            <li><span class="dropdown-item text-muted py-2 small text-center">No categories found</span></li>
                        @endif
                    </ul>
                </li>
            </ul>

            {{-- <form class="d-flex flex-grow-1 mx-lg-4 my-2 my-lg-0" style="max-width: 700px;" role="search">
                <div class="input-group custom-search-group w-100">
                    <span class="input-group-text bg-light border-dark border-end-0 rounded-start-pill ps-3">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input class="form-control bg-light border-dark border-start-0 rounded-end-pill py-2 shadow-none" 
                           type="search" 
                           placeholder="Search for anything..." 
                           style="height: 46px; font-size: 0.95rem;">
                </div>
            </form> --}}

        @livewire('search')

            <ul class="navbar-nav align-items-center gap-2">
                <li class="nav-item">
                    <a class="nav-link small fw-medium {{ request()->routeIs('pricing') ? 'active fw-bold' : '' }}" href="">Plans & Pricing</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link small fw-semibold text-nowrap {{ request()->routeIs('instructor.started_teach') ? 'active text-primary' : '' }}" 
                       href="{{ route('instructor.started_teach') }}">Teach</a>
                </li>

                @guest
                    <li class="nav-item ms-lg-2">
                        <a href="{{ route('login') }}" class="btn btn-primary btn-sm px-4 rounded-pill fw-bold">Sign In</a>
                    </li>
                @else
                    <li class="nav-item dropdown ms-lg-2">
                        <a class="nav-link dropdown-toggle d-flex align-items-center p-0" href="#" data-bs-toggle="dropdown">
                            <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=0d6efd&color=fff" 
                                 class="rounded-circle border border-2 border-primary border-opacity-10" width="38" height="38">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-4 p-2 mt-2">
                            <li><a class="dropdown-item rounded-3 py-2 small" href="#">Dashboard</a></li>
                            <li><a class="dropdown-item rounded-3 py-2 small" href="#">My Courses</a></li>
                            <li><hr class="dropdown-divider opacity-50"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item text-danger py-2 rounded-3 small fw-bold border-0 bg-transparent w-100 text-start">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>

        </div>
    </div>
</nav>

<style>
/* 1. Desktop Hover & Fly-out Logic */
@media (min-width: 992px) {
    .dropdown-hover:hover > .dropdown-menu {
        display: block !important;
        margin-top: 0;
    }

    .dropdown-submenu {
        position: relative;
    }

    /* Main Menu (Left side) */
    .main-category-menu {
        min-width: 260px;
        border: 1px solid #dee2e6 !important;
        border-radius: 8px 0 0 8px !important;
        overflow: visible !important;
    }

    /* Sub Menu (Right Fly-out) */
    .dropdown-submenu > .sub-menu {
        position: absolute;
        top: -1px;
        left: 100%;
        display: none;
        min-width: 220px;
        height: calc(100% + 2px);
        background: white;
        border: 1px solid #dee2e6 !important;
        border-left: none !important;
        border-radius: 0 8px 8px 0 !important;
        box-shadow: 10px 5px 20px rgba(0,0,0,0.08);
        z-index: 1000;
    }

    .dropdown-submenu:hover > .sub-menu {
        display: block !important;
    }
}

/* 2. Mobile Responsive Logic */
@media (max-width: 991px) {
    .main-category-menu {
        border-radius: 8px !important;
        border: 1px solid #eee !important;
    }
    .dropdown-submenu .sub-menu {
        display: block !important;
        position: static !important;
        border: none !important;
        padding-left: 20px !important;
        background: #fbfbfb !important;
    }
}

/* 3. Search Bar Visuals */
.custom-search-group .form-control {
    border-color: #1c1d1f !important;
    background-color: #f7f9fa !important;
}
.custom-search-group .input-group-text {
    border-color: #1c1d1f !important;
    background-color: #f7f9fa !important;
}
.custom-search-group .form-control:focus {
    background-color: #fff !important;
}

/* 4. Compact Item Styling */
.main-category-menu .dropdown-item {
    padding: 8px 20px;
    font-size: 0.88rem;
}
.sub-menu .dropdown-item {
    font-size: 0.82rem;
    padding: 6px 15px;
}
.dropdown-item:hover {
    background-color: #f0f7ff;
    color: #0d6efd;
}

@media (min-width: 1400px) {
    form[role="search"] { max-width: 850px !important; }
}
</style>