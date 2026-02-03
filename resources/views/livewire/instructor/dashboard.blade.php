<div class="instructor-dashboard-wrapper">
    <div class="container-fluid">
        
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

        <div class="row g-3"> 
            
            <div class="col-6 col-lg-3 col-xl-2">
                <div class="card bg-success text-white border-0 shadow-sm h-100 stats-card">
                    <div class="card-body p-3 text-center">
                        <i class="bi bi-wallet2 opacity-75 mb-1 fs-4"></i>
                        <h4 class="fw-bold mb-0">$1,250</h4>
                        <p class="mb-0 x-small">Net Earnings</p>
                    </div>
                    <a href="#" class="card-footer text-white text-center text-decoration-none x-small p-1 footer-link">
                        Statements <i class="bi bi-arrow-right-short"></i>
                    </a>
                </div>
            </div>

            <div class="col-6 col-lg-3 col-xl-2">
                <div class="card bg-primary text-white border-0 shadow-sm h-100 stats-card">
                    <div class="card-body p-3 text-center">
                        <i class="bi bi-people-fill opacity-75 mb-1 fs-4"></i>
                        <h4 class="fw-bold mb-0">342</h4>
                        <p class="mb-0 x-small">Total Students</p>
                    </div>
                    <a href="#" class="card-footer text-white text-center text-decoration-none x-small p-1 footer-link">
                        View List <i class="bi bi-arrow-right-short"></i>
                    </a>
                </div>
            </div>

            <div class="col-6 col-lg-3 col-xl-2">
                <div class="card bg-info text-white border-0 shadow-sm h-100 stats-card">
                    <div class="card-body p-3 text-center">
                        <i class="bi bi-journal-check opacity-75 mb-1 fs-4"></i>
                        <h4 class="fw-bold mb-0">08</h4>
                        <p class="mb-0 x-small">Live Courses</p>
                    </div>
                    <a href="#" class="card-footer text-white text-center text-decoration-none x-small p-1 footer-link">
                        Inventory <i class="bi bi-arrow-right-short"></i>
                    </a>
                </div>
            </div>

            <div class="col-6 col-lg-3 col-xl-2">
                <div class="card bg-warning text-white border-0 shadow-sm h-100 stats-card">
                    <div class="card-body p-3 text-center">
                        <i class="bi bi-hourglass-split opacity-75 mb-1 fs-4"></i>
                        <h4 class="fw-bold mb-0">02</h4>
                        <p class="mb-0 x-small">In Review</p>
                    </div>
                    <a href="#" class="card-footer text-white text-center text-decoration-none x-small p-1 footer-link">
                        Status <i class="bi bi-arrow-right-short"></i>
                    </a>
                </div>
            </div>

            <div class="col-6 col-lg-3 col-xl-2">
                <div class="card bg-indigo text-white border-0 shadow-sm h-100 stats-card" style="background-color: #6610f2;">
                    <div class="card-body p-3 text-center">
                        <i class="bi bi-star-fill text-warning mb-1 fs-4"></i>
                        <h4 class="fw-bold mb-0">4.9</h4>
                        <p class="mb-0 x-small">Avg Rating</p>
                    </div>
                    <a href="#" class="card-footer text-white text-center text-decoration-none x-small p-1 footer-link">
                        Reviews <i class="bi bi-arrow-right-short"></i>
                    </a>
                </div>
            </div>

            <div class="col-6 col-lg-3 col-xl-2">
                <div class="card bg-danger text-white border-0 shadow-sm h-100 stats-card">
                    <div class="card-body p-3 text-center">
                        <i class="bi bi-graph-up-arrow opacity-75 mb-1 fs-4"></i>
                        <h4 class="fw-bold mb-0">1.8k</h4>
                        <p class="mb-0 x-small">Visitors</p>
                    </div>
                    <a href="#" class="card-footer text-white text-center text-decoration-none x-small p-1 footer-link">
                        Analytics <i class="bi bi-arrow-right-short"></i>
                    </a>
                </div>
            </div>

        </div>

        <div class="row mt-4 g-4">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-header bg-white border-0 pt-4 px-4">
                        <h5 class="fw-bold text-dark">Enrollment Performance</h5>
                    </div>
                    <div class="card-body p-4 text-center py-5">
                        <div class="placeholder-glow">
                            <i class="bi bi-bar-chart-line text-light" style="font-size: 8rem;"></i>
                            <p class="text-muted mt-3">Monthly course sales visualization will render here.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-header bg-white border-0 pt-4 px-4">
                        <h5 class="fw-bold text-dark">Recent Activity</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-shrink-0 bg-primary bg-opacity-10 rounded-circle p-2">
                                <i class="bi bi-person-plus text-primary"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="mb-0 small fw-bold">Rahul Sharma enrolled</h6>
                                <small class="text-muted">Mastering Laravel 12</small>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 bg-warning bg-opacity-10 rounded-circle p-2">
                                <i class="bi bi-star text-warning"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="mb-0 small fw-bold">New 5-star review</h6>
                                <small class="text-muted">React Native Bootcamp</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>