<div class="instructor-profile-wrapper" x-data="{ selectedField: null }">
    <div class="container-fluid py-4">
        {{-- Breadcrumbs --}}
        <div class="row mb-4">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-white px-3 py-2 rounded-3 shadow-sm border-0">
                        @foreach($breadcrumbs as $item)
                            <li class="breadcrumb-item {{ $loop->last ? 'active fw-bold text-dark' : '' }}">
                                @if($item['url'] && !$loop->last)
                                    <a href="{{ $item['url'] }}" class="text-decoration-none text-primary">{{ $item['label'] }}</a>
                                @else
                                    {{ $item['label'] }}
                                @endif
                            </li>
                        @endforeach
                    </ol>
                </nav>
            </div>
        </div>

        {{-- Header Card --}}
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white d-flex flex-row align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 p-3 rounded-3 me-3">
                            <i class="bi bi-person-badge-fill text-primary fs-3"></i>
                        </div>
                        <div>
                            <h4 class="fw-bold mb-0">Public Instructor Profile</h4>
                            <p class="text-muted mb-0 small">Manage your professional identity and social presence.</p>
                        </div>
                    </div>
                    {{-- System Timestamps --}}
                    <div class="d-none d-md-flex flex-column align-items-end">
                        <span class="badge bg-light text-muted border px-3 py-1 rounded-pill mb-1" style="font-size: 0.7rem;">
                            Member Since: {{ auth()->guard('instructor')->user()->created_at->format('M Y') }}
                        </span>
                        <span class="badge bg-soft-info text-primary border border-primary border-opacity-10 px-3 py-1 rounded-pill" style="font-size: 0.7rem;">
                            ID: #INST-{{ str_pad(auth()->guard('instructor')->id(), 5, '0', STR_PAD_LEFT) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <form wire:submit.prevent="instructor_profile">
            <div class="row g-4">
                {{-- Left Column: Account & Media --}}
                <div class="col-12 col-lg-4">
                    <div class="card border-0 shadow-sm rounded-4 h-100 p-4">
                        <h6 class="fw-bold mb-4">Profile Identity</h6>
                        
                        {{-- Avatar Upload Section --}}
                        <div class="text-center mb-4">
                            <div class="position-relative d-inline-block">
                                {{-- Uploading Spinner --}}
                                <div wire:loading wire:target="avatar" class="position-absolute top-50 start-50 translate-middle z-3">
                                    <div class="spinner-border text-primary" role="status" style="width: 2.5rem; height: 2.5rem;"></div>
                                </div>

                                <div wire:loading.class="opacity-50" wire:target="avatar">
                                    @if ($avatar && !is_string($avatar))
                                        <img src="{{ $avatar->temporaryUrl() }}" class="rounded-circle border border-4 border-white shadow" width="140" height="140" style="object-fit: cover;">
                                    @elseif($current_avatar)
                                        <img src="{{ asset('storage/' . $current_avatar) }}" class="rounded-circle border border-4 border-white shadow" width="140" height="140" style="object-fit: cover;">
                                    @else
                                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto shadow" style="width: 140px; height: 140px; font-size: 3.5rem;">
                                            {{ strtoupper(substr(auth()->guard('instructor')->user()->name, 0, 1)) }}
                                        </div>
                                    @endif
                                </div>

                                <label for="avatarUpload" class="position-absolute bottom-0 end-0 bg-primary text-white rounded-circle p-2 shadow border border-2 border-white cursor-pointer" wire:loading.class="d-none" wire:target="avatar">
                                    <i class="bi bi-camera-fill"></i>
                                    <input type="file" id="avatarUpload" wire:model="avatar" class="d-none" accept="image/*">
                                </label>
                            </div>
                            @error('avatar') <div class="text-danger small fw-bold mt-2">{{ $message }}</div> @enderror
                        </div>

                        {{-- Editable Name --}}
                        <div class="mb-3">
                            <label class="form-label x-small text-muted">Full Name</label>
                            <input type="text" wire:model="name" class="form-control bg-light border-0 fw-semibold rounded-3" placeholder=" {{ auth()->guard('instructor')->user()->name }}">
                            @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        {{-- Locked Email --}}
                        <div class="mb-4">
                            <label class="form-label x-small text-muted">Email Address (Primary)</label>
                            <div class="form-control bg-white border text-muted rounded-3 px-3 py-2 d-flex justify-content-between align-items-center" style="cursor: not-allowed; background-color: #fcfcfc !important;">
                                {{ auth()->guard('instructor')->user()->email }}
                                <i class="bi bi-shield-lock-fill text-secondary opacity-50"></i>
                            </div>
                        </div>

                        <hr class="my-4 opacity-25">

                        <h6 class="fw-bold mb-3">Social Connectivity</h6>
                        <div class="space-y-3">
                            <div class="input-group mb-2">
                                <span class="input-group-text bg-light border-0"><i class="bi bi-globe text-secondary"></i></span>
                                <input type="url" wire:model="website" class="form-control border-0 bg-light small" placeholder="Website URL">
                            </div>
                            <div class="input-group mb-2">
                                <span class="input-group-text bg-light border-0"><i class="bi bi-facebook text-primary"></i></span>
                                <input type="url" wire:model="facebook_url" class="form-control border-0 bg-light small" placeholder="Facebook URL">
                            </div>
                            <div class="input-group mb-2">
                                <span class="input-group-text bg-light border-0"><i class="bi bi-instagram text-danger"></i></span>
                                <input type="url" wire:model="instagram_url" class="form-control border-0 bg-light small" placeholder="Instagram URL">
                            </div>
                            <div class="input-group mb-2">
                                <span class="input-group-text bg-light border-0"><i class="bi bi-linkedin text-info"></i></span>
                                <input type="url" wire:model="linkedin_url" class="form-control border-0 bg-light small" placeholder="LinkedIn Profile">
                            </div>
                            <div class="input-group mb-2">
                                <span class="input-group-text bg-light border-0"><i class="bi bi-youtube text-danger"></i></span>
                                <input type="url" wire:model="youtube_url" class="form-control border-0 bg-light small" placeholder="YouTube Channel">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right Column: Professional Content --}}
                <div class="col-12 col-lg-8">
                    @if (session()->has('success'))
                        <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4 d-flex align-items-center p-3 animate__animated animate__fadeInDown">
                            <i class="bi bi-check-circle-fill fs-4 me-3"></i>
                            <div class="fw-bold">{{ session('success') }}</div>
                        </div>
                    @endif

                    <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                        <div class="mb-4">
                            <label class="form-label fw-bold small text-uppercase text-muted">Professional Headline</label>
                            <input type="text" wire:model="headline" class="form-control form-control-lg border-0 bg-light rounded-3" placeholder="e.g. Senior Software Architect | 10+ Years Experience">
                            @error('headline') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold small text-uppercase text-muted">Biography</label>
                            <textarea wire:model="bio" class="form-control border-0 bg-light rounded-3" rows="11" placeholder="Describe your background, teaching style, and expertise..."></textarea>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                            <div class="d-flex flex-column">
                                <small class="text-muted"><i class="bi bi-calendar-check me-1"></i> Profile Created: {{ auth()->guard('instructor')->user()->created_at->toFormattedDateString() }}</small>
                                <small class="text-primary fw-bold mt-1"><i class="bi bi-clock-history me-1"></i> Last Activity: {{ auth()->guard('instructor')->user()->updated_at->diffForHumans() }}</small>
                            </div>
                            <button type="submit" class="btn btn-primary px-5 py-3 rounded-3 shadow-sm fw-bold" wire:loading.attr="disabled" wire:target="instructor_profile, avatar">
                                <span wire:loading.remove wire:target="instructor_profile">
                                    Update Profile <i class="bi bi-arrow-right-short ms-1"></i>
                                </span>
                                <span wire:loading wire:target="instructor_profile">
                                    <span class="spinner-border spinner-border-sm me-2"></span> Updating...
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <style>
        .instructor-profile-wrapper { background-color: #f4f7fa; min-height: 100vh; font-family: 'Inter', sans-serif; }
        .x-small { font-size: 0.65rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1.2px; margin-bottom: 5px; display: block; }
        .form-control { transition: all 0.2s ease-in-out; }
        .form-control:focus { background-color: #fff !important; box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.15); border: 1px solid #0d6efd !important; }
        .input-group-text { min-width: 48px; justify-content: center; }
        .bg-soft-info { background-color: rgba(13, 202, 240, 0.1); }
        .cursor-pointer { cursor: pointer; }
    </style>
</div>