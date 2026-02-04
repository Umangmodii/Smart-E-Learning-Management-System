<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Smart E-Learning | {{ $title }} </title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('admin/css/style.css') }}?v={{ time() }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.bootstrap5.min.css">
    <link rel="icon" href="{{ asset('images/smartlms_logo.png') }}" type="image/svg+xml">
    
    @livewireStyles
    <style>
        .dropdown-toggle::after { display: none; }
        .dropdown-toggle i.bi-chevron-down { transition: transform 0.3s; }
        .dropdown-toggle[aria-expanded="true"] i.bi-chevron-down { transform: rotate(180deg); }
        .nav-label { letter-spacing: 1px; font-weight: 700; color: #6c757d !important; }
        .sidebar-overlay { display: none; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div id="sidebarOverlay" class="sidebar-overlay"></div>

        <nav id="sidebar" class="bg-dark text-white">
            <div class="sidebar-header px-3 py-4 border-bottom border-secondary">
                <a href="{{ url('admin/dashboard') }}" class="text-decoration-none d-flex align-items-center justify-content-center">
                    <i class="bi bi-mortarboard-fill text-white fs-3 me-2"></i>
                    <div class="text-start">
                        <h5 class="fw-bold text-white mb-0" style="letter-spacing: 1.5px;">SMART LMS</h5>
                    </div>
                </a>
            </div>

            <div class="px-3 mt-3 mb-2 sidebar-search">
                <div class="input-group border-secondary border rounded">
                    <span class="input-group-text bg-transparent border-0 text-secondary pe-0">
                        <i class="bi bi-search small"></i>
                    </span>
                    <input type="text" id="menuSearch" class="form-control bg-transparent border-0 text-white shadow-none py-2" 
                           placeholder="Search menu..." style="font-size: 0.85rem;">
                </div>
            </div>

            <ul class="list-unstyled components mt-2" id="sidebarMenu">
                <li>
                    <a href="{{ url('instructor/dashboard') }}" class="d-flex align-items-center {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2 me-2"></i> <span>Dashboard</span>
                    </a>
                </li>

                {{-- <li class="nav-label text-uppercase small px-3 mt-4 mb-2">User Hub</li>
                <li>
                    <a href="#instructorSubmenu" data-bs-toggle="collapse" 
                       aria-expanded="{{ request()->is('admin/instructors*') ? 'true' : 'false' }}" 
                       class="dropdown-toggle d-flex align-items-center justify-content-between {{ request()->is('admin/instructors*') ? 'active' : '' }}">
                        <div><i class="bi bi-person-badge-fill me-2"></i> <span>Instructor Hub</span></div>
                        <i class="bi bi-chevron-down small"></i>
                    </a>
                    <ul class="collapse list-unstyled ps-3" id="instructorSubmenu">
                        <li><a href=""><i class="bi bi-clock-history me-2"></i> Pending Approval</a></li>
                        <li><a href=""><i class="bi bi-check-circle-fill me-2"></i> Active List</a></li>
                    </ul>
                </li> --}}
                <li>
                    <a href="{{ url('admin/students') }}" class="d-flex align-items-center {{ request()->is('admin/students*') ? 'active' : '' }}">
                        <i class="bi bi-people-fill me-2"></i> <span>Enrolled Students</span>
                    </a>
                </li>

                <li class="nav-label text-uppercase small px-3 mt-4 mb-2">LMS Content</li>
                <li>
                    <a href="#courseSubmenu" data-bs-toggle="collapse" class="dropdown-toggle d-flex align-items-center justify-content-between">
                        <div><i class="bi bi-play-btn-fill me-2"></i> <span>Course Catalog</span></div>
                        <i class="bi bi-chevron-down small"></i>
                    </a>
                    <ul class="collapse list-unstyled ps-3" id="courseSubmenu">
                        <li><a href="{{ url('instructor/courses') }}" class="py-2"><i class="bi bi-list-ul me-2"></i> All Courses</a></li>
                        <li><a href="{{ url('instructor/courses/categories') }}" class="py-2"><i class="bi bi-tags-fill me-2"></i> Course Categories</a></li>
                        <li><a href="{{ url('admin/courses/reviews') }}" class="py-2"><i class="bi bi-star-fill me-2"></i> Quality Reviews</a></li>
                    </ul>
                </li>

                <li class="nav-label text-uppercase small px-3 mt-4 mb-2">Financials</li>
                <li>
                    <a href="{{ url('admin/revenue') }}" class="d-flex align-items-center">
                        <i class="bi bi-wallet2 me-2"></i> <span>Platform Revenue</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('admin/payouts') }}" class="d-flex align-items-center">
                        <i class="bi bi-cash-stack me-2"></i> <span>Instructor Payouts</span>
                    </a>
                </li>

                <li class="nav-label text-uppercase small px-3 mt-4 mb-2">System</li>
                <li>
                    <a href="{{ url('admin/settings') }}" class="d-flex align-items-center {{ request()->is('admin/settings*') ? 'active' : '' }}">
                        <i class="bi bi-sliders me-2"></i> <span>Global Settings</span>
                    </a>
                </li>
                <li id="noMenuResult" class="text-center py-4" style="display: none;">
                    <i class="bi bi-search text-muted d-block fs-4 mb-2"></i>
                    <small class="text-muted">No matches found</small>
                </li>
            </ul>
        </nav>

        <div id="content">
            <nav class="main-header d-flex justify-content-between align-items-center shadow-sm px-3 py-2 bg-white sticky-top">
                <button type="button" id="sidebarCollapse" class="btn btn-light border">
                    <i class="bi bi-list fs-5"></i>
                </button>
                
                <a href="/admin/dashboard" class="d-flex d-md-none align-items-center text-decoration-none">
                    <i class="bi bi-mortarboard-fill text-dark fs-4 me-2"></i>
                    <span class="fw-bold text-dark">SMART LMS</span>
                </a>

                <div class="dropdown">
                    <a href="#" class="text-decoration-none text-dark dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle fs-5 me-2 text-primary"></i> 
                        <span class="d-none d-md-inline fw-semibold">{{ auth()->user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                        <li><a class="dropdown-item py-2" href="{{ url('/instructor/profile') }}"><i class="bi bi-person me-2"></i> Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item text-danger py-2" href="javascript:void(0);" 
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right me-2"></i> Logout
                            </a>
                            <form id="logout-form" action="{{ url('/instructor/logout') }}" method="POST" class="d-none">@csrf</form>
                        </li>
                    </ul>
                </div>
            </nav>

    <main class="p-3 p-md-4">
        <div class="main-container">
            @if (isset($breadcrumbSlot))
                <div class="container mt-3">
                    {{ $breadcrumbSlot }}
                </div>
            @endif
        </div>
                {{ $slot }}
            </main>

            @include('layouts.admin.admin_footer')
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('admin/js/script.js') }}?v={{ time() }}"></script>
    
    @livewireScripts
</body>
</html>