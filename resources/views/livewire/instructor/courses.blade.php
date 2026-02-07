<div wire:key="instructor-courses-main">
    <div class="instructor-dashboard-wrapper py-4">
        <div class="container-fluid px-lg-4">
            
            <div class="d-md-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold text-dark mb-1">My Courses</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 small text-muted">
                            @foreach($breadcrumbs as $item)
                                <li class="breadcrumb-item {{ $loop->last ? 'active fw-bold' : '' }}">
                                    @if($item['url'] && !$loop->last)
                                        <a href="{{ $item['url'] }}" class="text-decoration-none text-muted">{{ $item['label'] }}</a>
                                    @else
                                        {{ $item['label'] }}
                                    @endif
                                </li>
                            @endforeach
                        </ol>
                    </nav>
                </div>
                <button type="button" wire:click="toggleCreateMode" class="btn btn-primary rounded-pill px-4 py-2 shadow-sm fw-bold mt-3 mt-md-0">
                    <i class="bi bi-plus-lg me-1"></i> New Course
                </button>
            </div>

            @if(session()->has('success'))
                <div class="alert alert-success border-0 shadow-sm mb-4 d-flex align-items-center">
                    <i class="bi bi-check-circle-fill me-2 fs-5"></i> {{ session('success') }}
                </div>
            @endif

            @if($isCreating)
                <div class="row justify-content-center" wire:key="create-form">
                    <div class="col-12 col-xl-7">
                        <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                            <div class="card-header bg-dark text-white p-4 border-0">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h4 class="fw-bold mb-0">Launch Your New Course</h4>
                                    <button type="button" wire:click="toggleCreateMode" class="btn-close btn-close-white"></button>
                                </div>
                            </div>
                            <div class="card-body p-4 p-lg-5">
                                <form wire:submit.prevent="store">
                                    <div class="mb-4">
                                        <label class="form-label fw-bold text-dark">Course Title</label>
                                        <input type="text" wire:model="title" class="form-control form-control-lg @error('title') is-invalid @enderror" placeholder="e.g. Advanced Laravel 11 Mastery">
                                        <div class="form-text">A catchy title helps your course stand out.</div>
                                        @error('title') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label fw-bold text-dark">Category</label>
                                        <select wire:model="category_id" class="form-select form-select-lg @error('category_id') is-invalid @enderror">
                                            <option value="">Select a Category</option>
                                            @foreach($categories as $cat)
                                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label fw-bold text-dark">Course Thumbnail</label>
                                        <div class="upload-zone p-4 border rounded-3 bg-light text-center">
                                            @if ($thumbnail)
                                                <img src="{{ $thumbnail->temporaryUrl() }}" class="img-fluid rounded-3 mb-3 shadow" style="max-height: 200px;">
                                            @else
                                                <i class="bi bi-image fs-1 text-muted d-block mb-2"></i>
                                            @endif
                                            <input type="file" wire:model="thumbnail" class="form-control">
                                            <div wire:loading wire:target="thumbnail" class="text-primary mt-2">
                                                <span class="spinner-border spinner-border-sm me-1"></span> Processing...
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex gap-2">
                                        <button type="button" wire:click="toggleCreateMode" class="btn btn-light btn-lg w-50 fw-bold">Cancel</button>
                                        <button type="submit" class="btn btn-primary btn-lg w-50 fw-bold shadow">Create Course</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-header bg-white border-0 pt-3 px-4">
                        <div class="d-flex border-bottom overflow-auto no-scrollbar">
                            @foreach([2 => 'Published', 1 => 'Pending', 0 => 'Drafts'] as $val => $label)
                                @php $key = ($val == 2 ? 'published' : ($val == 1 ? 'pending' : 'draft')); @endphp
                                <button type="button" wire:click="setTab({{ $val }})" 
                                        class="nav-tab border-0 bg-transparent pb-3 px-4 fw-bold text-nowrap {{ $status == $val ? 'active-tab' : 'text-muted' }}">
                                    {{ $label }} 
                                    <span class="badge {{ $status == $val ? 'bg-primary' : 'bg-light text-dark border' }} ms-1">
                                        {{ $counts[$key] ?? 0 }}
                                    </span>
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            @forelse($courses as $course)
                                <div class="list-group-item p-4 hover-bg transition border-0 border-bottom">
                                    <div class="row align-items-center g-4">
                                        <div class="col-md-3 col-lg-2">
                                            <div class="ratio ratio-16x9">
                                                <img src="{{ $course->thumbnail ? asset('storage/'.$course->thumbnail) : 'https://placehold.co/400x225?text=Preview' }}" 
                                                     class="rounded-3 border shadow-sm object-fit-cover bg-light">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-7">
                                            <div class="d-flex align-items-center gap-2 mb-1">
                                                <h5 class="fw-bold mb-0 text-dark">{{ $course->title }}</h5>
                                                @if($course->status == 2)
                                                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill small">Live</span>
                                                @elseif($course->status == 1)
                                                    <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle rounded-pill small">Reviewing</span>
                                                @endif
                                            </div>
                                            <div class="d-flex align-items-center gap-3 text-muted small">
                                                <span><i class="bi bi-tag me-1"></i>{{ $course->category->name }}</span>
                                                <span><i class="bi bi-calendar3 me-1"></i>{{ $course->created_at->format('M d, Y') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-lg-3 text-md-end">
                                            <div class="btn-group shadow-sm rounded-3">
                                                <a href="#" class="btn btn-white btn-sm px-3 fw-bold border">Edit Course</a>
                                                <button type="button" class="btn btn-white btn-sm dropdown-toggle dropdown-toggle-split border-start-0 border" data-bs-toggle="dropdown"></button>
                                                <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-3">
                                                    @if($course->status == 0)
                                                        <li><button wire:click="submitForReview({{ $course->id }})" class="dropdown-item py-2 fw-bold text-primary"><i class="bi bi-send-fill me-2"></i>Submit for Review</button></li>
                                                    @endif
                                                    <li><a class="dropdown-item py-2" href="#"><i class="bi bi-eye-fill me-2"></i>Live Preview</a></li>
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li><button wire:click="deleteCourse({{ $course->id }})" class="dropdown-item text-danger py-2" onclick="confirm('Delete this course permanently?') || event.stopImmediatePropagation()"><i class="bi bi-trash3-fill me-2"></i>Delete Forever</button></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-5">
                                    <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                        <i class="bi bi-journal-x fs-1 text-muted"></i>
                                    </div>
                                    <h5 class="fw-bold">No courses found</h5>
                                    <p class="text-muted">Start by creating your first course shell today.</p>
                                    <button wire:click="toggleCreateMode" class="btn btn-primary btn-sm rounded-pill px-4">Create New Course</button>
                                </div>
                            @endforelse
                        </div>
                    </div>
                    @if($courses->hasPages())
                        <div class="card-footer bg-white border-0 p-4">
                            {{ $courses->links() }}
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>

    <style>
        .hover-bg:hover { background-color: #f9f9f9; }
        .transition { transition: all 0.25s ease; }
        .nav-tab { font-size: 0.9rem; border-bottom: 3px solid transparent !important; transition: 0.3s; cursor: pointer; letter-spacing: 0.5px; }
        .active-tab { border-bottom: 3px solid #0d6efd !important; color: #0d6efd !important; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .rounded-4 { border-radius: 1rem !important; }
        .btn-white { background: #fff; color: #333; }
        .btn-white:hover { background: #f8f9fa; }
        .upload-zone { border: 2px dashed #dee2e6 !important; }
    </style>
</div>