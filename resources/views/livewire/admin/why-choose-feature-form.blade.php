<div>

    @include('livewire.admin.partials.side-top-layout', ['title' => 'Why Choose Feature Management'])

    <div class="main-content py-4 px-3 px-md-5 bg-light min-vh-100">

        <!-- Header & Breadcrumbs -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
            <div>
                <h4 class="fw-bold mb-1 text-dark">Section Features Management</h4>
                <p class="text-muted small mb-0">Manage feature items, icons, and display order.</p>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 bg-white border px-3 py-2 rounded-pill shadow-sm small">
                    <li class="breadcrumb-item"><a href="{{ route('admin.why-choose-form') }}"
                            class="text-decoration-none">WhyChoose Form</a></li>
                    <li class="breadcrumb-item active">Why Us Features</li>
                </ol>
            </nav>
        </div>

        <!-- Form Section: Full Width Professional Card -->
        <div class="card border-0 shadow-sm rounded-4 mb-5">
            <div class="card-header bg-white border-bottom py-3">
                <h6 class="mb-0 fw-bold text-primary">
                    <i class="bi {{ $updateMode ? 'bi-pencil-square' : 'bi-plus-circle-dotted' }} me-2"></i>
                    {{ $updateMode ? 'Edit Feature Item' : 'Create New Feature Item' }}
                </h6>
            </div>
            <div class="card-body p-0"> <!-- Removed padding from body to use sectioned padding -->
                <form wire:submit.prevent="{{ $updateMode ? 'update' : 'store' }}">

                    <!-- Top Section: Content & Media -->
                    <div class="p-4">
                        <div class="row g-4">
                            <!-- LEFT COLUMN: Media Upload -->
                            <div class="col-md-4 col-lg-3">
                                <label
                                    class="form-label fw-bold small text-uppercase tracking-wider text-muted mb-3">Feature
                                    Icon</label>
                                <div class="d-flex flex-column align-items-center">
                                    <div class="upload-container position-relative mb-3">
                                        @if ($icon_image)
                                            <img src="{{ $icon_image->temporaryUrl() }}" class="rounded-4 shadow border"
                                                style="width: 120px; height: 120px; object-fit: cover;">
                                        @elseif ($existing_icon_image)
                                            <img src="{{ asset('storage/whychoose_features/' . $existing_icon_image) }}"
                                                class="rounded-4 shadow border"
                                                style="width: 120px; height: 120px; object-fit: cover;">
                                        @else
                                            <div class="bg-light rounded-4 border border-2 border-dashed d-flex flex-column align-items-center justify-content-center text-muted shadow-sm"
                                                style="width: 120px; height: 120px;">
                                                <i class="bi bi-cloud-arrow-up fs-1 opacity-50"></i>
                                                <span class="extra-small mt-1">PNG/SVG</span>
                                            </div>
                                        @endif

                                        <!-- Floating Upload Button -->
                                        <label for="icon_image"
                                            class="btn btn-sm btn-primary position-absolute bottom-0 end-0 rounded-circle shadow"
                                            style="transform: translate(25%, 25%); width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;">
                                            <i class="bi bi-camera-fill"></i>
                                            <input type="file" wire:model="icon_image" id="icon_image" class="d-none"
                                                accept="image/*">
                                        </label>
                                    </div>

                                    <div wire:loading wire:target="icon_image"
                                        class="spinner-border spinner-border-sm text-primary mt-2" role="status"></div>
                                    @error('icon_image')
                                        <div class="text-danger extra-small mt-2">{{ $message }}</div>
                                    @enderror
                                    <p class="text-center text-muted extra-small mt-2 px-3">Square icon recommended (Max
                                        2MB)</p>
                                </div>
                            </div>

                            <!-- RIGHT COLUMN: Main Info -->
                            <div class="col-md-8 col-lg-9">
                                <div class="row g-3">
                                    <!-- Parent Section -->
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <select wire:model="why_section_id"
                                                class="form-select border-0 bg-light @error('why_section_id') is-invalid @enderror"
                                                id="floatingSection">
                                                <option value="">-- Choose Category --</option>
                                                @foreach ($sections as $section)
                                                    <option value="{{ $section->id }}">{{ $section->title }}</option>
                                                @endforeach
                                            </select>
                                            <label for="floatingSection">Parent Section Category</label>
                                            @error('why_section_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Title -->
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input type="text" wire:model="title"
                                                class="form-control border-0 bg-light @error('title') is-invalid @enderror"
                                                id="floatingTitle" placeholder="Title">
                                            <label for="floatingTitle">Feature Title</label>
                                            @error('title')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Description -->
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <textarea wire:model="description" class="form-control border-0 bg-light @error('description') is-invalid @enderror"
                                                id="floatingDesc" style="height: 120px" placeholder="Description"></textarea>
                                            <label for="floatingDesc">Feature Description</label>
                                            @error('description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bottom Section: Metadata Settings (Subtle contrast) -->
                    <div class="bg-light p-4 border-top">
                        <div class="row align-items-center g-3">
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-0 small fw-bold">Sort Order</span>
                                    <input type="number" wire:model="sort_order" class="form-control border-0"
                                        placeholder="0">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-0 small fw-bold">Visibility</span>
                                    <select wire:model="status" class="form-select border-0">
                                        <option value="1">Active / Visible</option>
                                        <option value="0">Inactive / Hidden</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="d-flex justify-content-md-end gap-2">
                                    @if ($updateMode)
                                        <button type="button" wire:click="resetInputFields"
                                            class="btn btn-white border px-4 rounded-3 text-muted">
                                            Cancel
                                        </button>
                                    @endif
                                    <button type="submit"
                                        class="btn btn-primary px-5 rounded-3 fw-bold shadow-sm d-flex align-items-center justify-content-center">
                                        @if ($updateMode)
                                            <i class="bi bi-pencil-square me-2"></i> Update Item
                                        @else
                                            <i class="bi bi-plus-circle me-2"></i> Save Item
                                        @endif
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Table Section -->
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold">Items Inventory</h6>
                <div class="input-group" style="max-width: 250px;">
                    <span class="input-group-text bg-light border-0"><i class="bi bi-search"></i></span>
                    <input type="text" class="form-control bg-light border-0 shadow-none small"
                        placeholder="Search items...">
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 py-3 text-muted small fw-bold text-uppercase border-0">ID</th>
                            <th class="py-3 text-muted small fw-bold text-uppercase border-0">Info</th>
                            <th class="py-3 text-muted small fw-bold text-uppercase border-0 d-none d-md-table-cell">
                                Section</th>
                            <th class="py-3 text-muted small fw-bold text-uppercase border-0 text-center">Sort</th>
                            <th class="py-3 text-muted small fw-bold text-uppercase border-0 text-center">Status</th>
                            <th class="py-3 text-muted small fw-bold text-uppercase border-0 text-end pe-4">Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        @forelse ($records as $record)
                            <tr>
                                <td class="ps-4 text-muted small">#{{ $record->id }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if ($record->icon)
                                            <img src="{{ asset('storage/whychoose_features/' . $record->icon) }}"
                                                class="rounded shadow-sm me-3 border" width="45" height="45"
                                                style="object-fit: cover;">
                                        @else
                                            <div class="rounded bg-light d-flex align-items-center justify-content-center me-3 border"
                                                style="width:45px; height:45px;">
                                                <i class="bi bi-image text-muted"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <div class="fw-bold text-dark mb-0">{{ $record->title }}</div>
                                            <div class="text-muted small text-truncate" style="max-width: 150px;">
                                                {{ $record->description }}</div>
                                        </div>
                                    </div>
                                </td>

                                <td class="d-none d-md-table-cell">
                                    <span class="badge bg-white text-dark border fw-medium shadow-xs">
                                        {{ $record->mainWhyChoose ? $record->mainWhyChoose->title : 'N/A' }}
                                    </span>
                                </td>
                                <td class="text-center fw-bold text-muted small">{{ $record->sort_order }}</td>
                                <td class="text-center">
                                    @if ($record->status)
                                        <span
                                            class="badge rounded-pill bg-success-subtle text-success border border-success-subtle px-3 py-1">Active</span>
                                    @else
                                        <span
                                            class="badge rounded-pill bg-secondary-subtle text-secondary border border-secondary-subtle px-3 py-1">Inactive</span>
                                    @endif
                                </td>
                                <td class="text-end pe-4">
                                    <div class="btn-group shadow-sm">
                                        <button wire:click="edit({{ $record->id }})"
                                            class="btn btn-white btn-sm border-end" title="Edit">
                                            <i class="bi bi-pencil-square text-primary"></i>
                                        </button>
                                        <button wire:click="delete({{ $record->id }})"
                                            onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
                                            class="btn btn-white btn-sm" title="Delete">
                                            <i class="bi bi-trash3 text-danger"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <i class="bi bi-folder2-open display-4 text-muted opacity-25"></i>
                                    <p class="text-muted mt-2">No items found in your inventory.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer bg-white border-top py-3">
                <div class="d-flex justify-content-center">
                    {{ $records->links() }}
                </div>
            </div>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="position-fixed top-0 end-0 d-flex m-3 alert alert-success alert-dismissible fade show shadow-lg rounded"
            role="alert" style="min-width: 280px; max-width: 400px; z-index: 1050; padding-right: 2.5rem;"
            x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 6000)">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('message') }}
            <button type="button" class="btn-close position-absolute top-50 end-0 translate-middle-y me-2 p-1"
                data-bs-dismiss="alert" aria-label="Close" style="width: 0.4rem; height: 0.4rem;"></button>
        </div>
    @endif

</div>
