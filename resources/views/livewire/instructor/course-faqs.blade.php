<div>
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
      <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 p-3 rounded-3 me-3">
                        <i class="bi bi-chat-quote-fill text-primary fs-4"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-1">Course FAQs Management</h4>
                        <p class="text-muted mb-0 small">Review and manage student questions across your curriculum shells here.</p>
                    </div>
                </div>

                @if (session()->has('message'))
                    <div class="alert alert-success py-2 px-3 mb-0 small border-0 shadow-sm">
                        <i class="bi bi-check-circle-fill me-1"></i> {{ session('message') }}
                    </div>
                @endif
            </div>
        </div>
    </div>

        <ul class="nav nav-tabs mb-3" id="faqTabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#approved">
                    <i class="bi bi-check-circle me-1"></i> Approved FAQs
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#pending">
                    <i class="bi bi-clock-history me-1"></i> Pending Requests 
                    <span class="badge bg-danger ms-1">{{ count($pendingFaqs) }}</span>
                </a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade show active" id="approved">
                <div class="card shadow-sm">
                    <div class="card-body p-0">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-3">Course</th>
                                    <th>Question & Answer</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($approvedFaqs as $faq)
                                    <tr>
                                        <td class="ps-3 align-middle">
                                            <span class="fw-semibold text-primary">{{ $faq->course->title ?? 'N/A' }}</span>
                                        </td>
                                        <td>
                                            <div class="fw-bold text-dark">Q: {{ $faq->question }}</div>
                                            <div class="text-muted small">A: {{ $faq->answer }}</div>
                                        </td>
                                        <td class="text-center align-middle">
                                            <span class="badge bg-success-subtle text-success border border-success">Approved</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-4 text-muted">No approved FAQs found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="pending">
                <div class="card shadow-sm">
                    <div class="card-body p-0">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-3">Course</th>
                                    <th>Question</th>
                                    <th width="300">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pendingFaqs as $faq)
                                    <tr>
                                        <td class="ps-3 align-middle text-primary fw-semibold">
                                            {{ $faq->course->title ?? 'N/A' }}
                                        </td>
                                        <td class="align-middle">{{ $faq->question }}</td>
                                        <td class="align-middle">
                                            <button class="btn btn-primary btn-sm px-3" 
                                                wire:click="reply({{ $faq->id }})" 
                                                data-bs-toggle="modal" data-bs-target="#answerModal">
                                                <i class="bi bi-chat-left-text me-1"></i> Reply & Approve
                                            </button>
                                            <button class="btn btn-outline-danger btn-sm" 
                                                wire:click="reject({{ $faq->id }})"
                                                onclick="confirm('Are you sure?') || event.stopImmediatePropagation()">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-4 text-muted">No pending questions.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div wire:ignore.self class="modal fade" id="answerModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Reply to Question</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Answer</label>
                            <textarea wire:model="answer" class="form-control" rows="4" placeholder="Enter the official answer..."></textarea>
                            @error('answer') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" wire:click="approve" data-bs-dismiss="modal">Save & Approve</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>