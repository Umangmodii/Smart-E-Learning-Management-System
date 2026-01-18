<!-- Header -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm ">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center">
            <img src="{{ asset('images/smartlms_logo.png') }}" alt="Smart LMS Logo" height="50" class="me-2">
            <span class="fw-bold text-heading-md font-headline text-primary" href="#">Smart E-Learning</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
            aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-between" id="navbarContent">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link">Courses</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link">Contact</a>
                </li>
            </ul>

            <div class="d-flex">
                @guest
                    <a href="{{ route('login') }}" class="btn btn-primary me-2">Sign In</a>
                @else
                    <div class="dropdown">
                        <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="userMenu" data-bs-toggle="dropdown" aria-expanded="false">
                           Welcome, {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
                            <li><a class="dropdown-item" href="{{ url('/') }}">Dashboard</a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endguest
            </div>
        </div>
    </div>
</nav>
