<div>
    @include('livewire.admin.partials.side-top-layout', ['title' => 'About Us'])

    <div class="main-content py-4">
        <!-- Session Messages -->
        @if (session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm border-0" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Form Card -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 fw-bold text-primary">
                    <i class="bi {{ $updateMode ? 'bi-pencil-square' : 'bi-plus-circle' }} me-2"></i>
                    {{ $updateMode ? 'Update About Content' : 'Create New About Content' }}
                </h5>
            </div>
            <div class="card-body p-4">
                <form wire:submit.prevent="{{ $updateMode ? 'update' : 'store' }}">
                    <div class="row g-4">
                        <!-- Hero Image Section -->
                        <div class="col-md-4">
                            <div class="image-upload-wrapper border rounded-3 p-3 text-center bg-light">
                                <label class="form-label d-block fw-semibold">Hero Background Image</label>
                                <div class="mb-3">
                                    @if ($hero_bg_image)
                                        <img src="{{ $hero_bg_image->temporaryUrl() }}"
                                            class="img-thumbnail shadow-sm rounded-3"
                                            style="max-height: 150px; width: 100%; object-fit: cover;">
                                    @elseif ($existing_hero_bg_image)
                                        <img src="{{ asset('storage/aboutus/' . $existing_hero_bg_image) }}"
                                            class="img-thumbnail shadow-sm rounded-3"
                                            style="max-height: 150px; width: 100%; object-fit: cover;">
                                    @else
                                        <div class="py-4 text-muted border border-dashed rounded-3">
                                            <i class="bi bi-image fs-1 d-block"></i>
                                            <small>No image selected</small>
                                        </div>
                                    @endif
                                </div>
                                <input type="file" class="form-control form-control-sm"
                                    id="upload{{ $updateMode }}" wire:model="hero_bg_image">
                                <div wire:loading wire:target="hero_bg_image" class="mt-2 small text-info">
                                    <span class="spinner-border spinner-border-sm"></span> Uploading...
                                </div>
                                @error('hero_bg_image')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Main Text Fields -->
                        <div class="col-md-8">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Main Heading</label>
                                    <input type="text" class="form-control shadow-none border-secondary-subtle"
                                        placeholder="Enter About Us Heading" wire:model="about_heading">
                                    @error('about_heading')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Left Column (Small Description)</label>
                                    <textarea class="form-control shadow-none" rows="4" placeholder="Brief intro..." wire:model="small_descri"></textarea>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Right Column (Full Description)</label>
                                    <textarea class="form-control shadow-none" rows="4" placeholder="Detailed content..."
                                        wire:model="about_full_desc"></textarea>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4 opacity-50">

                        <!-- Mission & Vision -->
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded-3 h-100">
                                <label class="form-label fw-bold text-dark"><i class="bi bi-bullseye me-2"></i>Our
                                    Mission</label>
                                <textarea class="form-control border-0 shadow-none" rows="3" placeholder="Define the mission..."
                                    wire:model="mission_description"></textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded-3 h-100">
                                <label class="form-label fw-bold text-dark"><i class="bi bi-eye me-2"></i>Our
                                    Vision</label>
                                <textarea class="form-control border-0 shadow-none" rows="3" placeholder="Define the vision..."
                                    wire:model="vision_description"></textarea>
                            </div>
                        </div>

                        <!-- Footer Controls -->
                        <div class="col-12 d-flex align-items-center justify-content-between mt-4">
                            <div class="d-flex align-items-center gap-2">
                                <label class="fw-semibold me-2">Status:</label>
                                <select class="form-select form-select-sm w-auto shadow-none" wire:model="status">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            <div class="gap-2 d-flex">
                                <button type="button" wire:click="resetInputFields"
                                    class="btn btn-outline-secondary px-4">
                                    <i class="bi bi-arrow-counterclockwise"></i> Reset
                                </button>
                                <button type="submit" class="btn btn-primary px-5 shadow-sm">
                                    <i class="bi bi-save me-1"></i> {{ $updateMode ? 'Update Changes' : 'Save Record' }}
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Table Card -->
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold text-secondary">Manage Records</h5>
                <span class="badge bg-soft-primary text-primary px-3">{{ $records->total() }} Total Records</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light text-muted">
                            <tr>
                                <th class="ps-4">#ID</th>
                                <th>Hero Preview</th>
                                <th>Heading Content</th>
                                <th class="text-center">Status</th>
                                <th class="text-end pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($records as $record)
                                <tr>
                                    <td class="ps-4 fw-bold">#{{ $record->id }}</td>
                                    <td>
                                        @if ($record->hero_bg_image)
                                            <img src="{{ asset('storage/aboutus/' . $record->hero_bg_image) }}"
                                                class="rounded shadow-sm" width="80" height="45"
                                                style="object-fit: cover;">
                                        @else
                                            <span class="text-muted small">No Image</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="fw-bold">{{ Str::limit($record->about_heading, 40) }}</div>
                                        <div class="text-muted x-small" style="font-size: 12px;">
                                            {{ Str::limit($record->small_descri, 60) }}</div>
                                    </td>
                                    <td class="text-center">
                                        @if ($record->status)
                                            <span
                                                class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3">Active</span>
                                        @else
                                            <span
                                                class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-3">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="text-end pe-4">
                                        <div class="btn-group shadow-sm">
                                            <button wire:click="edit({{ $record->id }})"
                                                class="btn btn-sm btn-white border shadow-none" title="Edit">
                                                <i class="bi bi-pencil text-info"></i>
                                            </button>
                                            <button wire:click="delete({{ $record->id }})"
                                                onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
                                                class="btn btn-sm btn-white border shadow-none" title="Delete">
                                                <i class="bi bi-trash text-danger"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted fst-italic">No records
                                        found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-white border-0 py-3">
                {{ $records->links() }}
            </div>
        </div>
    </div>


</div>
