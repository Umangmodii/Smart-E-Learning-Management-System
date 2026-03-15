<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
    <div class="container">

        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            <img src="{{ asset('images/smartlms_logo.png') }}" alt="Smart LMS Logo" height="40" class="me-2">
            <span class="fw-bold text-primary d-none d-sm-inline">Smart E-Learning</span>
        </a>

        <!-- Explore Menu -->
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

        <!-- Mobile Toggle -->
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Content -->
        <div class="collapse navbar-collapse" id="mainNavbar">

            <!-- Search -->
            <div class="mx-3 flex-grow-1">
                @livewire('search')
            </div>

        </div>

    </div>
</nav>