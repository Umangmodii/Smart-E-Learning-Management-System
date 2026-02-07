<div wire:key="admin-manage-courses-wrapper">
    <div class="container-fluid py-4">
        
        <div class="row mb-4 align-items-center">
            <div class="col-md-6">
                <h3 class="fw-bold text-dark mb-1">Manage Courses</h3>
                <p class="text-muted small">
                    Current Filter: 
                    <span class="badge bg-primary px-3">
                        @if($status == 0) Drafts @elseif($status == 1) Pending Review @else Published @endif
                    </span>
                </p>
            </div>
            <div class="col-md-6 text-md-end">
                <div class="btn-group shadow-sm">
                    <button wire:click="setTab(1)" class="btn {{ $status == 1 ? 'btn-warning' : 'btn-white border' }} px-4 fw-bold">
                        Pending <span class="badge bg-dark ms-1">{{ $counts['pending'] }}</span>
                    </button>
                    <button wire:click="setTab(2)" class="btn {{ $status == 2 ? 'btn-success' : 'btn-white border' }} px-4 fw-bold">
                        Published <span class="badge bg-white text-dark ms-1">{{ $counts['published'] }}</span>
                    </button>
                    <button wire:click="setTab(0)" class="btn {{ $status == 0 ? 'btn-secondary' : 'btn-white border' }} px-4 fw-bold">
                        Drafts <span class="badge bg-white text-dark ms-1">{{ $counts['drafts'] }}</span>
                    </button>
                </div>
            </div>
        </div>

        @if(session()->has('success'))
            <div class="alert alert-success border-0 shadow-sm mb-4">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            </div>
        @endif

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-secondary small text-uppercase">
                        <tr>
                            <th class="ps-4 py-3">Course Info</th>
                            <th class="py-3">Instructor</th>
                            <th class="py-3">Status Label</th>
                            <th class="py-3 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        @forelse($courses as $course)
                            <tr wire:key="course-{{ $course->id }}">
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ $course->thumbnail ? asset('storage/' . $course->thumbnail) : 'https://placehold.co/100x60' }}" 
                                             class="rounded-3 border me-3" style="width: 100px; height: 60px; object-fit: cover;">
                                        <div>
                                            <h6 class="fw-bold mb-1 text-dark">{{ $course->title }}</h6>
                                            <span class="text-muted small">ID: #{{ $course->id }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-bold text-primary">{{ $course->instructor->name ?? 'Unknown Instructor' }}</div>
                                    <div class="small text-muted">{{ $course->instructor->email ?? 'No email' }}</div>
                                </td>
                                <td>
                                    @if($course->status == 1)
                                        <span class="badge rounded-pill bg-warning text-dark">Awaiting Review</span>
                                    @elseif($course->status == 2)
                                        <span class="badge rounded-pill bg-success text-white">Live</span>
                                    @else
                                        <span class="badge rounded-pill bg-light text-dark border">In Draft</span>
                                    @endif
                                </td>
                                <td class="text-center pe-4">
                                    {{-- 1. DRAFT STATE: Move to Review --}}
                                    @if($status == 0)
                                        <button wire:click="moveToReview({{ $course->id }})" class="btn btn-sm btn-primary px-3 fw-bold shadow-sm">
                                            <i class="bi bi-search me-1"></i> Move to Review
                                        </button>

                                    {{-- 2. PENDING STATE: Approve or Reject --}}
                                    @elseif($status == 1)
                                        <div class="d-flex gap-2 justify-content-center">
                                            <button wire:click="approve({{ $course->id }})" class="btn btn-sm btn-success px-3 fw-bold shadow-sm">
                                                Approve & Publish
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger px-3 fw-bold" data-bs-toggle="collapse" data-bs-target="#reject-area-{{ $course->id }}">
                                                Reject
                                            </button>
                                        </div>
                                        
                                        <div class="collapse mt-3" id="reject-area-{{ $course->id }}" wire:ignore.self>
                                            <div class="p-3 border rounded bg-light text-start shadow-sm">
                                                <textarea wire:model.defer="admin_feedback" class="form-control form-control-sm mb-2" rows="2" placeholder="Feedback for instructor..."></textarea>
                                                <button wire:click="reject({{ $course->id }})" class="btn btn-danger btn-sm w-100">Confirm Reject</button>
                                            </div>
                                        </div>

                                    {{-- 3. PUBLISHED STATE --}}
                                    @elseif($status == 2)
                                        <button class="btn btn-sm btn-white border px-3 text-success fw-bold" disabled>
                                            <i class="bi bi-check-circle-fill"></i> Live on Site
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">
                                    <i class="bi bi-folder-x display-4"></i>
                                    <p class="mt-2">No courses in this category yet.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4">
            {{ $courses->links() }}
        </div>
    </div>
</div>