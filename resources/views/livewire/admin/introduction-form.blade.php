<div>

    @include('livewire.admin.partials.side-top-layout', ['title' => 'Introduction Form Management'])

    <div class="main-content py-4">

        <div class="row justify-content-center">
            <!-- Form Section -->
            <div class="col-md-10">

                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 text-primary fw-bold">
                            {{ $updateMode ? 'Update Introduction' : 'Create New Introduction' }}
                        </h5>
                    </div>
                    <div class="card-body">
                        <form wire:submit.prevent="{{ $updateMode ? 'update' : 'store' }}">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Heading</label>
                                    <input type="text" wire:model="heading"
                                        class="form-control @error('heading') is-invalid @enderror"
                                        placeholder="Enter heading">
                                    @error('heading')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Sub Heading</label>
                                    <input type="text" wire:model="sub_heading"
                                        class="form-control @error('sub_heading') is-invalid @enderror"
                                        placeholder="Enter sub-heading">
                                    @error('sub_heading')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-12 mb-3">
                                    <label class="form-label fw-semibold">Description</label>
                                    <textarea wire:model="description" class="form-control @error('description') is-invalid @enderror" rows="3"
                                        placeholder="Write description here..."></textarea>
                                    @error('description')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-4">
                                    <label class="form-label fw-semibold">Image</label>
                                    <div class="d-flex align-items-start gap-3">
                                        <div class="flex-grow-1">
                                            <input type="file" wire:model="image_temp"
                                                class="form-control @error('image_temp') is-invalid @enderror">
                                            {{-- <div wire:loading wire:target="image_temp" class="text-muted small mt-1">
                                                Uploading...</div> --}}
                                            <div wire:loading wire:target="image_temp"
                                                class="spinner-border spinner-border-sm text-primary mt-2"
                                                role="status"></div>
                                            @error('image_temp')
                                                <span class="text-danger small">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <!-- Image Preview Logic -->
                                        <div class="border rounded p-1 bg-light"
                                            style="width: 100px; height: 100px; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                                            @if ($image_temp)
                                                <img src="{{ $image_temp->temporaryUrl() }}" class="img-fluid rounded">
                                            @elseif ($image)
                                                <img src="{{ asset('storage/introductions/' . $image) }}" class="img-fluid rounded">
                                            @else
                                                <small class="text-muted">No Image</small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex gap-2 border-top pt-3">
                                <button type="submit"
                                    class="btn {{ $updateMode ? 'btn-warning' : 'btn-primary' }} px-4">
                                    <i class="bi bi-save me-1"></i> {{ $updateMode ? 'Update' : 'Save' }}
                                </button>
                                @if ($updateMode)
                                    <button type="button" wire:click="cancel" class="btn btn-outline-secondary px-4">
                                        Cancel
                                    </button>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Table Section -->
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                        <h6 class="mb-0 fw-bold text-secondary text-uppercase tracking-wider">
                            <i class="bi bi-list-ul me-2"></i>Introductions List
                        </h6>
                        <span class="badge bg-soft-primary text-primary rounded-pill px-3 py-2">
                            Total: {{ $introductions->count() }}
                        </span>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0" style="min-width: 900px;">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="ps-4 border-0 text-muted small fw-bold" width="80">ID</th>
                                        <th class="border-0 text-muted small fw-bold" width="120">PREVIEW</th>
                                        <th class="border-0 text-muted small fw-bold">HEADING</th>
                                        <th class="border-0 text-muted small fw-bold">SUB-HEADING</th>
                                        <th class="border-0 text-muted small fw-bold" width="300">DESCRIPTION</th>
                                        <th class="border-0 text-muted small fw-bold text-end pe-4">ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody class="border-top-0">
                                    @forelse ($introductions as $intro)
                                        <tr>
                                            <td class="ps-4">
                                                <span class="fw-medium text-secondary">#{{ $intro->id }}</span>
                                            </td>
                                            <td>
                                                @if ($intro->image)
                                                    <div class="rounded-3 overflow-hidden border shadow-sm"
                                                        style="width: 60px; height: 40px;">
                                                        <img src="{{ asset('storage/introductions/' . $intro->image) }}"
                                                            class="w-100 h-100" style="object-fit: cover;">
                                                    </div>
                                                @else
                                                    <div class="bg-light rounded d-flex align-items-center justify-content-center border"
                                                        style="width: 60px; height: 40px;">
                                                        <i class="bi bi-image text-muted"></i>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="fw-bold text-dark">{{ $intro->heading }}</span>
                                            </td>
                                            <td>
                                                <span class="text-secondary small">{{ $intro->sub_heading }}</span>
                                            </td>
                                            <td>
                                                <!-- Text truncation to keep row height consistent -->
                                                <p class="mb-0 text-muted small text-truncate"
                                                    style="max-width: 280px;">
                                                    {{ $intro->description }}
                                                </p>
                                            </td>
                                            <td class="text-end pe-4">
                                                <div class="btn-group shadow-sm" role="group">
                                                    <button wire:click="edit({{ $intro->id }})"
                                                        class="btn btn-white btn-sm border text-primary"
                                                        title="Edit Item">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </button>
                                                    <button wire:click="delete({{ $intro->id }})"
                                                        onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
                                                        class="btn btn-white btn-sm border text-danger"
                                                        title="Delete Item">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-5">
                                                <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png"
                                                    width="50" class="mb-3 opacity-25">
                                                <p class="text-muted fw-light">No introductions found in the database.
                                                </p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <style>
                    /* Professional UI Enhancements */
                    .bg-soft-primary {
                        background-color: #e7f1ff;
                    }

                    .btn-white {
                        background-color: #fff;
                    }

                    .btn-white:hover {
                        background-color: #f8f9fa;
                    }

                    .tracking-wider {
                        letter-spacing: 0.05em;
                    }

                    /* Fixed horizontal scroll for small screens */
                    .table-responsive {
                        scrollbar-width: thin;
                    }
                </style>
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
