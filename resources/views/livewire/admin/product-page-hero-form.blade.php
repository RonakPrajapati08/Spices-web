<div>
    @include('livewire.admin.partials.side-top-layout', ['title' => 'Product Page Hero Section'])

    <div class="main-content py-4 px-3">

        <!-- Form Card -->
        <div class="card border-0 shadow-sm mb-5">
            <div class="card-header bg-white border-bottom py-3">
                <div class="d-flex align-items-center justify-content-between">
                    <h5 class="mb-0 fw-bold text-dark">
                        <i
                            class="bi {{ $updateMode ? 'bi-pencil-square text-warning' : 'bi-plus-circle text-success' }} me-2"></i>
                        {{ $updateMode ? 'Edit Hero Section' : 'Add New Hero Section' }}
                    </h5>
                    @if ($updateMode)
                        <button wire:click="resetInputFields" class="btn btn-sm btn-outline-secondary">Cancel
                            Edit</button>
                    @endif
                </div>
            </div>

            <div class="card-body p-4">
                <form wire:submit.prevent="{{ $updateMode ? 'update' : 'store' }}">
                    <div class="row g-4">
                        <!-- Left Column: Info -->
                        <div class="col-lg-7">
                            <div class="row g-3">
                                <div class="col-md-8">
                                    <label class="form-label fw-semibold">Heading Title</label>
                                    <input type="text" wire:model="heading"
                                        class="form-control shadow-none border-secondary-subtle"
                                        placeholder="e.g. Our Premium Spices">
                                    @error('heading')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Visibility Status</label>
                                    <select wire:model="is_active"
                                        class="form-select shadow-none border-secondary-subtle">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>

                                <div class="col-12">
                                    <label class="form-label fw-semibold">Sub-description</label>
                                    <textarea wire:model="description" class="form-control shadow-none border-secondary-subtle" rows="4"
                                        placeholder="Brief details about this product category..."></textarea>
                                    @error('description')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Right Column: Media Upload -->
                        <div class="col-lg-5">
                            <div class="row g-3">
                                <!-- Background Image -->
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Background Image</label>
                                    <div
                                        class="upload-preview-box border rounded p-2 text-center bg-light position-relative">
                                        @if ($bg_image)
                                            <img src="{{ $bg_image->temporaryUrl() }}" class="rounded img-fluid"
                                                style="max-height: 100px;">
                                        @elseif ($existing_bg_image)
                                            <img src="{{ asset('storage/product-hero/' . $existing_bg_image) }}"
                                                class="rounded img-fluid" style="max-height: 100px;">
                                        @else
                                            <div class="py-3 text-muted"><i
                                                    class="bi bi-cloud-arrow-up fs-2 d-block"></i><small>BG
                                                    Image</small></div>
                                        @endif
                                        <input type="file" wire:model="bg_image"
                                            class="form-control form-control-sm mt-2">
                                    </div>
                                    <div wire:loading wire:target="bg_image" class="text-primary x-small">Uploading...
                                    </div>
                                </div>

                                <!-- Intro Image -->
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Intro Image</label>
                                    <div class="upload-preview-box border rounded p-2 text-center bg-light">
                                        @if ($intro_img)
                                            <img src="{{ $intro_img->temporaryUrl() }}" class="rounded img-fluid"
                                                style="max-height: 100px;">
                                        @elseif ($existing_intro_img)
                                            <img src="{{ asset('storage/product-hero/' . $existing_intro_img) }}"
                                                class="rounded img-fluid" style="max-height: 100px;">
                                        @else
                                            <div class="py-3 text-muted"><i
                                                    class="bi bi-image fs-2 d-block"></i><small>Intro Image</small>
                                            </div>
                                        @endif
                                        <input type="file" wire:model="intro_img"
                                            class="form-control form-control-sm mt-2">
                                    </div>
                                    <div wire:loading wire:target="intro_img" class="text-primary x-small">Uploading...
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 text-end border-top pt-3 mt-4">
                            <button class="btn {{ $updateMode ? 'btn-warning' : 'btn-success' }} px-5 shadow-sm">
                                <i class="bi {{ $updateMode ? 'bi-arrow-repeat' : 'bi-check2-circle' }} me-1"></i>
                                {{ $updateMode ? 'Update Hero Content' : 'Save Hero Content' }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Table Card -->
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom">
                <h5 class="mb-0 fw-bold text-secondary">Existing Records</h5>
                <span class="badge bg-light text-dark border px-3 py-2">{{ $heros->total() }} Total</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4">Preview (BG / Intro)</th>
                                <th>Heading</th>
                                <th>Description</th>
                                <th class="text-center">Status</th>
                                <th class="text-end pe-4">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($heros as $row)
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex gap-2">
                                            <img src="{{ asset('storage/product-hero/' . $row->bg_image) }}"
                                                class="rounded border shadow-sm" width="60" height="40"
                                                style="object-fit: cover;" title="Background">
                                            <img src="{{ asset('storage/product-hero/' . $row->intro_img) }}"
                                                class="rounded border shadow-sm" width="60" height="40"
                                                style="object-fit: cover;" title="Intro">
                                        </div>
                                    </td>
                                    <td class="fw-bold text-dark">{{ Str::limit($row->heading, 30) }}</td>
                                    <td><small class="text-muted">{{ Str::limit($row->description, 50) }}</small></td>
                                    <td class="text-center">
                                        @if ($row->is_active)
                                            <span
                                                class="badge rounded-pill bg-success-subtle text-success border border-success-subtle px-3">Active</span>
                                        @else
                                            <span
                                                class="badge rounded-pill bg-danger-subtle text-danger border border-danger-subtle px-3">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="text-end pe-4">
                                        <div class="btn-group shadow-sm border rounded">
                                            <button wire:click="edit({{ $row->id }})"
                                                class="btn btn-sm btn-white text-info border-end" title="Edit">
                                                <i class="bi bi-pencil-fill"></i>
                                            </button>
                                            <button wire:click="delete({{ $row->id }})"
                                                onclick="confirm('Delete this record?') || event.stopImmediatePropagation()"
                                                class="btn btn-sm btn-white text-danger" title="Delete">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">No records found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-white border-0 py-3">
                {{ $heros->links() }}
            </div>
        </div>
    </div>

    <style>
        /* Table Aesthetic */
        .table thead th {
            font-size: 0.85rem;
            text-transform: uppercase;
            color: #6c757d;
            padding: 15px 10px;
            font-weight: 600;
        }

        .table tbody td {
            padding: 12px 10px;
        }

        /* Image Upload Preview Box */
        .upload-preview-box {
            min-height: 160px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            transition: all 0.2s ease;
            border: 1px dashed #ced4da !important;
        }

        .upload-preview-box:hover {
            border-color: #0d6efd !important;
            background-color: #f1f7ff !important;
        }

        /* Badge colors for sub-levels */
        .bg-success-subtle {
            background-color: #e6fcf5 !important;
        }

        .bg-danger-subtle {
            background-color: #fff5f5 !important;
        }

        /* Small helper for table text */
        .x-small {
            font-size: 11px;
        }

        /* Action buttons */
        .btn-white {
            background: #fff;
        }

        .btn-white:hover {
            background: #f8f9fa;
        }
    </style>

    @if (session()->has('message'))
        <div class="position-fixed top-0 end-0 m-3 alert alert-success alert-dismissible fade show shadow-lg rounded"
            role="alert" style="min-width: 220px; max-width: 350px; z-index: 1050; padding-right: 2.5rem;"
            x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('message') }}
            <button type="button" class="btn-close position-absolute top-50 end-0 translate-middle-y me-2 p-1"
                data-bs-dismiss="alert" aria-label="Close" style="width: 0.4rem; height: 0.4rem;"></button>
        </div>
    @endif

</div>
