<div class="instructor-dashboard-wrapper py-4" wire:key="instructor-courses-main">
    <div class="container-fluid px-lg-5">
        
        {{-- 1. BREADCRUMBS --}}
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb bg-white px-3 py-2 rounded-3 shadow-sm border-0 fw-medium">
                @foreach($breadcrumbs as $item)
                    <li class="breadcrumb-item {{ $loop->last ? 'active text-dark' : '' }}">
                        @if($item['url'] && !$loop->last)
                            <a href="{{ $item['url'] }}" class="text-decoration-none text-primary">{{ $item['label'] }}</a>
                        @else
                            {{ $item['label'] }}
                        @endif
                    </li>
                @endforeach
            </ol>
        </nav>

        {{-- 2. DYNAMIC HEADER SECTION --}}
        <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden">
            <div class="card-body p-4">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 p-3 rounded-3 me-3">
                            <i class="bi bi-play-btn-fill text-primary fs-2"></i>
                        </div>
                        <div>
                            <h4 class="fw-medium text-dark mb-1">Course Management</h4>
                            <p class="text-muted small mb-0 fw-normal">Establish and manage your curriculum shells here.</p>
                        </div>
                    </div>

                    <div class="text-md-end d-flex flex-column align-items-md-end gap-2">
                        @if(!$isCreating && !$isEditing)
                            <button type="button" wire:click="toggleCreateMode" class="btn btn-primary rounded-pill px-4 py-2 shadow-sm fw-medium border-0 mt-md-1 w-100 w-md-auto">
                                <i class="bi bi-plus-lg me-1"></i> New Course
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- 3. ALERTS --}}
        @if(session()->has('success'))
            <div class="alert alert-success border-0 shadow-sm mb-4 d-flex align-items-center animate__animated animate__fadeIn">
                <i class="bi bi-check-circle-fill me-2 fs-5"></i> 
                <span class="fw-medium">{{ session('success') }}</span>
            </div>
        @endif

        {{-- 4. WORKSPACE MODES (Form) --}}
        @if($isCreating || $isEditing)
            <div class="row justify-content-center animate__animated animate__fadeIn" wire:key="{{ $isEditing ? 'edit' : 'create' }}-form">
                <div class="col-12">
                    <form wire:submit.prevent="{{ $isEditing ? 'updateCourse' : 'store' }}">
                        <div class="card border-0 shadow-lg rounded-4 overflow-hidden mb-5">
                            <div class="card-header bg-dark text-white p-4 border-0 d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="fw-medium mb-0">{{ $isEditing ? 'Edit Course' : 'Launch New Course' }}</h5>
                                    <p class="text-secondary small mb-0 fw-normal opacity-75">Fill in all information required for the course marketplace.</p>
                                </div>
                                <button type="button" wire:click="{{ $isEditing ? 'cancelEdit' : 'toggleCreateMode' }}" class="btn-close btn-close-white shadow-none"></button>
                            </div>

                            <div class="card-body p-0 bg-white">
                                <div class="row g-0">
                                    {{-- LEFT: Visual Media Workspace --}}
                                    <div class="col-lg-4 bg-light border-end p-4 p-lg-5">
                                        <div class="sticky-top" style="top: 2rem; z-index: 1;">
                                            <label class="form-label fw-bold text-dark small text-uppercase tracking-wider mb-3">Course Visuals</label>
                                            
                                            {{-- Thumbnail Preview --}}
                                            <div class="preview-container mb-4 shadow-sm rounded-4 overflow-hidden bg-white border">
                                                <div class="ratio ratio-16x9">
                                                    @if ($thumbnail)
                                                        <img src="{{ $thumbnail->temporaryUrl() }}" class="object-fit-cover">
                                                    @elseif($isEditing && $course_thumbnail_path)
                                                        <img src="{{ asset('storage/'.$course_thumbnail_path) }}" class="object-fit-cover">
                                                    @else
                                                        <div class="d-flex flex-column align-items-center justify-content-center bg-white h-100 text-muted opacity-50">
                                                            <i class="bi bi-image display-4"></i>
                                                            <p class="extra-small mt-2 fw-medium">16:9 Recommended</p>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            
                                            <input type="file" wire:model="thumbnail" class="form-control shadow-none border-2 fw-medium mb-4">
                                            
                                            {{-- Video Promo Path --}}
                                            <div class="mb-4">
                                                <label class="form-label fw-bold text-dark small text-uppercase tracking-wider">Promo Video URL/Path</label>
                                                <input type="text" wire:model="video_promo_path" class="form-control border-2 shadow-none" placeholder="Youtube link or file path">
                                            </div>

                                            <div class="p-3 rounded-4 bg-primary bg-opacity-10 border border-primary border-opacity-10">
                                                <div class="form-check form-switch mb-0">
                                                    <input class="form-check-input shadow-none" type="checkbox" role="switch" id="isPublished" wire:model="is_published">
                                                    <label class="form-check-label fw-medium text-primary small" for="isPublished">Publish Course Immediately</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- RIGHT: Data Workspace --}}
                                    <div class="col-lg-8 p-4 p-lg-5">
                                        {{-- General Info --}}
                                        <div class="row g-4 mb-5">
                                            <div class="col-12">
                                                <label class="form-label fw-bold text-dark small text-uppercase tracking-wider">Course Title</label>
                                                <input type="text" wire:model="title" class="form-control form-control-lg border-2 shadow-none fw-medium @error('title') is-invalid @enderror" placeholder="e.g. Master Laravel 12">
                                                @error('title') <div class="text-danger extra-small mt-2 fw-medium">{{ $message }}</div> @enderror
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label fw-bold text-dark small text-uppercase tracking-wider">Category</label>
                                                <select wire:model="category_id" class="form-select form-select-lg border-2 shadow-none fw-medium">
                                                    <option value="">Select Category</option>
                                                    @foreach($categories as $cat) <option value="{{ $cat->id }}">{{ $cat->name }}</option> @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label fw-bold text-dark small text-uppercase tracking-wider">Skill Level</label>
                                                <select wire:model="level" class="form-select form-select-lg border-2 shadow-none fw-medium">
                                                    <option value="beginner">Beginner</option>
                                                    <option value="intermediate">Intermediate</option>
                                                    <option value="advanced">Advanced</option>
                                                    <option value="all_levels">All Levels</option>
                                                </select>
                                            </div>
                                        </div>

                                        {{-- Pricing & Language --}}
                                    <div class="row g-4 mb-5">
                                        <div class="col-md-4">
                                            <label class="form-label fw-bold text-dark small text-uppercase tracking-wider">Price (₹)</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-white border-2 border-end-0 text-muted">₹</span>
                                                <input type="number" step="1" wire:model="price" class="form-control form-control-lg border-2 border-start-0 shadow-none fw-medium" placeholder="e.g. 499">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-bold text-dark small text-uppercase tracking-wider">Discount Price (₹)</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-white border-2 border-end-0 text-muted">₹</span>
                                                <input type="number" step="1" wire:model="discount_price" class="form-control form-control-lg border-2 border-start-0 shadow-none fw-medium" placeholder="e.g. 299">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-bold text-dark small text-uppercase tracking-wider">Language</label>
                                            <input type="text" wire:model="language" class="form-control form-control-lg border-2 shadow-none fw-medium" placeholder="e.g. Hindi or English">
                                        </div>
                                    </div>

                                        {{-- Descriptions --}}
                                        <div class="mb-4">
                                            <label class="form-label fw-bold text-dark small text-uppercase tracking-wider">Short Description (Summary)</label>
                                            <textarea wire:model="short_description" class="form-control border-2 shadow-none" rows="2" placeholder="Briefly describe the course..."></textarea>
                                        </div>

                                        <div class="mb-4">
                                            <label class="form-label fw-bold text-dark small text-uppercase tracking-wider">Full Description</label>
                                            <textarea wire:model="description" class="form-control border-2 shadow-none" rows="6" placeholder="Detailed curriculum breakdown..."></textarea>
                                        </div>

                                        {{-- SEO --}}
                                        <div class="mb-5">
                                            <label class="form-label fw-bold text-dark small text-uppercase tracking-wider">SEO Keywords (Meta)</label>
                                            <textarea wire:model="meta_keywords" class="form-control border-2 shadow-none" rows="2" placeholder="laravel, php, backend, coding..."></textarea>
                                        </div>

                                        <div class="d-flex flex-column flex-sm-row gap-3 pt-4 border-top">
                                            <button type="button" wire:click="{{ $isEditing ? 'cancelEdit' : 'toggleCreateMode' }}" class="btn btn-light btn-lg px-5 fw-medium text-muted border border-2 py-3 order-2 order-sm-1">Discard</button>
                                            <button type="submit" class="btn btn-primary btn-lg px-5 flex-grow-1 fw-medium shadow-sm py-3 border-0 order-1 order-sm-2">
                                                {{ $isEditing ? 'Save Changes' : 'Create Course' }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @else
            {{-- MODE: MANAGEMENT LIST (TABBED) --}}
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
                <div class="card-header bg-white border-0 pt-3 px-0">
                    <div class="d-flex border-bottom overflow-auto no-scrollbar px-4">
                        @foreach([2 => 'Published', 1 => 'Pending', 0 => 'Drafts'] as $val => $label)
                            @php $key = ($val == 2 ? 'published' : ($val == 1 ? 'pending' : 'draft')); @endphp
                            <button type="button" wire:click="setTab({{ $val }})" class="nav-tab border-0 bg-transparent pb-3 px-4 fw-medium text-nowrap {{ $status == $val ? 'active-tab' : 'text-muted' }}">
                                {{ $label }} <span class="badge {{ $status == $val ? 'bg-primary' : 'bg-light text-dark border' }} ms-1">{{ $counts[$key] ?? 0 }}</span>
                            </button>
                        @endforeach
                    </div>
                </div>

                <div class="card-body p-0">
                 <div class="list-group list-group-flush">
                    @forelse($courses as $course)
                        <div class="list-group-item p-3 p-md-4 hover-bg transition-all border-0 border-bottom">
                            <div class="row align-items-center g-3">
                                {{-- Thumbnail --}}
                                <div class="col-4 col-md-3 col-lg-2">
                                    <div class="ratio ratio-16x9 shadow-sm rounded-3 overflow-hidden border">
                                        <img src="{{ $course->thumbnail ? asset('storage/'.$course->thumbnail) : 'https://placehold.co/400x225?text=Preview' }}" class="object-fit-cover bg-light">
                                    </div>
                                </div>

                                {{-- Course Content --}}
                                <div class="col-8 col-md-6 col-lg-7">
                                    <h5 class="fw-bold text-dark mb-1 text-truncate">{{ $course->title }}</h5>
                                    
                                    {{-- Price Display --}}
                                    <div class="mb-2">
                                        @if($course->discount_price > 0 && $course->discount_price < $course->price)
                                            <span class="fw-bold text-primary fs-5">₹{{ number_format($course->discount_price, 2) }}</span>
                                            <span class="text-muted text-decoration-line-through small ms-2">₹{{ number_format($course->price, 2) }}</span>
                                        @elseif($course->price > 0)
                                            <span class="fw-bold text-dark fs-5">₹{{ number_format($course->price, 2) }}</span>
                                        @else
                                            <span class="badge bg-success bg-opacity-10 text-success fw-bold">FREE</span>
                                        @endif
                                    </div>

                                    {{-- Metadata Row 1 --}}
                                    <div class="d-flex align-items-center flex-wrap gap-2 gap-md-3 text-muted extra-small fw-normal mb-1">
                                        <span><i class="bi bi-tag me-1"></i>{{ $course->category->name }}</span>
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary border-0 text-uppercase">
                                            {{ str_replace('_', ' ', $course->level) }}
                                        </span>
                                        <span class="d-none d-sm-inline"><i class="bi bi-calendar3 me-1"></i>{{ $course->created_at->format('d M, Y') }}</span>
                                    </div>

                                    {{-- Metadata Row 2 --}}
                                    <div class="d-flex align-items-center flex-wrap gap-2 gap-md-3 text-muted extra-small fw-normal">
                                        <span><i class="bi bi-translate me-1"></i>{{ $course->language }}</span>
                                        <span><i class="bi bi-clock me-1"></i>{{ gmdate("H:i:s", $course->total_duration) }}</span>
                                        @if($course->is_published)
                                            <span class="text-success small"><i class="bi bi-patch-check-fill me-1"></i>Published</span>
                                        @else
                                            <span class="text-warning small"><i class="bi bi-pencil-fill me-1"></i>Draft</span>
                                        @endif
                                    </div>
                                </div>

                                {{-- Actions --}}
                                <div class="col-12 col-md-3 text-md-end">
                                    <div class="d-flex gap-2 justify-content-md-end">
                                        <button wire:click="editCourse({{ $course->id }})" class="btn btn-outline-primary btn-sm px-3 fw-medium flex-grow-1 flex-md-grow-0">
                                            <i class="bi bi-pencil-square me-1"></i> Edit
                                        </button>
                                        <button wire:click="deleteCourse({{ $course->id }})" class="btn btn-outline-danger btn-sm px-3 fw-medium flex-grow-1 flex-md-grow-0" onclick="return confirm('Delete permanently?')">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
    @empty
        <div class="text-center py-5">
            <i class="bi bi-journal-x display-1 text-light opacity-50 mb-3"></i>
            <h5 class="fw-medium text-dark">Workspace Empty</h5>
            <p class="text-muted small">No courses found in this category.</p>
        </div>
    @endforelse
</div>
                </div>
                @if($courses->hasPages())
                    <div class="card-footer bg-white border-0 p-4">{{ $courses->links() }}</div>
                @endif
            </div>
        @endif
    </div>

    <style>
        .instructor-dashboard-wrapper { background-color: #f8f9fa; min-height: 100vh; font-family: 'Inter', sans-serif; }
        .fw-medium { font-weight: 500 !important; }
        .extra-small { font-size: 0.72rem; }
        .tracking-wider { letter-spacing: 0.05rem; }
        .hover-bg:hover { background-color: #fcfdfe; }
        .transition-all { transition: all 0.2s ease; }
        .nav-tab { font-size: 0.9rem; border-bottom: 3px solid transparent !important; cursor: pointer; transition: all 0.3s ease; }
        .active-tab { border-bottom: 3px solid #0d6efd !important; color: #0d6efd !important; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        
        /* Form Styling */
        .form-control-lg, .form-select-lg { font-size: 0.9rem; padding: 0.75rem 1rem; border-radius: 0.6rem; border-width: 2px; }
        .form-control:focus, .form-select:focus { border-color: #0d6efd; background-color: #f8faff; box-shadow: none; }
        
        @media (max-width: 768px) {
            .container-fluid { px: 3; }
            .btn-lg { font-size: 1rem; padding: 1rem; }
        }
    </style>
</div>