<div>
    <div class="d-flex flex-column flex-lg-row min-vh-100 bg-light">

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
        
        <div class="d-none d-lg-block bg-white shadow-sm border-end" style="width: 240px; flex-shrink: 0;">
            <div class="p-3 text-center border-bottom">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}" class="rounded-circle mb-2 border" width="50" height="50">
                <div class="fw-bold text-truncate">{{ auth()->user()->name }}</div>
                <p class="small text-muted mb-0 mt-1">{{ auth()->user()->profile->bio ?? 'No bio added yet.' }}</p>
            </div>
            <ul class="nav flex-column pt-2">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('dashboard') ? 'active fw-bold' : 'text-dark' }} py-3" 
                    href="{{ url('/dashboard') }}" wire:navigate>
                        <i class="bi bi-person-circle me-2"></i> Profile Details
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('account-settings*') ? 'active fw-bold' : 'text-dark' }} py-3" 
                    href="{{ url('/account-settings') }}" wire:navigate>
                        <i class="bi bi-shield-lock me-2"></i> Security Settings
                    </a>
                </li>

                <!-- Enrolled Courses -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('course-enroll') ? 'active fw-bold' : 'text-dark' }} py-3" 
                    href="{{ url('/course-enroll') }}" wire:navigate>
                        <i class="bi bi-journal-bookmark me-2"></i> Enrolled Courses
                    </a>
                </li>

                <!-- Course Reviews -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('course-reviews') ? 'active fw-bold' : 'text-dark' }} py-3" 
                    href="{{ url('/course-reviews') }}" wire:navigate>
                        <i class="bi bi-star-half me-2"></i> Course Reviews
                    </a>
                </li>

                <!-- Order History -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('order-history') ? 'active fw-bold' : 'text-dark' }} py-3" 
                    href="{{ url('/order-history') }}" wire:navigate>
                        <i class="bi bi-receipt me-2"></i> Order History
                    </a>
                </li>

                <!-- Logout -->
                <li class="nav-item border-top mt-3 pt-2">
                    <a class="nav-link text-danger py-3" href="#" wire:navigate>
                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                    </a>
                </li>
            </ul>
        </div>

        <div class="d-lg-none bg-white p-3 shadow-sm d-flex justify-content-between align-items-center sticky-top">
            <span class="fw-bold text-primary">SmartLMS</span>
            <button class="btn btn-sm btn-light border" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar">
                <i class="bi bi-list"></i> Menu
            </button>
        </div>

   <div class="offcanvas offcanvas-start d-lg-none" tabindex="-1" id="mobileSidebar" style="width: 280px;">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title fw-bold">Menu</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body p-0">
            <div class="p-4 text-center border-bottom bg-light">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}"
                     class="rounded-circle mb-2 border" width="70" height="70">
                <div class="fw-bold">{{ auth()->user()->name }}</div>
                <p class="small text-muted">{{ auth()->user()->profile->bio ?? 'No bio added yet.' }}</p>
            </div>
            
           <ul class="nav flex-column p-3">
                 <li class="nav-item">
                    <a class="nav-link {{ request()->is('dashboard') ? 'active fw-bold' : 'text-dark' }} py-3" 
                    href="{{ url('/dashboard') }}" wire:navigate>
                        <i class="bi bi-person-circle me-2"></i> Profile Details
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('account-settings*') ? 'active fw-bold' : 'text-dark' }} py-3" 
                    href="{{ url('/account-settings') }}" wire:navigate>
                        <i class="bi bi-shield-lock me-2"></i> Security Settings
                    </a>
                </li>

                <!-- Enrolled Courses -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('course-enroll') ? 'active fw-bold' : 'text-dark' }} py-3" 
                    href="{{ url('/course-enroll') }}" wire:navigate>
                        <i class="bi bi-journal-bookmark me-2"></i> Enrolled Courses
                    </a>
                </li>

                <!-- Course Reviews -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('course-reviews') ? 'active fw-bold' : 'text-dark' }} py-3" 
                    href="{{ url('/course-reviews') }}" wire:navigate>
                        <i class="bi bi-star-half me-2"></i> Course Reviews
                    </a>
                </li>

                <!-- Order History -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('order-history') ? 'active fw-bold' : 'text-dark' }} py-3" 
                    href="{{ url('/order-history') }}" wire:navigate>
                        <i class="bi bi-receipt me-2"></i> Order History
                    </a>
                </li>

                <!-- Logout -->
                <li class="nav-item border-top mt-3 pt-2">
                    <a class="nav-link text-danger py-3" href="#" wire:navigate>
                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>

      <div class="flex-grow-1 p-3 p-md-4">
            <div class="text-center mb-4">
                <h2 class="fw-bold">Order History</h2>
            </div>
            <hr>

       <div class="row g-4">
            @foreach($orders as $order)
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card shadow-sm border-0 h-100 overflow-hidden" style="border-radius: 14px; transition: 0.3s;"
                        onmouseover="this.style.transform='translateY(-5px)'"
                        onmouseout="this.style.transform='translateY(0)'">

                        <div class="position-relative">
                             <img src="{{ asset('storage/'.$order->course->thumbnail) }}"
                                                            class="card-img-top"
                                                            style="aspect-ratio:16/9; object-fit:cover;">

                            <span class="position-absolute top-0 end-0 m-2 badge rounded-pill 
                                @if(optional($order->payment)->status == 'success') bg-success
                                @elseif(optional($order->payment)->status == 'pending') bg-warning text-dark
                                @else bg-danger @endif">
                                {{ ucfirst($order->payment->status ?? 'pending') }}
                            </span>
                        </div>

                        <div class="card-body p-3 p-md-4">

                            <h5 class="fw-bold mb-2 text-truncate">
                                {{ $order->course->title ?? 'Course Not Found' }}
                            </h5>

                            <small class="text-muted d-block mb-2">
                                Order #{{ $order->id }}
                            </small>

                            <div class="text-secondary small mb-3">

                                <div class="mb-1">
                                    <i class="bi bi-geo-alt me-1"></i>
                                    {{ $order->city ?? '-' }}, {{ $order->state ?? '-' }}
                                </div>

                                <div class="mb-1">
                                    <i class="bi bi-calendar-event me-1"></i>
                                    {{ optional($order->created_at)->format('d M Y') }}
                                </div>

                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-3">

                                <div>
                                    <span class="text-muted small d-block">Paid</span>
                                    <h5 class="fw-bold mb-0 text-success">
                                        ₹{{ number_format($order->payment->amount ?? 0, 2) }}
                                    </h5>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
            </div>

        </div>
    </div>
</div>
