<div>

    @include('livewire.admin.partials.side-top-layout', ['title' => 'Testimonials Management'])

    <div class="main-content py-4 px-3 px-md-5 bg-light min-vh-100">

        <!-- Header Section -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
            <div>
                <h4 class="fw-bold mb-1 text-dark">Customer Testimonials</h4>
                <p class="text-muted small mb-0">Manage customer feedback, profiles, and display images.</p>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 bg-white border px-3 py-2 rounded-pill shadow-sm small">
                    <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item active">Testimonials</li>
                </ol>
            </nav>
        </div>

        <!-- Form Card: Modern Grid Layout -->
        <div class="card border-0 shadow-sm rounded-4 mb-5">
            <div class="card-header bg-white border-bottom py-3">
                <h6 class="mb-0 fw-bold text-primary">
                    <i class="bi {{ $updateMode ? 'bi-pencil-square' : 'bi-plus-circle-fill' }} me-2"></i>
                    {{ $updateMode ? 'Edit Testimonial' : 'Add New Testimonial' }}
                </h6>
            </div>
            <div class="card-body p-4">
                <form wire:submit.prevent="{{ $updateMode ? 'update' : 'store' }}">
                    <div class="row g-4">
                        <!-- Name & Image Column -->
                        <div class="col-lg-4">
                            <div class="mb-4">
                                <label
                                    class="form-label fw-bold small text-muted text-uppercase tracking-wider">Customer
                                    Name</label>
                                <div class="form-floating">
                                    <input type="text" wire:model="customer_name"
                                        class="form-control border-0 bg-light @error('customer_name') is-invalid @enderror"
                                        id="custName" placeholder="John Doe">
                                    <label for="custName">Enter full name</label>
                                </div>
                                @error('customer_name')
                                    <div class="text-danger extra-small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-0">
                                <label class="form-label fw-bold small text-muted text-uppercase tracking-wider">Profile
                                    Photo</label>
                                <div class="d-flex align-items-center gap-3 p-2 bg-light rounded-3 border">
                                    <div class="position-relative">
                                        @if ($image)
                                            <img src="{{ $image->temporaryUrl() }}"
                                                class="rounded-circle border shadow-sm"
                                                style="width: 60px; height: 60px; object-fit: cover;">
                                        @elseif($existing_image)
                                            <img src="{{ asset('storage/testimonials/' . $existing_image) }}"
                                                class="rounded-circle border shadow-sm"
                                                style="width: 60px; height: 60px; object-fit: cover;">
                                        @else
                                            <div class="bg-white rounded-circle border d-flex align-items-center justify-content-center text-muted"
                                                style="width: 60px; height: 60px;">
                                                <i class="bi bi-person fs-4"></i>
                                            </div>
                                        @endif
                                        <div wire:loading wire:target="image"
                                            class="position-absolute top-0 start-0 w-100 h-100 bg-white bg-opacity-75 rounded-circle align-content-center align-items-center justify-content-center">
                                            <div class="spinner-border spinner-border-sm text-primary" role="status">
                                            </div>
                                        </div>
                                    </div>
                                    <input type="file" wire:model="image"
                                        class="form-control form-control-sm border-0 bg-transparent shadow-none"
                                        accept="image/*">
                                </div>
                                @error('image')
                                    <div class="text-danger extra-small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Description Column -->
                        <div class="col-lg-8">
                            <label class="form-label fw-bold small text-muted text-uppercase tracking-wider">Customer
                                Review / Description</label>
                            <div class="form-floating h-100">
                                <textarea wire:model="description" class="form-control border-0 bg-light @error('description') is-invalid @enderror"
                                    id="custDesc" placeholder="Description" style="height: 160px"></textarea>
                                <label for="custDesc">Write the feedback here...</label>
                            </div>
                            @error('description')
                                <div class="text-danger extra-small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Action Buttons -->
                        <div class="col-12 text-end pt-2">
                            <hr class="opacity-25 mb-4">
                            @if ($updateMode)
                                <button type="button" wire:click="resetInputFields"
                                    class="btn btn-light px-4 py-2 me-2 border text-muted rounded-3">Cancel</button>
                            @endif
                            <button type="submit" class="btn btn-primary px-5 py-2 fw-bold shadow-sm rounded-3">
                                <i class="bi bi-check2-circle me-1"></i>
                                {{ $updateMode ? 'Update Testimonial' : 'Save Testimonial' }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Table Card: Clean Responsive Design -->
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold">Recent Entries</h6>
                <div class="input-group input-group-sm" style="max-width: 250px;">
                    <span class="input-group-text bg-light border-0"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" class="form-control bg-light border-0 shadow-none"
                        placeholder="Search customer...">
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 py-3 text-muted small fw-bold text-uppercase border-0">ID</th>
                            <th class="py-3 text-muted small fw-bold text-uppercase border-0">Customer Info</th>
                            <th class="py-3 text-muted small fw-bold text-uppercase border-0 d-none d-md-table-cell">
                                Review</th>
                            <th class="py-3 text-muted small fw-bold text-uppercase border-0 text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        @forelse($records as $record)
                            <tr>
                                <td class="ps-4 text-muted small">#{{ $record->id }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if ($record->image)
                                            <img src="{{ asset('storage/testimonials/' . $record->image) }}"
                                                class="rounded-circle shadow-sm border me-3" width="45"
                                                height="45" style="object-fit: cover;">
                                        @else
                                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-3"
                                                style="width:45px; height:45px;">
                                                <i class="bi bi-person text-muted"></i>
                                            </div>
                                        @endif
                                        <div class="fw-bold text-dark">{{ $record->customer_name }}</div>
                                    </div>
                                </td>
                                <td class="d-none d-md-table-cell">
                                    <p class="text-muted small mb-0 text-truncate" style="max-width: 300px;">
                                        {{ $record->description }}</p>
                                </td>
                                <td class="text-end pe-4">
                                    <div class="btn-group shadow-sm rounded-2 overflow-hidden">
                                        <button wire:click="edit({{ $record->id }})"
                                            class="btn btn-white btn-sm border-end py-2 px-3" title="Edit">
                                            <i class="bi bi-pencil-square text-primary"></i>
                                        </button>
                                        <button wire:click="delete({{ $record->id }})"
                                            class="btn btn-white btn-sm py-2 px-3"
                                            onclick="confirm('Delete this record?') || event.stopImmediatePropagation()"
                                            title="Delete">
                                            <i class="bi bi-trash3 text-danger"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted small">No records found.</td>
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
