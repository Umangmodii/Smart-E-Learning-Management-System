<div class="instructor-dashboard-wrapper">
    <div class="container-fluid py-3">
        
        {{-- 1. Breadcrumb Section --}}
        <div class="row mb-4">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-white px-3 py-2 rounded-3 shadow-sm border-0">
                        @foreach($breadcrumbs as $item)
                            <li class="breadcrumb-item {{ $loop->last ? 'active fw-bold text-dark' : '' }}">
                                @if($item['url'] && !$loop->last)
                                    <a href="{{ $item['url'] }}" class="text-decoration-none text-primary">
                                        {{ $item['label'] }}
                                    </a>
                                @else
                                    {{ $item['label'] }}
                                @endif
                            </li>
                        @endforeach
                    </ol>
                </nav>
            </div>
        </div>

        {{-- 2. Professional Stats Row --}}
        <div class="row g-3"> 
            {{-- Net Earnings --}}
            <div class="col-6 col-lg-4 col-xl-2">
                <div class="card bg-success text-white border-0 shadow-sm h-100 stats-card">
                    <div class="card-body p-3 text-center">
                        <i class="bi bi-currency-dollar mb-1 d-block fs-3 opacity-75"></i>
                        <h4 class="fw-bold mb-0">${{ number_format($netEarnings ?? 1250) }}</h4>
                        <p class="mb-0 x-small fw-medium opacity-75">Net Earnings</p>
                    </div>
                    <a href="#" class="card-footer bg-dark bg-opacity-10 text-white text-center text-decoration-none x-small p-1 footer-link">
                        Statements <i class="bi bi-chevron-right ms-1"></i>
                    </a>
                </div>
            </div>

            {{-- Total Students --}}
            <div class="col-6 col-lg-4 col-xl-2">
                <div class="card bg-primary text-white border-0 shadow-sm h-100 stats-card">
                    <div class="card-body p-3 text-center">
                        <i class="bi bi-people mb-1 d-block fs-3 opacity-75"></i>
                        <h4 class="fw-bold mb-0">{{ $totalStudents ?? 342 }}</h4>
                        <p class="mb-0 x-small fw-medium opacity-75">Total Students</p>
                    </div>
                    <a href="#" class="card-footer bg-dark bg-opacity-10 text-white text-center text-decoration-none x-small p-1 footer-link">
                        View List <i class="bi bi-chevron-right ms-1"></i>
                    </a>
                </div>
            </div>

            {{-- Live Courses --}}
            <div class="col-6 col-lg-4 col-xl-2">
                <div class="card bg-info text-white border-0 shadow-sm h-100 stats-card">
                    <div class="card-body p-3 text-center">
                        <i class="bi bi-play-circle mb-1 d-block fs-3 opacity-75"></i>
                        <h4 class="fw-bold mb-0">{{ $activeCourses ?? 8 }}</h4>
                        <p class="mb-0 x-small fw-medium opacity-75">Live Courses</p>
                    </div>
                    <a href="{{ url('instructor/courses') }}" class="card-footer bg-dark bg-opacity-10 text-white text-center text-decoration-none x-small p-1 footer-link">
                        Inventory <i class="bi bi-chevron-right ms-1"></i>
                    </a>
                </div>
            </div>

            {{-- In Review --}}
            <div class="col-6 col-lg-4 col-xl-2">
                <div class="card bg-warning text-dark border-0 shadow-sm h-100 stats-card">
                    <div class="card-body p-3 text-center">
                        <i class="bi bi-clock-history mb-1 d-block fs-3 opacity-75"></i>
                        <h4 class="fw-bold mb-0">{{ $pendingCourses ?? 2 }}</h4>
                        <p class="mb-0 x-small fw-medium opacity-75">In Review</p>
                    </div>
                    <a href="#" class="card-footer bg-dark bg-opacity-10 text-dark text-center text-decoration-none x-small p-1 footer-link">
                        Status <i class="bi bi-chevron-right ms-1"></i>
                    </a>
                </div>
            </div>

            {{-- Avg Rating --}}
            <div class="col-6 col-lg-4 col-xl-2">
                <div class="card text-white border-0 shadow-sm h-100 stats-card" style="background-color: #6610f2;">
                    <div class="card-body p-3 text-center">
                        <i class="bi bi-star-fill text-warning mb-1 d-block fs-3"></i>
                        <h4 class="fw-bold mb-0">4.9</h4>
                        <p class="mb-0 x-small fw-medium opacity-75">Avg Rating</p>
                    </div>
                    <a href="#" class="card-footer bg-dark bg-opacity-10 text-white text-center text-decoration-none x-small p-1 footer-link">
                        Reviews <i class="bi bi-chevron-right ms-1"></i>
                    </a>
                </div>
            </div>

            {{-- Visitors --}}
            <div class="col-6 col-lg-4 col-xl-2">
                <div class="card bg-danger text-white border-0 shadow-sm h-100 stats-card">
                    <div class="card-body p-3 text-center">
                        <i class="bi bi-eye mb-1 d-block fs-3 opacity-75"></i>
                        <h4 class="fw-bold mb-0">1.8k</h4>
                        <p class="mb-0 x-small fw-medium opacity-75">Visitors</p>
                    </div>
                    <a href="#" class="card-footer bg-dark bg-opacity-10 text-white text-center text-decoration-none x-small p-1 footer-link">
                        Analytics <i class="bi bi-chevron-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>

        {{-- 3. Analytics and Activity Row --}}
        <div class="row mt-4 g-4">
            {{-- Performance Chart --}}
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-header bg-white border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold text-dark mb-0">Enrollment Performance</h5>
                        <select class="form-select form-select-sm w-auto">
                            <option>Last 7 Days</option>
                            <option>Last 30 Days</option>
                        </select>
                    </div>
                    <div class="card-body p-4 text-center py-5">
                        <div class="placeholder-glow">
                            <i class="bi bi-bar-chart-line text-light opacity-50" style="font-size: 8rem;"></i>
                            <p class="text-muted mt-3">Monthly course sales visualization will render here.</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Recent Activity --}}
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-header bg-white border-0 pt-4 px-4">
                        <h5 class="fw-bold text-dark mb-0">Recent Activity</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="timeline">
                            <div class="d-flex align-items-start mb-4">
                                <div class="flex-shrink-0 bg-primary bg-opacity-10 rounded-circle p-2">
                                    <i class="bi bi-person-plus text-primary small"></i>
                                </div>
                                <div class="ms-3">
                                    <h6 class="mb-0 small fw-bold">Rahul Sharma enrolled</h6>
                                    <small class="text-muted d-block">Mastering Laravel 12</small>
                                    <small class="text-primary extra-small fw-bold">2 mins ago</small>
                                </div>
                            </div>
                            <div class="d-flex align-items-start mb-4">
                                <div class="flex-shrink-0 bg-warning bg-opacity-10 rounded-circle p-2">
                                    <i class="bi bi-star text-warning small"></i>
                                </div>
                                <div class="ms-3">
                                    <h6 class="mb-0 small fw-bold">New 5-star review</h6>
                                    <small class="text-muted d-block">React Native Bootcamp</small>
                                    <small class="text-primary extra-small fw-bold">1 hour ago</small>
                                </div>
                            </div>
                            <div class="d-flex align-items-start">
                                <div class="flex-shrink-0 bg-success bg-opacity-10 rounded-circle p-2">
                                    <i class="bi bi-cash-stack text-success small"></i>
                                </div>
                                <div class="ms-3">
                                    <h6 class="mb-0 small fw-bold">Payment Received</h6>
                                    <small class="text-muted d-block">Withdrawal #4452 processed</small>
                                    <small class="text-primary extra-small fw-bold">Yesterday</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4 mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="card-header bg-white py-3 px-4 d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-bold text-dark">My Latest Courses</h5>
                        <a href="{{ url('instructor/courses') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">View All</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4">Course Details</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($latestCourses as $course)
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('storage/'.$course->thumbnail) }}" class="rounded shadow-sm me-3" width="60" height="40" style="object-fit: cover;">
                                            <div>
                                                <div class="fw-bold text-dark small">{{ $course->title }}</div>
                                                <small class="text-muted extra-small">Added {{ $course->created_at->format('d M, Y') }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-light text-dark border fw-normal">{{ $course->category->name ?? 'N/A' }}</span></td>
                                    <td>
                                        @if($course->status == 2)
                                            <span class="badge bg-success-subtle text-success px-3 rounded-pill fw-medium">Live</span>
                                        @else
                                            <span class="badge bg-warning-subtle text-warning px-3 rounded-pill fw-medium">Review</span>
                                        @endif
                                    </td>
                                    <td class="fw-bold text-dark small">Free</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .x-small { font-size: 0.7rem; }
    .extra-small { font-size: 0.65rem; }
    .stats-card { transition: all 0.3s ease; }
    .stats-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important; }
    .footer-link { font-size: 0.65rem; text-transform: uppercase; letter-spacing: 0.5px; opacity: 0.9; }
    .footer-link:hover { background-color: rgba(0,0,0,0.2) !important; opacity: 1; }
    .table thead th { font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; font-weight: 700; color: #6c757d; }
    .timeline { position: relative; }
</style>