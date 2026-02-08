<div class="d-flex flex-grow-1 mx-lg-4 my-2 my-lg-0 position-relative" style="max-width: 700px;">
    <div class="input-group custom-search-group w-100 shadow-sm rounded-pill overflow-hidden border border-dark">
        <span class="input-group-text bg-white border-0 ps-3">
            <i class="bi bi-search text-muted"></i>
        </span>
        <input 
            wire:model.live.debounce.300ms="search"
            class="form-control bg-white border-0 py-2 shadow-none" 
            type="search" 
            placeholder="Search for anything..." 
            style="height: 46px; font-size: 0.95rem;">
    </div>

    @if(strlen($search) >= 2)
        <div class="position-absolute w-100 shadow-lg bg-white rounded-3 border mt-2 overflow-hidden" 
             style="z-index: 2000; top: 100%; left: 0;">
            
            <div wire:loading wire:target="search" class="p-0">
                @for($i = 0; $i < 3; $i++)
                    <div class="d-flex align-items-center p-3 border-bottom">
                        <div class="shimmer-box animate-shimmer rounded me-3" style="width: 64px; height: 42px; flex-shrink: 0;"></div>
                        <div class="flex-grow-1">
                            <div class="shimmer-line animate-shimmer w-75 mb-2"></div>
                            <div class="shimmer-line animate-shimmer w-25"></div>
                        </div>
                    </div>
                @endfor
            </div>

            <div wire:loading.remove wire:target="search">
                @forelse($results as $course)
                    <a href="{{ route('course-details', ['category_slug' => $course->category->slug, 'course_slug' => $course->slug]) }}" 
                       class="d-flex align-items-center p-3 border-bottom text-decoration-none search-item-hover transition-all">
                        
                        <img src="{{ asset('storage/'.$course->thumbnail) }}" 
                             class="rounded me-3 border shadow-sm" 
                             style="width: 64px; height: 42px; object-fit: cover;">
                        
                        <div class="overflow-hidden">
                            <div class="fw-bold text-dark small text-truncate mb-0">{{ $course->title }}</div>
                            <div class="text-muted extra-small d-flex align-items-center mt-1">
                                <span class="badge bg-light text-dark border me-2">{{ $course->category->name }}</span>
                                <span class="small">By {{ $course->instructor->name ?? 'Expert' }}</span>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="p-4 text-center text-muted small">No results for "{{ $search }}"</div>
                @endforelse
            </div>
        </div>
    @endif

    <style>
        .search-item-hover:hover { background-color: #f7f9fa; }
        .extra-small { font-size: 0.72rem; }
        
        .shimmer-box { background: #eee; }
        .shimmer-line { height: 10px; background: #eee; border-radius: 4px; }
        
        .animate-shimmer {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: search-skeleton 1.5s infinite linear;
        }

        @keyframes search-skeleton {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }
    </style>
</div>