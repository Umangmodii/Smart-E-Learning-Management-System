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
                    <a class="nav-link text-dark py-2" href="{{ url('/dashboard') }}" wire:navigate>
                        View profile details
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active fw-bold py-2" href="{{ url('/account-settings') }}" wire:navigate>
                        Security Setting
                    </a>
                </li>
                <li class="nav-item border-top mt-3">
                    <a class="nav-link text-danger py-2" href="#"><i class="bi bi-box-arrow-right me-2"></i> Logout</a>
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
                    <a class="nav-link {{ request()->is('dashboard') ? 'active fw-bold' : '' }} py-3" href="{{ url('/dashboard') }}" wire:navigate>
                        <i class="bi bi-person-circle me-2"></i> Profile details
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('account-settings') ? 'active fw-bold' : '' }} py-3 text-dark" href="{{ url('/account-settings') }}" wire:navigate>
                        <i class="bi bi-shield-lock me-2"></i> Security Setting
                    </a>
                </li>
                <li class="nav-item border-top mt-3 pt-2">
                    <a class="nav-link text-danger py-3" href="#"><i class="bi bi-box-arrow-right me-2"></i> Logout</a>
                </li>
            </ul>
        </div>
    </div>

        <div class="flex-grow-1 p-3 p-md-4">
            <div class="text-center mb-4">
                <h2 class="fw-bold">Account Settings</h2>
                <p class="text-muted">Edit your account settings and change your password here.</p>
            </div>

            <div class="container-fluid p-0">
                <div class="row justify-content-center m-0">
                    <div class="col-12 col-xl-8">
                        <form wire:submit.prevent="updateAccount">
                            <div class="card shadow-sm border-0 rounded-4">
                                <div class="card-body p-4 p-md-5">
                                    
                                    <div class="mb-4">
                                        <label class="form-label fw-bold text-muted small uppercase">Email Address</label>
                                        <input type="email" wire:model="email" class="form-control bg-light border-0 py-2">
                                        <div class="form-text">Your email address is <strong>{{ auth()->user()->email }}</strong></div>
                                        @error('email') <span class="text-danger small">{{ $message }}</span> @enderror
                                    </div>

                                    <hr class="my-4 opacity-25">

                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold text-muted small uppercase">New Password</label>
                                            <input type="password" wire:model="password" class="form-control bg-light border-0 py-2" placeholder="••••••••">
                                            @error('password') <span class="text-danger small">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold text-muted small uppercase">Confirm Password</label>
                                            <input type="password" wire:model="password_confirmation" class="form-control bg-light border-0 py-2" placeholder="••••••••">
                                        </div>
                                    </div>

                                    <div class="mt-5 pt-3 border-top">
                                        <button type="submit" class="btn btn-primary px-5 fw-bold rounded-pill shadow-sm" wire:loading.attr="disabled">
                                            <span wire:loading.remove wire:target="updateAccount">Update Account</span>
                                            <span wire:loading wire:target="updateAccount">
                                                <span class="spinner-border spinner-border-sm me-2"></span>Processing...
                                            </span>
                                        </button>
                                    </div>

                                    @if (session()->has('success'))
                                        <div class="alert alert-success mt-3 border-0 rounded-3">
                                            <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
