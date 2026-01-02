<div>

    @include('livewire.admin.partials.side-top-layout', ['title' => 'Home Slider Management'])


    {{-- MAIN CONTENT --}}
    <div class="main-content py-4">

        <!-- Form Card -->
        <div class="card border-0 shadow-sm mb-5">
            <div class="card-header bg-white py-3 border-bottom">
                <div class="d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 p-2 rounded me-3">
                        <i class="bi bi-sliders text-primary"></i>
                    </div>
                    <h5 class="mb-0 fw-bold">{{ $slider_id ? 'Edit Slider' : 'Add New Slider' }}</h5>
                </div>
            </div>
            <div class="card-body p-4">
                {{-- <form wire:submit.prevent="save"> --}}
                <form wire:submit.prevent="save" enctype="multipart/form-data">

                    <div class="row g-4">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Slider Title</label>
                            <input type="text" wire:model="title"
                                class="form-control @error('title') is-invalid @enderror"
                                placeholder="Main catchy title">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Subtitle</label>
                            <input type="text" wire:model="subtitle" class="form-control"
                                placeholder="Short description text">
                        </div>

                        <div class="col-md-2">
                            <label class="form-label fw-semibold">Status</label>
                            <select wire:model="is_active" class="form-select border-1">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>

                        <div class="col-md-2 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100 fw-bold py-2 shadow-sm">
                                <i class="bi bi-cloud-arrow-up me-1"></i> {{ $slider_id ? 'Update' : 'Save Slider' }}
                            </button>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label fw-semibold">Upload Slider Image</label>
                            <div class="d-flex align-items-start gap-4">
                                <div class="flex-grow-1">
                                    <input type="file" wire:model="image" class="form-control"
                                        id="upload{{ $slider_id }}">
                                    <div class="form-text text-muted small mt-2">Recommended size: 1920x800px (JPG, PNG)
                                    </div>
                                    <div wire:loading wire:target="image"
                                        class="spinner-border spinner-border-sm text-primary mt-2" role="status"></div>
                                </div>

                                <!-- Image Preview Block -->
                                <div class="position-relative">
                                    @if ($image && !is_string($image))
                                        <img src="{{ $image->temporaryUrl() }}" class="rounded shadow-sm border"
                                            style="width: 150px; height: 80px; object-fit: cover;">
                                        <span
                                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">New</span>
                                    @elseif($existingImage)
                                        <img src="{{ asset('storage/' . $existingImage) }}"
                                            class="rounded shadow-sm border"
                                            style="width: 150px; height: 80px; object-fit: cover;">
                                    @else
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center border"
                                            style="width: 150px; height: 80px;">
                                            <i class="bi bi-image text-muted fs-2"></i>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Table Card -->
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold">Live Sliders</h6>
                <span class="badge bg-light text-dark border font-monospace">{{ count($sliders) }} Total</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light text-muted small text-uppercase">
                            <tr>
                                <th class="ps-4" width="200">Preview</th>
                                <th>Information</th>
                                <th class="text-center">Status</th>
                                <th class="text-end pe-4" width="150">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($sliders as $slider)
                                <tr>
                                    <td class="ps-4">
                                        <div class="rounded-3 shadow-sm overflow-hidden"
                                            style="width: 140px; height: 70px;">
                                            <img src="{{ asset('storage/' . $slider->image) }}" class="w-100 h-100"
                                                style="object-fit: cover;">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="fw-bold text-dark">{{ $slider->title }}</div>
                                        <div class="text-muted small">{{ $slider->subtitle ?? 'No subtitle provided' }}
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        @if ($slider->is_active)
                                            <span
                                                class="badge rounded-pill bg-success-subtle text-success border border-success border-opacity-25 px-3">Active</span>
                                        @else
                                            <span
                                                class="badge rounded-pill bg-secondary-subtle text-secondary border border-secondary border-opacity-25 px-3">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="text-end pe-4">
                                        <div class="btn-group shadow-sm border rounded">
                                            <button wire:click="edit({{ $slider->id }})"
                                                class="btn btn-white btn-sm px-3" title="Edit">
                                                <i class="bi bi-pencil-square text-primary"></i>
                                            </button>
                                            <button wire:click="delete({{ $slider->id }})"
                                                onclick="confirm('Are you sure you want to delete this slider?') || event.stopImmediatePropagation()"
                                                class="btn btn-white btn-sm px-3 border-start" title="Delete">
                                                <i class="bi bi-trash text-danger"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="bi bi-folder2-open fs-1 opacity-25"></i>
                                            <p class="mt-2">No sliders available. Start by adding one above.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Styling to make it look like a high-end SaaS dashboard */
        .btn-white {
            background: #fff;
            border: none;
        }

        .btn-white:hover {
            background: #f8f9fa;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.08);
        }

        .bg-success-subtle {
            background-color: #e1f7ec !important;
        }

        .bg-secondary-subtle {
            background-color: #f1f2f4 !important;
        }

        .font-monospace {
            font-family: 'SFMono-Regular', Consolas, 'Liberation Mono', Menlo, monospace;
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
