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

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-xl-4 col-lg-5 mb-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body text-center p-5">
                        <div class="position-relative d-inline-block mb-3">
                            @if ($avatar && !is_string($avatar))
                                    <div class="col-12 col-md-auto mb-3 mb-md-0">
                                        <img src="{{ $avatar ? asset('storage/' . $avatar) : 'https://ui-avatars.com/api/?name='. urlencode(auth()->user()->name) }}" 
                                             class="rounded-circle border shadow-sm" width="130" height="130">
                                    </div>
                            @elseif($current_avatar)
                                <img src="{{ asset('storage/'.$current_avatar) }}" class=" border-3 border-white shadow-sm" width="130" height="130" style="object-fit: cover;">
                            @else
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto shadow-sm" style="width: 130px; height: 130px; font-size: 3.5rem;">
                                    {{ strtoupper(substr($name, 0, 1)) }}
                                </div>
                            @endif
                            <span class="position-absolute bottom-0 end-0 bg-success border border-2 border-white rounded-circle p-2"></span>
                        </div>
                        
                        <h4 class="fw-bold mb-1 text-dark">{{ $name }}</h4>
                        <p class="text-muted mb-3 small fw-medium">{{ $email }}</p>
                        
                        <span class="badge rounded-pill {{ $role_id == 1 ? 'bg-primary' : 'bg-danger' }} px-4 py-2 small shadow-sm">
                            <i class="bi {{ $role_id == 1 ? 'bi-shield-check' : 'bi-person' }} me-1"></i>
                            {{ $role_id == 1 ? 'Admin' : 'User' }}
                        </span>
                        
                        <hr class="my-4 opacity-25">
                        
                        <div class="text-start bg-light p-3 rounded small">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-secondary">Registered:</span>
                                <span class="fw-bold text-dark">{{ auth()->user()->created_at->format('d M Y') }}</span>
                            </div>
                             <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-secondary">Last updated:</span>
                                <span class="fw-bold text-dark text-primary">{{ auth()->user()->updated_at->diffForHumans() }}</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-secondary">Contact:</span>
                                <span class="fw-bold text-dark">{{ $phone }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-8 col-lg-7 mb-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-header bg-white py-3 border-bottom d-flex align-items-center">
                        <div class="bg-primary-subtle p-2 rounded me-3">
                            <i class="bi bi-person-gear text-primary fs-5"></i>
                        </div>
                        <h5 class="mb-0 fw-bold text-dark">Admin Configuration</h5>
                    </div>
                    <div class="card-body p-4 p-md-5">
                        <form wire:submit.prevent="updateProfile">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-uppercase text-secondary">Full Name</label>
                                    <input type="text" wire:model="name" class="form-control shadow-none">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-uppercase text-secondary">Email Address</label>
                                    <input type="email" wire:model="email" class="form-control bg-light" readonly>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-uppercase text-secondary">Contact Number</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white border-end-0"><i class="bi bi-whatsapp text-success"></i></span>
                                        <input type="text" wire:model="phone" class="form-control border-start-0 ps-0">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-uppercase text-secondary">Role</label>
                                    <select wire:model="role_id" class="form-select" {{ auth()->user()->role_id != 1 ? 'disabled' : '' }}>
                                        <option value="1">Admin</option>
                                        <option value="3">User</option>
                                    </select>
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label fw-bold small text-uppercase text-secondary">Upload New Avatar</label>
                                    <input type="file" wire:model="avatar" class="form-control">
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
                                
                                <div class="col-md-12">
                                    <label class="form-label text-muted small fw-bold">Date of Birth</label>
                                    <input type="date" wire:model="dob" class="form-control">
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label fw-bold small text-uppercase text-secondary">Professional Bio</label>
                                    <textarea wire:model="bio" class="form-control" rows="4"></textarea>
                                </div>

                                <div class="col-12 mt-5 text-end">
                                    <button type="submit" class="btn btn-primary px-5 py-2 fw-bold shadow-sm">
                                        Update Admin Profile
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>