<div>
    @include('livewire.admin.partials.side-top-layout', ['title' => 'Contact Page Management'])

    <div class="main-content py-4 px-3">

        <!-- Form Card -->
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h4 class="fw-bold text-dark mb-1">
                    {{ $updateMode ? 'Edit Contact Page' : 'Create New Contact Page' }}
                </h4>
                <p class="text-muted small mb-0">Manage how customers see your contact information and location.</p>
            </div>
            <div>
                <a href="{{ route('home') }}" target="_blank"
                    class="btn btn-outline-secondary btn-sm rounded-pill px-3">View Live
                    Page</a>
            </div>
        </div>

        <div class="row g-4">
            <!-- Main Content Column (Left) -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="card-header bg-white border-0 pt-4 px-4">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary-subtle text-primary p-2 rounded-3 me-3">
                                <i class="bi bi-info-circle-fill fs-5"></i>
                            </div>
                            <h6 class="fw-bold mb-0">General Information</h6>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-3">
                            <div class="col-md-7">
                                <label class="form-label small fw-bold">Page Heading</label>
                                <div class="input-group border rounded-3 overflow-hidden transition-shadow">
                                    <span class="input-group-text bg-white border-0"><i
                                            class="bi bi-type-h1 text-muted"></i></span>
                                    <input type="text" wire:model="heading"
                                        class="form-control border-0 shadow-none ps-0" placeholder="e.g. Get in Touch">
                                </div>
                                @error('heading')
                                    <div class="text-danger tiny-mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-5">
                                <label class="form-label small fw-bold">Support Email</label>
                                <div class="input-group border rounded-3 overflow-hidden">
                                    <span class="input-group-text bg-white border-0"><i
                                            class="bi bi-envelope text-muted"></i></span>
                                    <input type="email" wire:model="email"
                                        class="form-control border-0 shadow-none ps-0" placeholder="support@brand.com">
                                </div>
                            </div>

                            <div class="col-12 mt-3">
                                <label class="form-label small fw-bold">Description text</label>
                                <textarea wire:model="description" class="form-control border rounded-3" rows="3"
                                    placeholder="Write a short intro..."></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="card-header bg-white border-0 pt-2 px-4">
                        <div class="d-flex align-items-center">
                            <div class="bg-danger-subtle text-danger p-2 rounded-3 me-3">
                                <i class="bi bi-geo-alt-fill fs-5"></i>
                            </div>
                            <h6 class="fw-bold mb-0">Location & Maps</h6>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label small fw-bold">Physical Address</label>
                                <textarea wire:model="address" class="form-control border rounded-3" rows="2"
                                    placeholder="Street name, City, State, Zip"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Phone Number</label>
                                <input type="text" wire:model="phone" class="form-control border rounded-3"
                                    placeholder="+1 (234) 567-890">
                            </div>
                            <div class="col-12 mt-3">
                                <label class="form-label small fw-bold">Google Map Iframe</label>
                                <div class="position-relative">
                                    <textarea wire:model="google_map_iframe" class="form-control border rounded-3 bg-light font-monospace small"
                                        style="height: 100px;" placeholder="<iframe src='...'></iframe>"></textarea>
                                    @if ($google_map_iframe)
                                        <div class="mt-2 rounded-3 overflow-hidden border" style="height: 150px;">
                                            {!! $google_map_iframe !!}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar Column (Right) -->
            <div class="col-lg-4">

                <!-- Social Links Card -->
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body p-4">
                        <h6 class="fw-bold mb-3">Social Connectivity</h6>

                        <div class="mb-3">
                            <label class="small text-muted mb-1">Facebook</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text bg-white border-end-0"><i
                                        class="bi bi-facebook text-primary"></i></span>
                                <input type="text" wire:model="facebook_url" class="form-control border-start-0"
                                    placeholder="URL">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="small text-muted mb-1">Instagram</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text bg-white border-end-0"><i
                                        class="bi bi-instagram text-danger"></i></span>
                                <input type="text" wire:model="instagram_url" class="form-control border-start-0"
                                    placeholder="URL">
                            </div>
                        </div>

                        <div class="mb-0">
                            <label class="small text-muted mb-1">LinkedIn</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text bg-white border-end-0"><i
                                        class="bi bi-linkedin text-info"></i></span>
                                <input type="text" wire:model="linkedin_url" class="form-control border-start-0"
                                    placeholder="URL">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Visibility Card -->
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-4">
                        <h6 class="fw-bold mb-3">Publishing</h6>
                        <div class="d-flex align-items-center justify-content-between p-3 bg-light rounded-3 mb-4">
                            <span class="small fw-bold text-secondary">Is Active?</span>
                            <div class="form-check form-switch p-0 m-0">
                                <input wire:key="is_active_toggle" class="form-check-input ms-0" type="checkbox"
                                    role="switch" wire:model="is_active" style="width: 40px; height: 20px;">
                            </div>
                        </div>

                        <button wire:click="{{ $updateMode ? 'update' : 'store' }}"
                            class="btn btn-primary w-100 py-3 rounded-3 shadow-sm fw-bold mb-2"
                            wire:loading.attr="disabled">
                            <span wire:loading.remove>
                                <i class="bi {{ $updateMode ? 'bi-cloud-check' : 'bi-plus-lg' }} me-2"></i>
                                {{ $updateMode ? 'Update Content' : 'Publish Page' }}
                            </span>
                            <span wire:loading>
                                <span class="spinner-border spinner-border-sm me-2"></span> Saving...
                            </span>
                        </button>

                        @if ($updateMode)
                            <button wire:click="resetInput"
                                class="btn btn-link w-100 text-muted text-decoration-none small">Discard
                                Changes</button>
                        @endif
                    </div>
                </div>

            </div>
        </div>

        <!-- Table Card -->
        <div class="card border-0 shadow-sm mt-4">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h5 class="fw-bold mb-0 text-dark">Contact Page Records</h5>
                <span class="badge bg-primary-subtle text-primary rounded-pill px-3">{{ $records->total() }}
                    Total</span>
            </div>

            <div class="table-responsive-lg">
                <table class="table table-hover align-middle mb-0 custom-responsive-table">
                    <thead class="bg-light text-muted text-uppercase small">
                        <tr>
                            <th class="ps-4 border-0" style="min-width:180px;">Heading</th>
                            <th class="border-0" style="min-width:200px;">Contact Info</th>
                            <th class="border-0" style="min-width:250px;">Address</th>
                            <th class="border-0" style="min-width:120px;">Status</th>
                            <th class="text-end pe-4 border-0" style="min-width:140px;">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($records as $row)
                            <tr>
                                <!-- data-label is for mobile view -->
                                <td data-label="Heading" class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="avatar-sm px-2 me-3 bg-primary-subtle text-primary rounded-circle d-none d-lg-flex align-items-center justify-content-center fw-bold">
                                            {{ substr($row->id, 0, 2) }}
                                        </div>
                                        <div>
                                            <span class="fw-bold text-dark d-block">{{ $row->heading }}</span>
                                            <small class="text-muted">ID: #{{ $row->id }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td data-label="Contact">
                                    <div class="d-flex flex-column">
                                        <span class="small"><i
                                                class="bi bi-envelope-at me-2 text-success"></i>{{ $row->email }}</span>
                                        <span class="small text-muted"><i
                                                class="bi bi-telephone me-2 text-primary"></i>{{ $row->phone ?? 'N/A' }}</span>
                                    </div>
                                </td>
                                <td data-label="Address">
                                    <div class="text-wrap small" style="max-width: 250px;">
                                        <i class="bi bi-geo-alt me-1 text-danger"></i> {{ $row->address }}
                                    </div>
                                </td>
                                <td data-label="Status">
                                    @if ($row->is_active)
                                        <span
                                            class="badge rounded-pill bg-success-subtle text-success border-success px-3">Active</span>
                                    @else
                                        <span
                                            class="badge rounded-pill bg-secondary-subtle text-secondary border-secondary px-3">Inactive</span>
                                    @endif
                                </td>
                                <td data-label="Actions" class="text-end pe-4">
                                    <div class="btn-group shadow-sm rounded">
                                        <button wire:click="edit({{ $row->id }})"
                                            class="btn btn-white btn-sm border" title="Edit">
                                            <i class="bi bi-pencil-square text-warning"></i>
                                        </button>
                                        <button
                                            onclick="confirm('Delete this record?') || event.stopImmediatePropagation()"
                                            wire:click="delete({{ $row->id }})"
                                            class="btn btn-white btn-sm border text-danger" title="Delete">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" width="80"
                                        class="mb-3 opacity-50">
                                    <p class="text-muted">No records found in the database.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="card-footer bg-white py-3">
                {{ $records->links() }}
            </div>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="position-fixed top-0 end-0 m-3 alert alert-success alert-dismissible fade show shadow rounded"
            role="alert" style="min-width: 220px; max-width: 350px; z-index: 1050; padding-right: 2.5rem;"
            x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)">
            <i class="bi bi-check-circle-fill text-success me-2"></i> {{ session('message') }}
            <button type="button" class="btn-close position-absolute top-50 end-0 translate-middle-y me-2 p-1"
                data-bs-dismiss="alert" aria-label="Close" style="width: 0.4rem; height: 0.4rem;"></button>
        </div>
    @endif

</div>
