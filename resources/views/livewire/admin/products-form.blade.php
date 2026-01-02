<div>

    @include('livewire.admin.partials.side-top-layout', ['title' => 'Product Management'])


    <div class="main-content py-4 px-3 px-md-5" style="background-color: #f8f9fa; min-height: 100vh;">

        <!-- Header Section: Stacked on mobile, side-by-side on desktop -->
        <div
            class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
            <div>
                <h4 class="fw-bold mb-1 text-dark">Product Management</h4>
                <p class="text-muted small mb-0">Add, edit, and organize your product inventory in one place.</p>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 bg-white border px-3 py-2 rounded-pill shadow-sm small">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"
                            class="text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item active">Products</li>
                </ol>
            </nav>
        </div>

        <!-- Form Section -->
        <div class="card border-0 shadow-sm rounded-4 mb-4 mb-md-5">
            <div class="card-header bg-white border-bottom py-3">
                <h6 class="mb-0 fw-bold text-primary text-center text-md-start">
                    <i class="bi {{ $updateMode ? 'bi-pencil-square' : 'bi-plus-circle-dotted' }} me-2"></i>
                    {{ $updateMode ? 'Edit Product Details' : 'Create New Product' }}
                </h6>
            </div>
            <div class="card-body p-3 p-md-4">
                <form wire:submit.prevent="save">
                    <div class="row g-3">

                        {{-- Product Name --}}
                        <div class="col-12 col-md-6">
                            <label class="form-label fw-semibold small text-uppercase">Product Name</label>
                            <input type="text" wire:model="name" class="form-control"
                                placeholder="e.g. Wireless Headphones">
                        </div>

                        {{-- Category --}}
                        <div class="col-12 col-md-6">
                            <label class="form-label fw-semibold small text-uppercase">Category</label>
                            <select wire:model="category_id" class="form-select">
                                <option value="">Select Category</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Description --}}
                        <div class="col-12">
                            <label class="form-label fw-semibold small text-uppercase">Description</label>
                            <textarea wire:model="description" rows="2" class="form-control" placeholder="Short product summary..."></textarea>
                        </div>

                        {{-- Image Upload --}}
                        <div class="col-12 col-md-6">
                            <label class="form-label fw-semibold small text-uppercase">Image</label>
                            <div class="d-flex align-items-center gap-3 bg-light p-2 rounded-3 border border-dashed">

                                {{-- Preview --}}
                                @if ($image)
                                    <img src="{{ $image->temporaryUrl() }}" class="rounded shadow-sm" width="55"
                                        height="55" style="object-fit: cover;">
                                @elseif($existingImage)
                                    <img src="{{ asset('storage/products/' . $existingImage) }}" class="rounded shadow-sm"
                                        width="55" height="55" style="object-fit: cover;">
                                @else
                                    <div class="bg-white border rounded d-flex align-items-center justify-content-center shadow-sm"
                                        style="width:55px;height:55px;">
                                        <i class="bi bi-camera text-muted fs-5"></i>
                                    </div>
                                @endif

                                <input type="file" wire:model="image"
                                    class="form-control form-control-sm border-0 bg-transparent shadow-none">
                            </div>
                        </div>

                        {{-- Status --}}
                        <div class="col-6 col-md-3">
                            <label class="form-label fw-semibold small text-uppercase">Status</label>
                            <select wire:model="status" class="form-select">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>

                        {{-- Featured --}}
                        <div class="col-6 col-md-3">
                            <label class="form-label fw-semibold small text-uppercase">Featured</label>
                            <select wire:model="is_top" class="form-select">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="col-12">
                            <hr class="opacity-25">
                            <div class="d-flex justify-content-end gap-2">
                                @if ($updateMode)
                                    <button type="button" wire:click="resetInputFields" class="btn btn-light px-4">
                                        Cancel
                                    </button>
                                @endif
                                <button type="submit" class="btn btn-primary px-5 fw-semibold shadow">
                                    {{ $updateMode ? 'Update Product' : 'Save Product' }}
                                </button>
                            </div>
                        </div>

                    </div>
                </form>

            </div>
        </div>

        <!-- Table Section -->
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div
                class="card-header bg-white border-bottom py-3 d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                <div class="text-center text-md-start">
                    <h6 class="mb-0 fw-bold">Inventory List</h6>
                    <span class="text-muted small">Total: {{ count($products) }} Items</span>
                </div>
                <div class="input-group w-100" style="max-width: 300px;">
                    <span class="input-group-text bg-light border-0"><i class="bi bi-search"></i></span>
                    <input type="text" class="form-control bg-light border-0 shadow-none"
                        placeholder="Search products...">
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <!-- Hidden ID on mobile to save space -->
                            <th class="ps-4 py-3 text-muted small fw-bold text-uppercase d-none d-sm-table-cell">ID
                            </th>
                            <th class="py-3 text-muted small fw-bold text-uppercase">Product</th>
                            <!-- Hidden Category column on very small phones -->
                            <th class="py-3 text-muted small fw-bold text-uppercase d-none d-md-table-cell">Category
                            </th>
                            <th class="py-3 text-muted small fw-bold text-uppercase">Status</th>
                            <th class="py-3 text-muted small fw-bold text-uppercase">Featured</th>
                            <th class="py-3 text-muted small fw-bold text-uppercase text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        @forelse ($products as $p)
                            <tr>
                                <td class="ps-4 text-muted small d-none d-sm-table-cell">#{{ $p->id }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('storage/products/' . $p->image) }}"
                                            class="rounded-3 border shadow-sm flex-shrink-0" width="45"
                                            height="45" style="object-fit: cover;">
                                        <div class="ms-2 ms-md-3">
                                            <div class="fw-bold text-dark mb-0 small-on-mobile">{{ $p->name }}
                                            </div>
                                            <!-- Category shown here ONLY on mobile -->
                                            <div class="d-md-none extra-small text-primary">{{ $p->category->name }}
                                            </div>
                                            <div class="text-muted extra-small d-none d-sm-block text-truncate"
                                                style="max-width: 150px;">{{ $p->description }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="d-none d-md-table-cell">
                                    <span class="badge bg-white text-dark border px-2 py-1 fw-medium shadow-sm">
                                        {{ $p->category->name }}
                                    </span>
                                </td>
                                <td>
                                    @if ($p->status)
                                        <span
                                            class="badge rounded-pill bg-success-subtle text-success px-2 px-md-3 border border-success-subtle extra-small">Active</span>
                                    @else
                                        <span
                                            class="badge rounded-pill bg-secondary-subtle text-secondary px-2 px-md-3 border border-secondary-subtle extra-small">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($p->is_top)
                                        <span
                                            class="badge rounded-pill bg-primary-subtle text-primary px-2 px-md-3 border border-primary-subtle extra-small">Yes</span>
                                    @else
                                        <span
                                            class="badge rounded-pill bg-light text-muted px-2 px-md-3 border border-light extra-small">No</span>
                                    @endif
                                <td class="text-end pe-2 pe-md-4 text-nowrap">
                                    <button wire:click="edit({{ $p->id }})"
                                        class="btn btn-outline-primary btn-sm border-0 rounded-circle p-1 p-md-2"
                                        title="Edit">
                                        <i class="bi bi-pencil-fill"></i>
                                    </button>
                                    <button wire:click="delete({{ $p->id }})"
                                        onclick="confirm('Delete?') || event.stopImmediatePropagation()"
                                        class="btn btn-outline-danger btn-sm border-0 rounded-circle p-1 p-md-2"
                                        title="Delete">
                                        <i class="bi bi-trash3-fill"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <p class="text-muted">No products found.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

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
