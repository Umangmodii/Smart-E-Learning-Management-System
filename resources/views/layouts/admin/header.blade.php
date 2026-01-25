<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
    <div class="container">

        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            <img src="{{ asset('images/smartlms_logo.png') }}" alt="Smart LMS Logo" height="40" class="me-2">
            <span class="fw-bold text-primary d-none d-sm-inline">Smart E-Learning</span>
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">
            
            <form class="d-none d-lg-flex flex-grow-1 mx-4" role="search">
                <div class="input-group w-100">
                    <span class="input-group-text bg-light border-0 rounded-start-pill ps-3">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input class="form-control bg-light border-0 rounded-end-pill py-2" 
                           type="search" 
                           placeholder="Search courses, mentors, or topics..." 
                           aria-label="Search">
                </div>
            </form>

            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
                <li class="nav-item"><a class="nav-link px-3 fw-medium" href="#">Categories</a></li>
                <li class="nav-item"><a class="nav-link px-3 fw-medium" href="#">Courses</a></li>
            </ul>
        </div>
    </div>
</nav>