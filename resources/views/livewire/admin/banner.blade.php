<div class="banner-management-wrapper">
    {{-- Toast Notifications --}}
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 1060;">
        @if (session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show shadow-lg border-0 rounded-3">
                <div class="d-flex align-items-center">
                    <i class="bi bi-check-circle-fill me-2 fs-5"></i>
                    <div>{{ session('message') }}</div>
                    <button type="button" class="btn-close ms-3" data-bs-dismiss="alert"></button>
                </div>
            </div>
        @endif
    </div>

    <div class="container-fluid py-4">
        {{-- Unified Control Panel Card --}}
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            
            {{-- Professional Header Section --}}
            <div class="card-header bg-white border-0 p-4">
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-primary bg-opacity-10 p-3 rounded-3 me-3 text-primary">
                        <i class="bi bi-collection-play fs-3"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold text-dark mb-0">Banner Management</h4>
                        <p class="text-muted small mb-0">Visual Slider & Promotional Content Control</p>
                    </div>
                </div>

                {{-- Nested Navigation Tabs --}}
                <ul class="nav nav-tabs border-0 gap-2 mt-2">
                    <li class="nav-item">
                        <button class="nav-link border-0 rounded-3 px-4 py-2 fw-semibold {{ $activeTab == 'manage' ? 'active bg-light' : 'text-muted' }}" 
                                wire:click="switchTab('manage')">
                            <i class="bi bi-list-ul me-2"></i>Banners List
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link border-0 rounded-3 px-4 py-2 fw-semibold {{ in_array($activeTab, ['add', 'form', 'edit']) ? 'active bg-light' : 'text-muted' }}" 
                                wire:click="switchTab('form')">
                            <i class="bi {{ $editing_id ? 'bi-pencil-square' : 'bi-plus-circle' }} me-2"></i>
                            {{ $editing_id ? 'Edit Banner' : 'Add New Banner' }}
                        </button>
                    </li>
                </ul>
            </div>

            <div class="card-body p-0">
                @if($activeTab == 'manage')
                    {{-- Section: Banners List --}}
                    <div class="table-responsive">
                        <table class="table align-middle mb-0 custom-table">
                            <thead class="bg-light text-uppercase small letter-spacing-1">
                                <tr>
                                    <th class="ps-4 py-3">ID / Preview</th>
                                    <th>Title & Description</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Priority</th>
                                    <th class="text-center">Call to Action</th>
                                    <th class="pe-4 text-end">Timestamp</th>
                                    <th class="pe-4 text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($banners as $banner)
                                    <tr wire:key="banner-{{ $banner->id }}">
                                        <td class="ps-4 py-3">
                                            <div class="d-flex align-items-center">
                                                <span class="text-muted small me-3">#{{ $banner->id }}</span>
                                                <img src="{{ asset('Storage/' . $banner->image) }}" 
                                                     class="rounded-3 border object-fit-cover shadow-xs" 
                                                     width="100" height="50">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="fw-bold text-dark">{{ $banner->title ?? 'No Title' }}</div>
                                            <div class="text-primary small text-lowercase">{{ $banner->button_url }}</div>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-check form-switch d-inline-block">
                                                <input class="form-check-input custom-switch" type="checkbox" 
                                                    {{ $banner->status ? 'checked' : '' }}
                                                    wire:click="toggleStatus({{ $banner->id }})">
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-light text-dark border px-3">{{ $banner->button_text }} </span>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-light text-dark border px-3">P-{{ $banner->order_priority }}</span>
                                        </td>
                                        <td class="text-center">
                                            <div class="x-small text-muted" title="Created At">
                                                <i class="bi bi-clock me-1"></i>{{ $banner->created_at->format('M d, Y') }}
                                            </div>
                                            <div class="x-small text-primary mt-1" title="Last Updated">
                                                <i class="bi bi-arrow-repeat me-1"></i>{{ $banner->updated_at->diffForHumans() }}
                                            </div>
                                        </td>
                                        
                                        <td class="pe-4 text-end">
                                            <button wire:click="edit({{ $banner->id }})" class="btn btn-link text-dark p-1">
                                                <i class="bi bi-pencil fs-5"></i>
                                            </button>
                                            <button onclick="confirm('Delete this banner?') || event.stopImmediatePropagation()" 
                                                    wire:click="delete({{ $banner->id }})" class="btn btn-link text-danger p-1">
                                                <i class="bi bi-trash fs-5"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-5 text-muted">No banners found. Start by adding one.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                @else
                    {{-- Section: Add / Edit Form --}}
                    <div class="p-4 p-md-5 animate__animated animate__fadeIn">
                        <form wire:submit.prevent="store">
                            <div class="row g-4">
                                <div class="col-lg-5">
                                    <label class="form-label fw-bold">Banner Media</label>
                                    <div class="drop-zone rounded-4 border-dashed bg-light p-4 text-center">
                                        @if ($image)
                                            <img src="{{ $image->temporaryUrl() }}" class="img-fluid rounded-3 mb-3 shadow">
                                        @elseif ($old_image)
                                            <img src="{{ asset('Storage/' . $old_image) }}" class="img-fluid rounded-3 mb-3 shadow">
                                        @endif
                                        <input type="file" wire:model="image" class="form-control form-control-sm mt-2">
                                        <p class="x-small text-muted mt-2">Max Size: 2MB | Suggested Ratio: 16:9</p>
                                    </div>
                                </div>

                                <div class="col-lg-7">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label class="form-label fw-bold small">Heading Title</label>
                                            <input type="text" wire:model="title" class="form-control rounded-3 border-light bg-light">
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label fw-bold small">Slider Description</label>
                                            <textarea wire:model="subtitle" class="form-control rounded-3 border-light bg-light" rows="3"></textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold small">Button Text</label>
                                            <input type="text" wire:model="button_text" class="form-control rounded-3 border-light bg-light">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold small">Action URL</label>
                                            <input type="url" wire:model="button_url" class="form-control rounded-3 border-light bg-light">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold small">Order Priority</label>
                                            <input type="number" wire:model="order_priority" class="form-control rounded-3 border-light bg-light">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold small">Status</label>
                                            <select wire:model="status" class="form-select rounded-3 border-light bg-light">
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 pt-4 border-top mt-4 text-end">
                                    <button type="button" wire:click="switchTab('manage')" class="btn btn-light rounded-pill px-4 me-2">Cancel</button>
                                    <button type="submit" class="btn btn-primary rounded-pill px-5 fw-bold shadow">
                                        <span wire:loading.remove>{{ $editing_id ? 'Update Changes' : 'Publish Banner' }}</span>
                                        <span wire:loading>Saving...</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>