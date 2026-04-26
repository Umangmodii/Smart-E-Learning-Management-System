<div>

    <!-- Breadcrumb -->
    <x-slot name="breadcrumbSlot">
        <nav class="py-2 bg-light border-bottom mb-4">
            <div class="container">
                <ol class="breadcrumb mb-0 small">
                    @foreach($breadcrumbs as $item)
                        <li class="breadcrumb-item {{ $loop->last ? 'active fw-bold' : '' }}">
                            @if($item['url'] && !$loop->last)
                                <a href="{{ $item['url'] }}">{{ $item['label'] }}</a>
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

        <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden">
            <div class="card-body p-4">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">

                    <div class="d-flex align-items-center">
                        <div class="bg-success bg-opacity-10 p-3 rounded-3 me-3">
                            <i class="bi bi-people-fill text-success fs-2"></i>
                        </div>
                        <div>
                            <h4 class="fw-medium text-dark mb-1">Course Enrollments</h4>
                            <p class="text-muted small mb-0">
                                Manage and track students enrolled in your courses.
                            </p>
                        </div>
                    </div>

                    <div class="text-md-end">
                        <span class="badge bg-dark px-3 py-2">
                            Total: {{ count($enrollments) }}
                        </span>
                    </div>

                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-0">

                <div class="table-responsive">
                    <table class="table table-hover align-middle text-center mb-0">

                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Student</th>
                                <th>Email</th>
                                <th>Course</th>
                                <th>Level</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($enrollments as $key => $enrollment)
                                <tr>

                                    <td>{{ $key + 1 }}</td>

                                    <td class="fw-semibold">
                                        {{ $enrollment->user->name ?? '-' }}
                                    </td>

                                    <td class="text-muted small">
                                        {{ $enrollment->user->email ?? '-' }}
                                    </td>

                                    <td>
                                        <span class="badge bg-primary px-3 py-2">
                                            {{ $enrollment->course->title ?? '-' }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="badge bg-info text-dark px-3 py-2">
                                            {{ ucfirst($enrollment->course->level ?? '-') }}
                                        </span>
                                    </td>

                                    <td>
                                        @if($enrollment->status == 'active')
                                            <span class="badge bg-success px-3 py-2">Active</span>
                                        @else
                                            <span class="badge bg-secondary px-3 py-2">
                                                {{ ucfirst($enrollment->status) }}
                                            </span>
                                        @endif
                                    </td>

                                    <td class="small text-muted">
                                        {{ \Carbon\Carbon::parse($enrollment->created_at)->format('d M Y') }}
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="py-4 text-muted">
                                        No enrollments found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>

            </div>
        </div>

    </div>
</div>