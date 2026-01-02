<div>

    @include('livewire.admin.partials.side-top-layout', ['title' => 'Category Management'])


    <div class="main-content py-4 px-2 px-md-5" style="background-color: #f8f9fa; min-height: 100vh;">
        <div class="container-fluid">

            <!-- Header Section -->
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
                <div>
                    <h4 class="fw-bold mb-1 text-dark">Category Management</h4>
                    <p class="text-muted small mb-0">Organize and manage your store product categories.</p>
                </div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 bg-white border px-3 py-2 rounded-pill shadow-sm small">
                        <li class="breadcrumb-item"><a href="#"
                                class="text-decoration-none text-primary">Dashboard</a></li>
                        <li class="breadcrumb-item active">Categories</li>
                    </ol>
                </nav>
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

            <div class="row g-4">
                <!-- Form Section (Left Side on Desktop) -->
                <div class="col-12 col-lg-4">
                    <div class="card border-0 shadow-sm rounded-4 sticky-lg-top" style="top: 20px;">
                        <div class="card-header bg-white border-bottom py-3">
                            <h6 class="mb-0 fw-bold text-primary">
                                <i class="bi {{ $updateMode ? 'bi-pencil-square' : 'bi-plus-circle-fill' }} me-2"></i>
                                {{ $updateMode ? 'Edit Category' : 'Create New Category' }}
                            </h6>
                        </div>
                        <div class="card-body p-4">
                            <form wire:submit.prevent="save">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold small text-uppercase tracking-wider">Category
                                        Name</label>
                                    <input type="text" wire:model="name"
                                        class="form-control border-light-subtle shadow-none py-2"
                                        placeholder="e.g. Electronics">
                                    @error('name')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label
                                        class="form-label fw-semibold small text-uppercase tracking-wider">Status</label>
                                    <select wire:model="status"
                                        class="form-select border-light-subtle shadow-none py-2">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>

                                <div class="d-grid gap-2">
                                    <button class="btn btn-primary fw-bold py-2 shadow-sm rounded-3">
                                        {{ $updateMode ? 'Update Category' : 'Save Category' }}
                                    </button>
                                    @if ($updateMode)
                                        <button type="button" wire:click="resetForm"
                                            class="btn btn-light border py-2 text-muted">
                                            Cancel
                                        </button>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Table Section (Right Side on Desktop) -->
                <div class="col-12 col-lg-8">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                        <div
                            class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                            <h6 class="mb-0 fw-bold">Active Categories</h6>
                            <span class="badge bg-light text-dark border fw-normal">{{ count($categories) }}
                                Total</span>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="ps-4 py-3 text-muted small fw-bold text-uppercase border-0"
                                            style="width: 80px;">ID</th>
                                        <th class="py-3 text-muted small fw-bold text-uppercase border-0">Name</th>
                                        <th class="py-3 text-muted small fw-bold text-uppercase border-0">Status</th>
                                        <th class="py-3 text-muted small fw-bold text-uppercase border-0 text-end pe-4">
                                            Action</th>
                                    </tr>
                                </thead>
                                <tbody class="border-top-0">
                                    @forelse ($categories as $cat)
                                        <tr>
                                            <td class="ps-4">
                                                <span class="text-muted small">#{{ $cat->id }}</span>
                                            </td>
                                            <td>
                                                <span class="fw-bold text-dark">{{ $cat->name }}</span>
                                            </td>
                                            <td>
                                                @if ($cat->status)
                                                    <span
                                                        class="badge rounded-pill bg-success-subtle text-success border border-success-subtle px-3 py-2">
                                                        <i class="bi bi-check-circle me-1"></i> Active
                                                    </span>
                                                @else
                                                    <span
                                                        class="badge rounded-pill bg-secondary-subtle text-secondary border border-secondary-subtle px-3 py-2">
                                                        <i class="bi bi-x-circle me-1"></i> Inactive
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="text-end pe-4">
                                                <div class="btn-group shadow-sm rounded-3">
                                                    <button wire:click="edit({{ $cat->id }})"
                                                        class="btn btn-white btn-sm border-end px-3 py-2"
                                                        title="Edit">
                                                        <i class="bi bi-pencil-square text-primary"></i>
                                                    </button>
                                                    <button wire:click="delete({{ $cat->id }})"
                                                        onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
                                                        class="btn btn-white btn-sm px-3 py-2" title="Delete">
                                                        <i class="bi bi-trash3 text-danger"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-5">
                                                <div class="text-muted">
                                                    <i class="bi bi-folder-x fs-1 opacity-25"></i>
                                                    <p class="mt-2">No categories found.</p>
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
        </div>
    </div>

</div>
