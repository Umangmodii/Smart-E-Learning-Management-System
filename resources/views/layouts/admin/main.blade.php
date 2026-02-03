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
</head>
<body>
    <div class="wrapper">
        <div id="sidebarOverlay" class="sidebar-overlay"></div>

        <nav id="sidebar">
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
                    <a href="{{ url('admin/dashboard') }}" class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2 me-2"></i> <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('admin/users') }}" class="{{ request()->is('admin/users') ? 'active' : '' }}">
                        <i class="bi bi-people me-2"></i> <span>Users</span>
                    </a>
                </li>
                
                <li>
                    <a href="#instructorSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle d-flex align-items-center {{ request()->is('admin/instructors*') ? 'active' : '' }}">
                        <i class="bi bi-person-badge me-2"></i> 
                        <span>Instructors</span>
                    </a>
                    <ul class="collapse list-unstyled ps-3 {{ request()->is('admin/instructors*') ? 'show' : '' }}" id="instructorSubmenu">
                        <li>
                         <a href="{{ url('admin/instructors/pending') }}" 
                            class="py-2 {{ request()->is('admin/instructors/pending') ? 'text-primary fw-bold' : '' }}">
                                <i class="bi bi-person-plus me-2"></i> 
                                <span>Pending Requests</span>
                                <span class="badge bg-danger rounded-pill float-end mt-1">
                                    {{ \App\Models\Instructor::where('status', 0)->count() }}
                                </span>
                          </a>
                        </li>
                        <li>
                            <a href="{{ url('admin/instructors/active') }}" class="py-2 {{ request()->is('admin/instructors/active') ? 'text-primary fw-bold' : '' }}">
                                <i class="bi bi-check-circle me-2"></i> 
                                 <span>Active Requests</span>
                                <span class="badge bg-primary rounded-pill float-end mt-1">
                                    {{ \App\Models\Instructor::where('status', 1)->count() }}
                                </span>
                            </a>
                        </li>
                    </ul>
                </li>
                
                <li>
                    <a href="{{ url('admin/categories') }}" class="{{ request()->is('admin/categories*') ? 'active' : '' }}">
                        <i class="bi bi-grid-3x3-gap me-2"></i> <span>Categories</span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('admin/courses') }}" class="{{ request()->is('admin/courses*') ? 'active' : '' }}">
                        <i class="bi bi-book me-2"></i> <span>Courses</span>
                    </a>
                </li>

             <li class="nav-item">
                    <a class="nav-link d-flex justify-content-between align-items-center {{ request()->is('admin/settings*') ? 'active' : 'collapsed' }}" 
                    data-bs-toggle="collapse" 
                    href="#settingsDropdown" 
                    role="button" 
                    aria-expanded="{{ request()->is('admin/settings*') ? 'true' : 'false' }}">
                        <div>
                            <i class="bi bi-gear me-2"></i>
                            <span>Settings</span>
                        </div>
                        <i class="bi bi-chevron-down small"></i>
                    </a>

                    <div class="collapse {{ request()->is('admin/settings*') ? 'show' : '' }}" id="settingsDropdown">
                        <ul class="nav flex-column ps-4 pt-1">
                            <li class="nav-item">
                                <a href="{{ url('admin/banner') }}" 
                                class="nav-link py-2 {{ request()->is('admin/banner')}}">
                                    <i class="bi bi-image me-2"></i>
                                    <span>Banners</span>
                                </a>
                            </li>
                            
                            {{-- <li class="nav-item">
                                <a href="{{ url('admin/settings/general') }}" 
                                class="nav-link py-2 {{ request()->is('admin/settings/general') ? 'text-primary fw-bold' : 'text-muted' }}">
                                    <i class="bi bi-sliders me-2"></i>
                                    <span>General</span>
                                </a>
                            </li> --}}
                        </ul>
                    </div>
                </li>
            </ul>
        </nav>

        <div id="content">
            <nav class="main-header d-flex justify-content-between align-items-center shadow-sm px-3 py-2 bg-white">
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
                        <li><a class="dropdown-item py-2" href="{{ url('/admin/profile') }}"><i class="bi bi-person me-2"></i> Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item text-danger py-2" href="javascript:void(0);" 
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right me-2"></i> Logout
                            </a>
                            <form id="logout-form" action="{{ url('/admin/logout') }}" method="POST" class="d-none">@csrf</form>
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