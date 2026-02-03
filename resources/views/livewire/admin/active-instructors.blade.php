<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div class="bg-success bg-opacity-10 p-2 rounded-3 me-3">
                <i class="bi bi-patch-check-fill text-success fs-3"></i>
            </div>
            <h3 class="fw-bold text-dark mb-0">Approved Instructors</h3>
            <span class="badge bg-success px-3 py-2 rounded-pill">Total Active: {{ $instructors->total() }}</span>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-muted small text-uppercase">
                        <tr>
                            <th class="ps-4">Instructor Name</th>
                            <th>Email Address</th>
                            <th>Approval Date</th>
                            <th>Status</th>
                            <th class="text-end pe-4">Verification</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($instructors as $instructor)
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($instructor->name) }}&background=E8F5E9&color=2E7D32" 
                                         class="rounded-circle me-3" width="40" height="40">
                                    <div>
                                        <div class="fw-bold">{{ $instructor->name }}</div>
                                        <small class="text-muted">ID: #INST-{{ $instructor->id }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $instructor->email }}</td>
                            <td>{{ $instructor->updated_at->format('M d, Y') }}</td>
                            <td>
                                <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-3">
                                    <i class="bi bi-check-circle-fill me-1"></i> Active
                                </span>
                            </td>
                            <td class="text-end pe-4">
                                <span class="text-success small fw-bold">Verified Educator</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <img src="{{ asset('images/no-data.png') }}" alt="No data" width="100" class="mb-3 opacity-50">
                                <p class="text-muted">No instructors have been approved yet.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($instructors->hasPages())
            <div class="card-footer bg-white border-0 py-3">
                {{ $instructors->links() }}
            </div>
        @endif
    </div>
</div>