<div>
    <x-slot name="breadcrumbSlot">
        <nav class="py-2 bg-light border-bottom mb-4">
            <div class="container">
                <ol class="breadcrumb mb-0 small">
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
            </div>
        </nav>
    </x-slot>

    <div class="container">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                    <div class="d-flex align-items-center">
                        <div class="bg-warning bg-opacity-10 p-3 rounded-3 me-3">
                            <i class="bi bi-star-fill text-warning fs-4"></i>
                        </div>
                        <div>
                            <h4 class="fw-bold mb-1">Course Reviews</h4>
                            <p class="text-muted mb-0 small">Monitor and manage student feedback for your published courses.</p>
                        </div>
                    </div>

                    <div class="btn-group p-1 bg-light rounded-pill">
                        <button wire:click="$set('status', 'pending')" 
                            class="btn rounded-pill btn-sm px-4 {{ $status == 'pending' ? 'btn-white shadow-sm fw-bold' : 'btn-light text-muted' }}">
                            Pending
                        </button>
                        <button wire:click="$set('status', 'approved')" 
                            class="btn rounded-pill btn-sm px-4 {{ $status == 'approved' ? 'btn-white shadow-sm fw-bold' : 'btn-light text-muted' }}">
                            Approved
                        </button>
                    </div>
                </div>
            </div>
        </div>

        @if(session()->has('success'))
            <div class="alert alert-success border-0 shadow-sm d-flex align-items-center mb-4">
                <i class="bi bi-check-circle-fill me-2"></i>
                <div>{{ session('success') }}</div>
            </div>
        @endif

        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light border-bottom">
                            <tr>
                                <th class="ps-4 py-3 text-muted small fw-bold text-uppercase">Course & Student</th>
                                <th class="py-3 text-muted small fw-bold text-uppercase">Rating</th>
                                <th class="py-3 text-muted small fw-bold text-uppercase">Review Content</th>
                                <th class="py-3 text-muted small fw-bold text-uppercase text-center">Status</th>
                                <th class="pe-4 py-3 text-muted small fw-bold text-uppercase text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($reviews as $review)
                                <tr>
                                    <td class="ps-4">
                                        <div class="fw-bold text-dark">{{ $review->course->title ?? 'Untitled Course' }}</div>
                                        <div class="text-muted small"><i class="bi bi-person me-1"></i>{{ $review->user->name ?? 'Guest' }}</div>
                                    </td>
                                    <td>
                                        <div class="text-warning d-flex gap-1">
                                            @for($i=1; $i<=5; $i++)
                                                <i class="bi {{ $i <= $review->rating ? 'bi-star-fill' : 'bi-star text-muted opacity-25' }}"></i>
                                            @endfor
                                        </div>
                                        <span class="badge bg-light text-dark border mt-1 fw-normal">{{ $review->rating }}.0</span>
                                    </td>
                                    <td style="max-width: 300px;">
                                        <p class="mb-0 small text-secondary text-truncate-2">{{ $review->review }}</p>
                                    </td>
                                    <td class="text-center">
                                        @if($review->status)
                                            <span class="badge rounded-pill bg-success-subtle text-success border border-success px-3">Approved</span>
                                        @else
                                            <span class="badge rounded-pill bg-warning-subtle text-warning border border-warning px-3">Pending</span>
                                        @endif
                                    </td>
                                    <td class="pe-4 text-end">
                                        <div class="btn-group">
                                            @if(!$review->status)
                                                <button class="btn btn-sm btn-outline-success" wire:click="approve({{ $review->id }})" title="Approve">
                                                    <i class="bi bi-check-lg"></i>
                                                </button>
                                            @else
                                                <button class="btn btn-sm btn-outline-warning" wire:click="reject({{ $review->id }})" title="Set to Pending">
                                                    <i class="bi bi-arrow-counterclockwise"></i>
                                                </button>
                                            @endif
                                            <button class="btn btn-sm btn-outline-danger" 
                                                wire:click="delete({{ $review->id }})"
                                                onclick="confirm('Are you sure you want to delete this feedback?') || event.stopImmediatePropagation()">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" width="60" class="opacity-25 mb-3 d-block mx-auto">
                                        <span class="text-muted">No reviews found in this category.</span>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <style>
        .btn-white { background: white; border: none; }
        .text-truncate-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</div>