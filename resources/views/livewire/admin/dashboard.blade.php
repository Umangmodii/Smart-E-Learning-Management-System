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
                <p class="mb-0 x-small">Customers</p>
            </div>
            <a href="{{ url('admin/student_users') }}" class="card-footer text-white text-center text-decoration-none x-small p-1" style="background: rgba(0,0,0,0.1);">
                More <i class="bi bi-arrow-right-circle"></i>
            </a>
        </div>
    </div>

    <div class="col-6 col-lg-2">
        <div class="card text-white mb-3 border-0 shadow-sm h-100" style="background: linear-gradient(45deg, #4e73df 0%, #224abe 100%);">
            <div class="card-body p-2 text-center">
                <i class="bi bi-shield-lock-fill opacity-25 mb-1" style="font-size: 1.5rem;"></i>
                <h4 class="fw-bold mb-0">{{ $totalAdmin }}</h4>
                <p class="mb-0 x-small">Admins</p>
            </div>
            <a href="{{ url('admin/admin_users') }}" class="card-footer text-white text-center text-decoration-none x-small p-1" style="background: rgba(0,0,0,0.1);">
                View <i class="bi bi-arrow-right-circle"></i>
            </a>
        </div>
    </div>

    <div class="col-6 col-lg-2">
        <div class="card bg-info text-white mb-3 border-0 shadow-sm h-100">
            <div class="card-body p-2 text-center">
                <i class="bi bi-book-half opacity-50 mb-1" style="font-size: 1.5rem;"></i>
                <h4 class="fw-bold mb-0">150</h4>
                <p class="mb-0 x-small">Courses</p>
            </div>
            <a href="#" class="card-footer text-white text-center text-decoration-none x-small p-1" style="background: rgba(0,0,0,0.1);">
                List <i class="bi bi-arrow-right-circle"></i>
            </a>
        </div>
    </div>

    <div class="col-6 col-lg-2">
        <div class="card bg-success text-white mb-3 border-0 shadow-sm h-100">
            <div class="card-body p-2 text-center">
                <i class="bi bi-graph-up-arrow opacity-50 mb-1" style="font-size: 1.5rem;"></i>
                <h4 class="fw-bold mb-0">53%</h4>
                <p class="mb-0 x-small">Pass Rate</p>
            </div>
            <a href="#" class="card-footer text-white text-center text-decoration-none x-small p-1" style="background: rgba(0,0,0,0.1);">
                Stats <i class="bi bi-arrow-right-circle"></i>
            </a>
        </div>
    </div>

    <div class="col-6 col-lg-2">
        <div class="card bg-warning text-dark mb-3 border-0 shadow-sm h-100">
            <div class="card-body p-2 text-center">
                <i class="bi bi-person-plus opacity-50 mb-1" style="font-size: 1.5rem;"></i>
                <h4 class="fw-bold mb-0">44</h4>
                <p class="mb-0 x-small">New Users</p>
            </div>
            <a href="#" class="card-footer text-dark text-center text-decoration-none x-small p-1" style="background: rgba(0,0,0,0.1);">
                Check <i class="bi bi-arrow-right-circle"></i>
            </a>
        </div>
    </div>

    <div class="col-6 col-lg-2">
        <div class="card bg-danger text-white mb-3 border-0 shadow-sm h-100">
            <div class="card-body p-2 text-center">
                <i class="bi bi-eye-fill opacity-50 mb-1" style="font-size: 1.5rem;"></i>
                <h4 class="fw-bold mb-0">65</h4>
                <p class="mb-0 x-small">Visitors</p>
            </div>
            <a href="#" class="card-footer text-white text-center text-decoration-none x-small p-1" style="background: rgba(0,0,0,0.1);">
                Traffic <i class="bi bi-arrow-right-circle"></i>
            </a>
        </div>
    </div>



<style>
    .x-small { font-size: 0.7rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; }
</style>

        </div>
    </div>  
    
</div>