<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold"><i class="bi bi-person-plus text-primary me-2"></i> Instructor Applications</h4>
        <span class="badge bg-soft-primary text-primary px-3 py-2">
            Total Pending: {{ $instructors->count() }}
        </span>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 py-3">Instructor</th>
                            <th class="py-3">Headline & Expertise</th>
                            <th class="py-3">Applied Date</th>
                            <th class="py-3 text-center">Status</th>
                            <th class="py-3 text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($instructors as $instructor)
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                        {{ strtoupper(substr($instructor->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <h6 class="mb-0 fw-semibold">{{ $instructor->name }}</h6>
                                        <small class="text-muted">{{ $instructor->email }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="fw-medium text-dark">{{ 'No Headline' }}</div>
                                <a href="" target="_blank" class="text-primary small text-decoration-none">
                                    <i class="bi bi-link-45deg"></i> Portfolio
                                </a>
                            </td>
                            <td>
                                <div class="small">{{ $instructor->created_at->format('M d, Y') }}</div>
                                <div class="text-muted extra-small">{{ $instructor->created_at->diffForHumans() }}</div>
                            </td>
                            <td class="text-center">
                                <span class="badge rounded-pill bg-warning text-dark px-3">
                                    <i class="bi bi-clock me-1"></i> Pending
                                </span>
                            </td>
                            <td class="text-end pe-4">
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-outline-primary me-2" wire:click="viewDetails({{ $instructor->id }})">
                                        Review
                                    </button>
                                    
                                    <button class="btn btn-sm btn-light border dropdown-toggle" data-bs-toggle="dropdown">
                                        Manage
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                                        <li>
                                            <button class="dropdown-item text-success" wire:click="approve({{ $instructor->id }})">
                                                <i class="bi bi-check-lg me-2"></i> Approve
                                            </button>
                                        </li>
                                        <li>
                                            <button class="dropdown-item text-danger" wire:click="openRejectModal({{ $instructor->id }})">
                                                <i class="bi bi-x-lg me-2"></i> Reject
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-1 d-block mb-3"></i>
                                No new instructor applications found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>