<div class="modal fade" id="createCourseModal" tabindex="-1" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content rounded-0 border-0 shadow-lg">
            <div class="modal-header border-0 pb-0">
                <h5 class="fw-bold px-3 pt-3">Step 1: Basic Course Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form wire:submit.prevent="storeCourse">
                    <div class="mb-4">
                        <label class="fw-bold small text-uppercase mb-2">What is the title of your course?</label>
                        <input type="text" wire:model="title" class="form-control form-control-lg rounded-0 border-dark" placeholder="e.g. Learn Python from Scratch">
                        @error('title') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="fw-bold small text-uppercase mb-2">Under which category does this fit?</label>
                        <select wire:model="category_id" class="form-select form-control-lg rounded-0 border-dark">
                            <option value="">Choose a Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="fw-bold small text-uppercase mb-2">Course Thumbnail</label>
                        <input type="file" wire:model="thumbnail" class="form-control rounded-0">
                        <div class="form-text">Professional courses use 1280x720px images.</div>
                        @error('thumbnail') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <div class="text-end mt-5 pt-3 border-top">
                        <button type="button" class="btn btn-light rounded-0 px-4 me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-dark rounded-0 px-5">
                            <span wire:loading.remove>Create Draft</span>
                            <span wire:loading>Processing...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>