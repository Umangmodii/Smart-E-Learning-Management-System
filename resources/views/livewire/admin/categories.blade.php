<div>

    {{-- Toast Alerts --}}
    <div class="position-fixed top-0 end-0 p-2" style="z-index: 1055;">
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm small d-flex align-items-center">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('success') }}
                <button class="btn-close ms-auto" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show shadow-sm small d-flex align-items-center">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                {{ session('error') }}
                <button class="btn-close ms-auto" data-bs-dismiss="alert"></button>
            </div>
        @endif
    </div>

    <div class="container-fluid py-3">

        {{-- Header --}}
        <div class="card shadow-sm border-0 mb-3">
            <div class="card-body py-3 d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-primary bg-opacity-10 p-2 rounded">
                        <i class="bi bi-grid-3x3-gap-fill text-primary"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 fw-semibold">Category Management</h6>
                        <small class="text-muted">Hierarchy Control Panel</small>
                    </div>
                </div>
            </div>
        </div>

        {{-- Main Card --}}
        <div class="card shadow-sm border-0">

            {{-- Tabs --}}
            <div class="card-header bg-white border-0 px-3 pt-3">
                <ul class="nav nav-tabs flex-nowrap overflow-auto small gap-1">
                    <li class="nav-item">
                        <button
                            class="nav-link px-3 py-2 fw-semibold {{ $activeTab == 'manage' ? 'active' : '' }}"
                            wire:click="switchTab('manage')">
                            <i class="bi bi-diagram-3 me-1"></i>
                            <span class="d-none d-sm-inline">Categories List</span>
                            <span class="d-inline d-sm-none">List</span>
                        </button>
                    </li>

                    <li class="nav-item">
                        <button
                            class="nav-link px-3 py-2 fw-semibold {{ $activeTab == 'add' ? 'active' : '' }}"
                            wire:click="switchTab('add')">
                            <i class="bi bi-plus-square me-1"></i>
                            <span class="d-none d-sm-inline">Add Category</span>
                            <span class="d-inline d-sm-none">Add</span>
                        </button>
                    </li>

                    @if($activeTab == 'edit')
                        <li class="nav-item">
                            <button class="nav-link active px-3 py-2 fw-semibold text-warning">
                                <i class="bi bi-pencil-square me-1"></i>
                                Edit
                            </button>
                        </li>
                    @endif
                </ul>
            </div>

            {{-- Content --}}
            <div class="card-body p-0">

                {{-- MANAGE TAB --}}
                @if($activeTab == 'manage')

                    <div class="table-responsive">
                        <table class="table table-sm table-hover align-middle mb-0 small">
                            <thead class="table-light text-uppercase text-muted fw-semibold">
                                <tr>
                                    <th class="ps-3">ID / Name</th>
                                    <th class="d-none d-md-table-cell">URL</th>
                                    <th class="text-center d-none d-sm-table-cell">Status</th>
                                    <th class="text-end pe-3">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($categories as $category)
                                    <tr>
                                        <td class="ps-3">
                                            <span class="text-muted me-1">#{{ $category->id }}</span>
                                            {{ $category->name }}
                                        </td>

                                        <td class="d-none d-md-table-cell">
                                            <code>categories/course/{{ $category->slug }}</code>
                                        </td>

                                        <td class="text-center d-none d-sm-table-cell">
                                            <div class="form-check form-switch d-inline-block">
                                                <input
                                                    class="form-check-input"
                                                    type="checkbox"
                                                    {{ $category->status ? 'checked' : '' }}
                                                    wire:click="toggleStatus({{ $category->id }})">
                                            </div>
                                        </td>

                                        <td class="text-end pe-3">
                                            <div class="btn-group btn-group-sm">
                                                <button
                                                    wire:click="edit({{ $category->id }})"
                                                    class="btn btn-light">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <button class="btn btn-light text-danger">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    {{-- Children --}}
                                    @foreach($category->children as $child)
                                        <tr class="table-light">
                                            <td class="ps-4">
                                                <i class="bi bi-arrow-return-right me-1 text-muted"></i>
                                                {{ $child->name }}
                                            </td>
                                            <td class="d-none d-md-table-cell">
                                                <code>categories/course/{{ $category->slug }}/{{ $child->slug }}</code>
                                            </td>
                                            <td class="text-center d-none d-sm-table-cell">—</td>
                                            <td class="text-end pe-3">
                                                <button
                                                    wire:click="edit({{ $child->id }})"
                                                    class="btn btn-sm btn-link text-muted p-0 me-2">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach

                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-4 text-muted">
                                            No categories found
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                {{-- ADD / EDIT TAB --}}
                @else

                    <div class="p-3 p-lg-4">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">

                                <div class="card border shadow-sm">
                                    <div class="card-body">

                                        <h6 class="fw-semibold mb-3">
                                            <i class="bi {{ $editing_id ? 'bi-pencil-square text-warning' : 'bi-plus-circle text-primary' }} me-1"></i>
                                            {{ $editing_id ? 'Update Category' : 'Create Category' }}
                                        </h6>

                                        <form wire:submit.prevent="store">

                                            <div class="mb-3">
                                                <label class="form-label small fw-semibold">Category Name</label>
                                                <input
                                                    type="text"
                                                    wire:model.live="name"
                                                    class="form-control form-control-sm bg-light border-0">
                                                @error('name')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <label class="form-label small fw-semibold">Parent Category</label>
                                                    <select
                                                        wire:model.live="parent_id"
                                                        class="form-select form-select-sm bg-light border-0">
                                                        <option value="">Root Category</option>
                                                        @foreach($parentCategories as $parent)
                                                            <option value="{{ $parent->id }}">
                                                                {{ $parent->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="form-label small fw-semibold">Order</label>
                                                    <input
                                                        type="number"
                                                        wire:model="order_priority"
                                                        class="form-control form-control-sm bg-light border-0">
                                                </div>
                                            </div>

                                            {{-- Preview --}}
                                            <div class="alert alert-light border mt-3 small">
                                                <strong>Preview:</strong><br>
                                                categories/course/
                                                {{ $parent_id ? $this->parent_slug.'/' : '' }}
                                                {{ \Illuminate\Support\Str::slug($name ?: 'category') }}
                                            </div>

                                            <div class="text-end mt-3">
                                                <button class="btn btn-primary btn-sm px-4 fw-semibold">
                                                    {{ $editing_id ? 'Update' : 'Save' }}
                                                </button>

                                                @if($editing_id)
                                                    <button
                                                        type="button"
                                                        wire:click="switchTab('manage')"
                                                        class="btn btn-link btn-sm text-muted ms-2">
                                                        Cancel
                                                    </button>
                                                @endif
                                            </div>

                                        </form>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                @endif

            </div>
        </div>
    </div>
</div>
