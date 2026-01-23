<div class="d-flex flex-column flex-lg-row min-vh-100 bg-light">
    
    <div class="d-none d-lg-block bg-white shadow-sm border-end" style="width: 240px; flex-shrink: 0;">
        <div class="p-3 text-center border-bottom">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}"
                 class="rounded-circle mb-2 border" width="50" height="50">
            <div class="fw-bold">{{ auth()->user()->name }}</div>
            <p class="small text-muted mb-0 mt-1">
                {{ auth()->user()->profile->bio ?? 'No bio added yet.' }}
            </p>
        </div>
            <ul class="nav flex-column pt-2">
            <li class="nav-item">
                <a class="nav-link {{ request()->is('dashboard') ? 'active fw-bold' : 'text-dark' }}" 
                href="{{ url('/dashboard') }}" 
                wire:navigate>
                View profile details
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('account-settings') ? 'active fw-bold' : 'text-dark' }}" 
                href="{{ url('/account-settings') }}" 
                >
                Security Setting
                </a>
            </li>
            <li class="nav-item border-top mt-3">
                <a class="nav-link text-danger" href="{{ url('/logout') }}">
                    Logout
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
            <h2 class="fw-bold">Public Profile</h2>
            <p class="text-muted">Add information about yourself to let others know you.</p>
        </div>

        <div class="container-fluid p-0">
            <div class="row justify-content-center m-0"> <div class="col-12 col-xl-10"> 
                    <form wire:submit.prevent="updateProfile"> 
                        <div class="card shadow-sm border-0 rounded-3">
                            <div class="card-body p-4">
                                <div class="row align-items-center mb-4 text-center text-md-start">
                                    <div class="col-12 col-md-auto mb-3 mb-md-0">
                                        <img src="{{ $avatar ? asset('storage/' . $avatar) : 'https://ui-avatars.com/api/?name='. urlencode(auth()->user()->name) }}" 
                                             class="rounded-circle border shadow-sm" width="90" height="90">
                                    </div>
                                    <div class="col-12 col-md">
                                        <h4 class="fw-bold mb-1">{{ auth()->user()->name }}</h4>
                                        <p class="text-muted mb-2">{{ auth()->user()->email }}</p>
                                        <div class="d-flex flex-column flex-md-row align-items-center gap-2">
                                            <input type="file" wire:model="avatar" class="form-control form-control-sm" style="max-width: 200px;">
                                            <span class="badge bg-light text-dark border p-2">Member ID: #{{ auth()->user()->id }}</span>
                                        </div>
                                    </div>
                                </div>

                                <hr class="mb-4">

                                <div class="row g-4">
                                    <div class="col-12">
                                        <label class="form-label text-muted small fw-bold">About Me (Bio)</label>
                                        <textarea wire:model="bio" class="form-control bg-light" rows="3" placeholder="Enter your bio"></textarea>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label text-muted small fw-bold">Date of Birth</label>
                                        <input type="date" wire:model="dob" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label text-muted small fw-bold">Gender</label>
                                        <select wire:model="gender" class="form-select">
                                            <option value="">Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label text-muted small fw-bold">Country</label>
                                        <input type="text" wire:model="country" class="form-control" placeholder="Country">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label text-muted small fw-bold">City</label>
                                        <input type="text" wire:model="city" class="form-control" placeholder="City">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label text-muted small fw-bold">Preferred Language</label>
                                        <input type="text" wire:model="language" class="form-control" placeholder="Language">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label text-muted small fw-bold">Phone</label>
                                        <input type="text" wire:model="phone" class="form-control" placeholder="Phone">
                                    </div>
                                </div>

                                <div class="mt-4 pt-3 border-top text-center text-md-start">
                                    <button type="submit" class="btn btn-primary px-5 fw-bold shadow-sm">
                                        <span wire:loading.remove>Update Profile</span>
                                        <span wire:loading>Saving...</span>
                                    </button>

                                    <div class="mt-3">
                                        @if (session()->has('success'))
                                            <div class="alert alert-success">{{ session('success') }}</div>
                                        @elseif (session()->has('error'))
                                            <div class="alert alert-danger">{{ session('error') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>