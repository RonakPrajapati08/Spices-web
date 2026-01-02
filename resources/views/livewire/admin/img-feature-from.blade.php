<div>

    @include('livewire.admin.partials.side-top-layout', ['title' => 'Image Rotate Features'])

    <div class="main-content py-5" style="background-color: #f8f9fa; min-height: 100vh;">
        <div class="container">

            <!-- Header Section -->
            <div class="row mb-4">
                <div class="col-12">
                    <h3 class="fw-bold text-dark">Feature Management</h3>
                    <p class="text-muted">Manage your homepage image features and sliders.</p>
                </div>
            </div>

            <div class="row g-4">
                {{-- FORM COLUMN --}}
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-header bg-white border-0 pt-4 px-4">
                            <h5 class="fw-bold mb-0 {{ $updateMode ? 'text-warning' : 'text-primary' }}">
                                <i class="bi {{ $updateMode ? 'bi-pencil-square' : 'bi-plus-circle-fill' }} me-2"></i>
                                {{ $updateMode ? 'Update Feature' : 'Create New Feature' }}
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <form wire:submit.prevent="save">
                                <!-- Title -->
                                <div class="form-floating mb-3">
                                    <input type="text" wire:model="title"
                                        class="form-control border-0 bg-light rounded-3" id="titleInput"
                                        placeholder="Title">
                                    <label for="titleInput">Title</label>
                                </div>

                                <!-- Subtitle -->
                                <div class="form-floating mb-3">
                                    <input type="text" wire:model="subtitle"
                                        class="form-control border-0 bg-light rounded-3" id="subtitleInput"
                                        placeholder="Subtitle">
                                    <label for="subtitleInput">Subtitle</label>
                                </div>

                                <!-- Image Upload -->
                                <div class="mb-3">
                                    <label class="form-label fw-semibold small text-muted text-uppercase">Feature
                                        Image</label>
                                    <div class="upload-area p-3 border rounded-3 text-center bg-light"
                                        style="border-style: dashed !important;">
                                        <input type="file" wire:model="image" class="form-control d-none"
                                            id="imageUpload">
                                        <label for="imageUpload" style="cursor: pointer;" class="mb-0">
                                            @if ($image)
                                                <img src="{{ $image->temporaryUrl() }}" class="rounded-3 shadow-sm mb-2"
                                                    style="max-height: 150px; width: 100%; object-fit: cover;">
                                                <p class="small text-primary mb-0"><i class="bi bi-arrow-repeat"></i>
                                                    Change Image</p>
                                            @elseif ($existingImage)
                                                <img src="{{ asset('storage/features/' . $existingImage) }}"
                                                    class="rounded-3 shadow-sm mb-2"
                                                    style="max-height: 150px; width: 100%; object-fit: cover;">
                                                <p class="small text-primary mb-0"><i class="bi bi-arrow-repeat"></i>
                                                    Replace Image</p>
                                            @else
                                                <div class="py-3">
                                                    <i class="bi bi-cloud-arrow-up text-primary display-6"></i>
                                                    <p class="small text-muted mt-2 mb-0">Click to upload or drag and
                                                        drop</p>
                                                </div>
                                            @endif
                                        </label>
                                    </div>
                                </div>

                                <!-- Status Toggle -->
                                {{-- <div class="mb-4">
                                    <label class="form-label fw-semibold small text-muted text-uppercase">Visibility
                                        Status</label>
                                    <select wire:model="is_active" class="form-select border-0 bg-light rounded-3">
                                        <option value="1">Active / Visible</option>
                                        <option value="0">Inactive / Hidden</option>
                                    </select>
                                </div> --}}

                                <div class="mb-4">
                                    <label class="form-label fw-semibold small text-uppercase text-muted">Display
                                        Status</label>
                                    <div class="d-flex gap-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="1"
                                                wire:model="is_active" id="active">
                                            <label class="form-check-label small" for="active">Active</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="0"
                                                wire:model="is_active" id="inactive">
                                            <label class="form-check-label small" for="inactive">Inactive</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="submit"
                                        class="btn {{ $updateMode ? 'btn-warning' : 'btn-primary' }} py-2 fw-bold rounded-3 shadow-sm">
                                        {{ $updateMode ? 'Update Changes' : 'Save Feature' }}
                                    </button>

                                    @if ($updateMode)
                                        <button type="button" wire:click="resetForm"
                                            class="btn btn-light py-2 rounded-3 text-muted">
                                            Cancel
                                        </button>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- TABLE COLUMN --}}
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm rounded-4 h-100">
                        <div
                            class="card-header bg-white border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                            <h5 class="fw-bold mb-0">Feature List</h5>
                            <span class="badge bg-light text-dark rounded-pill px-3 py-2 border">Total:
                                {{ count($features) }}</span>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="border-0 px-4 py-3 text-muted small text-uppercase">Feature</th>
                                            <th class="border-0 py-3 text-muted small text-uppercase">Details</th>
                                            <th class="border-0 py-3 text-muted small text-uppercase">Status</th>
                                            <th class="border-0 px-4 py-3 text-muted small text-uppercase text-end">
                                                Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($features as $feature)
                                            <tr>
                                                <td class="px-4">
                                                    <div class="d-flex align-items-center">
                                                        @if ($feature->image)
                                                            <img src="{{ asset('storage/features/' . $feature->image) }}"
                                                                class="rounded-3 me-3 shadow-sm"
                                                                style="width: 60px; height: 45px; object-fit: cover;">
                                                        @else
                                                            <div class="bg-light rounded-3 me-3 d-flex align-items-center justify-content-center"
                                                                style="width: 60px; height: 45px;">
                                                                <i class="bi bi-image text-muted"></i>
                                                            </div>
                                                        @endif
                                                        <div>
                                                            <div class="fw-bold text-dark">{{ $feature->title }}</div>
                                                            <div class="text-muted small">ID: #{{ $feature->id }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="text-muted small text-truncate"
                                                        style="max-width: 200px;">
                                                        {{ $feature->subtitle }}
                                                    </div>
                                                </td>
                                                <td>
                                                    @if ($feature->is_active)
                                                        <span
                                                            class="badge rounded-pill bg-success-subtle text-success border border-success-subtle px-3">
                                                            <i class="bi bi-check-circle me-1"></i> Active
                                                        </span>
                                                    @else
                                                        <span
                                                            class="badge rounded-pill bg-secondary-subtle text-secondary border border-secondary-subtle px-3">
                                                            <i class="bi bi-eye-slash me-1"></i> Inactive
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="px-4 text-end">
                                                    <div class="btn-group shadow-sm rounded-3 overflow-hidden">
                                                        <button wire:click="edit({{ $feature->id }})"
                                                            class="btn btn-white btn-sm px-3 border-end"
                                                            data-bs-toggle="tooltip" title="Edit">
                                                            <i class="bi bi-pencil text-warning"></i>
                                                        </button>
                                                        <button wire:click="delete({{ $feature->id }})"
                                                            onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
                                                            class="btn btn-white btn-sm px-3" data-bs-toggle="tooltip"
                                                            title="Delete">
                                                            <i class="bi bi-trash text-danger"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center py-5">
                                                    <i class="bi bi-folder2-open display-4 text-light"></i>
                                                    <p class="text-muted mt-2">No records found in the database.</p>
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
        </div>
    </div>

    <style>
        /* Modern UI Refinements */
        .form-control:focus,
        .form-select:focus {
            background-color: #fff !important;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.08);
            border: 1px solid #0d6efd !important;
        }

        .table thead th {
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .btn-white {
            background: #fff;
            border: 1px solid #eee;
        }

        .btn-white:hover {
            background: #f8f9fa;
        }

        .upload-area:hover {
            border-color: #0d6efd !important;
            background-color: #f1f7ff !important;
            transition: all 0.3s ease;
        }
    </style>

    @if (session()->has('success'))
        <div class="position-fixed top-0 end-0 d-flex m-3 alert alert-success alert-dismissible fade show shadow-lg rounded"
            role="alert" style="min-width: 280px; max-width: 400px; z-index: 1050; padding-right: 2.5rem;"
            x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 6000)">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close position-absolute top-50 end-0 translate-middle-y me-2 p-1"
                data-bs-dismiss="alert" aria-label="Close" style="width: 0.4rem; height: 0.4rem;"></button>
        </div>
    @endif

</div>
