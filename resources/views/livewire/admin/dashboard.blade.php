<div>
    <div class="container-fluid">
        <x-slot name="breadcrumbSlot">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    @foreach($breadcrumbs as $item)
                        <li class="breadcrumb-item {{ $loop->last ? 'active fw-bold' : '' }}">
                            @if($item['url'] && !$loop->last)
                                <a href="{{ $item['url'] }}" class="text-decoration-none">{{ $item['label'] }}</a>
                            @else
                                {{ $item['label'] }}
                            @endif
                        </li>
                    @endforeach
                </ol>
            </nav>
        </x-slot>

        {{-- <div class="alert alert-success shadow-sm border-0">
            <i class="bi bi-check-circle-fill me-2"></i> 
            <strong>Success!</strong> You have successfully accessed the SmartLMS Admin Panel.
        </div> --}}
<div class="row g-2"> 
    <div class="col-6 col-lg-2">
        <div class="card bg-primary text-white mb-3 border-0 shadow-sm h-100">
            <div class="card-body p-2 text-center">
                <i class="bi bi-people-fill opacity-50 mb-1" style="font-size: 1.5rem;"></i>
                <h4 class="fw-bold mb-0">{{ $totalCustomers }}</h4>
                <p class="mb-0 x-small">Students</p>
            </div>
            <div class="card-footer text-white text-center x-small p-1" style="background: rgba(0,0,0,0.1);">
                Total Users
            </div>
        </div>
    </div>

    <div class="col-6 col-lg-2">
        <div class="card text-white mb-3 border-0 shadow-sm h-100" style="background: #4e73df;">
            <div class="card-body p-2 text-center">
                <i class="bi bi-shield-lock-fill opacity-50 mb-1" style="font-size: 1.5rem;"></i>
                <h4 class="fw-bold mb-0">{{ $totalAdmin }}</h4>
                <p class="mb-0 x-small">Admin Staff</p>
            </div>
            <div class="card-footer text-white text-center x-small p-1" style="background: rgba(0,0,0,0.1);">
                System Access
            </div>
        </div>
    </div>

    <div class="col-6 col-lg-2">
        <div class="card bg-info text-white mb-3 border-0 shadow-sm h-100">
            <div class="card-body p-2 text-center">
                <i class="bi bi-person-workspace opacity-50 mb-1" style="font-size: 1.5rem;"></i>
                <h4 class="fw-bold mb-0"> {{ $totalInstructor }} </h4>
                <p class="mb-0 x-small">Instructors</p>
            </div>
            <div class="card-footer text-white text-center x-small p-1" style="background: rgba(0,0,0,0.1);">
                Active Faculty
            </div>
        </div>
    </div>

        <div class="col-6 col-lg-2">
        <div class="card bg-secondary text-white mb-3 border-0 shadow-sm h-100">
            <div class="card-body p-2 text-center">
                <i class="bi bi-collection-play-fill opacity-50 mb-1" style="font-size: 1.5rem;"></i>
                <h4 class="fw-bold mb-0"> {{ $totalBanner }} </h4>
                <p class="mb-0 x-small">Sliders</p>
            </div>
            <div class="card-footer text-white text-center x-small p-1" style="background: rgba(0,0,0,0.1);">
                Promo Media
            </div>
        </div>
    </div>

    <div class="col-6 col-lg-2">
        <div class="card bg-warning text-dark mb-3 border-0 shadow-sm h-100">
            <div class="card-body p-2 text-center">
                <i class="bi bi-tags-fill opacity-50 mb-1" style="font-size: 1.5rem;"></i>
                <h4 class="fw-bold mb-0"> {{ $totalCategory }} </h4>
                <p class="mb-0 x-small">Taxonomy</p>
            </div>
            <div class="card-footer text-dark text-center x-small p-1" style="background: rgba(0,0,0,0.1);">
                Course Groups
            </div>
        </div>
    </div>

    <div class="col-6 col-lg-2">
        <div class="card bg-dark text-white mb-3 border-0 shadow-sm h-100">
            <div class="card-body p-2 text-center">
                <i class="bi bi-play-circle-fill opacity-50 mb-1" style="font-size: 1.5rem;"></i>
                <h4 class="fw-bold mb-0">150</h4>
                <p class="mb-0 x-small">Live Courses</p>
            </div>
            <div class="card-footer text-white text-center x-small p-1" style="background: rgba(0,0,0,0.1);">
                LMS Content
            </div>
        </div>
    </div>

    <div class="col-6 col-lg-2">
        <div class="card bg-success text-white mb-3 border-0 shadow-sm h-100">
            <div class="card-body p-2 text-center">
                <i class="bi bi-mortarboard-fill opacity-50 mb-1" style="font-size: 1.5rem;"></i>
                <h4 class="fw-bold mb-0">53%</h4>
                <p class="mb-0 x-small">Avg. Score</p>
            </div>
            <div class="card-footer text-white text-center x-small p-1" style="background: rgba(0,0,0,0.1);">
                Student Success
            </div>
        </div>
    </div>

    <div class="col-6 col-lg-2">
        <div class="card bg-danger text-white mb-3 border-0 shadow-sm h-100">
            <div class="card-body p-2 text-center">
                <i class="bi bi-activity opacity-50 mb-1" style="font-size: 1.5rem;"></i>
                <h4 class="fw-bold mb-0">65</h4>
                <p class="mb-0 x-small">Real-time</p>
            </div>
            <div class="card-footer text-white text-center x-small p-1" style="background: rgba(0,0,0,0.1);">
                Live Traffic
            </div>
        </div>
    </div>
</div>

<style>
    .x-small { font-size: 0.7rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; }
</style>
