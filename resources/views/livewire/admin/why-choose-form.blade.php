<div>

    @include('livewire.admin.partials.side-top-layout', ['title' => 'Why Choose Us Management'])


    <!-- Main Wrapper -->
    <div class="main-content py-4 px-md-5 bg-light min-vh-100">

        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="h4 fw-bold mb-0 text-dark">Management Dashboard</h2>
                <p class="text-muted small">Manage your titles, subtitles, and media records.</p>
            </div>

            <a href="{{ route('admin.why-choose-feature') }}"
                class="btn btn-outline-danger p-2 btn-attention {{ request()->routeIs('admin.why-choose-feature') ? 'active' : '' }}">
                <i class="bi bi-exclamation-circle me-1"></i>
                <span>Update Why Features</span>
            </a>
        </div>

        <!-- Form Section: Modern Card with Grid -->
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
            <!-- Header with Gradient Hint -->
            <div class="card-header bg-white border-bottom py-3 d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 p-2 rounded-3 me-3">
                        <i class="bi {{ $updateMode ? 'bi-pencil-square' : 'bi-plus-circle' }} text-primary fs-5"></i>
                    </div>
                    <h5 class="card-title mb-0 fw-bold text-dark">
                        {{ $updateMode ? 'Edit Product Record' : 'Create New Record' }}
                    </h5>
                </div>
                <span class="badge bg-light text-muted border fw-normal">Version 2.0</span>
            </div>

            <div class="card-body p-0">
                <form wire:submit.prevent="{{ $updateMode ? 'update' : 'store' }}">

                    <!-- SECTION 1: TEXT CONTENT -->
                    <div class="p-4 bg-white">
                        <p class="text-uppercase small fw-bold text-primary mb-3 tracking-wider">1. General Information
                        </p>
                        <div class="row g-4">
                            <!-- Title Input -->
                            <div class="col-md-8">
                                <div class="form-floating shadow-sm">
                                    <input type="text" wire:model="title"
                                        class="form-control border-0 bg-light @error('title') is-invalid @enderror"
                                        id="title" placeholder="Enter Title">
                                    <label for="title" class="text-muted">Record Title</label>
                                </div>
                                @error('title')
                                    <div class="text-danger extra-small mt-1 ps-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Status Select -->
                            <div class="col-md-4">
                                <div class="form-floating shadow-sm">
                                    <select wire:model="status" class="form-select border-0 bg-light" id="status">
                                        <option value="1">🟢 Active / Visible</option>
                                        <option value="0">⚪ Inactive / Hidden</option>
                                    </select>
                                    <label for="status">Display Status</label>
                                </div>
                            </div>

                            <!-- Subtitle Textarea -->
                            <div class="col-12">
                                <div class="form-floating shadow-sm">
                                    <textarea wire:model="subtitle" class="form-control border-0 bg-light @error('subtitle') is-invalid @enderror"
                                        id="subtitle" style="height: 120px" placeholder="Subtitle description"></textarea>
                                    <label for="subtitle" class="text-muted">Brief Description / Subtitle</label>
                                </div>
                                @error('subtitle')
                                    <div class="text-danger extra-small mt-1 ps-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- SECTION 2: MEDIA ASSETS -->
                    <div class="p-4 bg-light border-top border-bottom">
                        <p class="text-uppercase small fw-bold text-primary mb-3 tracking-wider">2. Media Assets</p>
                        <div class="row g-4">

                            <!-- Main Image Widget -->
                            <div class="col-lg-6">
                                <div
                                    class="upload-widget p-3 rounded-4 bg-white border border-dashed text-center position-relative">
                                    <label class="form-label d-block fw-bold small text-muted text-start mb-3">Main
                                        Cover Image</label>

                                    <div class="preview-container mb-3 mx-auto">
                                        @if ($main_image)
                                            <img src="{{ $main_image->temporaryUrl() }}"
                                                class="img-preview shadow rounded-4">
                                        @elseif(isset($existing_main_image) && $existing_main_image)
                                            <img src="{{ asset('storage/' . $existing_main_image) }}"
                                                class="img-preview shadow rounded-4">
                                        @else
                                            <div class="placeholder-box rounded-4">
                                                <i class="bi bi-cloud-arrow-up fs-1 opacity-25"></i>
                                                <p class="small text-muted mb-0">No file selected</p>
                                            </div>
                                        @endif

                                        <!-- Loading Overlay -->
                                        <div wire:loading wire:target="main_image" class="loading-overlay rounded-4">
                                            <div class="spinner-border text-primary" role="status"></div>
                                        </div>
                                    </div>

                                    <input type="file" wire:model="main_image"
                                        class="form-control form-control-sm custom-file-input" id="main_image">
                                    @error('main_image')
                                        <div class="text-danger extra-small mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Background Image Widget -->
                            <div class="col-lg-6">
                                <div
                                    class="upload-widget p-3 rounded-4 bg-white border border-dashed text-center position-relative">
                                    <label
                                        class="form-label d-block fw-bold small text-muted text-start mb-3">Background
                                        Texture/Image</label>

                                    <div class="preview-container mb-3 mx-auto">
                                        @if ($bg_img)
                                            <img src="{{ $bg_img->temporaryUrl() }}"
                                                class="img-preview shadow rounded-4">
                                        @elseif(isset($existing_bg_img) && $existing_bg_img)
                                            <img src="{{ asset('storage/' . $existing_bg_img) }}"
                                                class="img-preview shadow rounded-4">
                                        @else
                                            <div class="placeholder-box rounded-4">
                                                <i class="bi bi-images fs-1 opacity-25"></i>
                                                <p class="small text-muted mb-0">No file selected</p>
                                            </div>
                                        @endif

                                        <!-- Loading Overlay -->
                                        <div wire:loading wire:target="bg_img" class="loading-overlay rounded-4">
                                            <div class="spinner-border text-primary" role="status"></div>
                                        </div>
                                    </div>

                                    <input type="file" wire:model="bg_img"
                                        class="form-control form-control-sm custom-file-input" id="bg_img">
                                    @error('bg_img')
                                        <div class="text-danger extra-small mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- FOOTER: ACTIONS -->
                    <div class="p-4 bg-white d-flex flex-column flex-md-row justify-content-end gap-2">
                        @if ($updateMode)
                            <button type="button" wire:click="resetInputFields"
                                class="btn btn-light border px-4 py-2 rounded-3 text-muted">
                                <i class="bi bi-x-circle me-1"></i> Cancel
                            </button>
                        @endif
                        <button type="submit" class="btn btn-primary px-5 py-2 fw-bold rounded-3 shadow">
                            <i class="bi bi-check2-circle me-1"></i>
                            {{ $updateMode ? 'Update Database Record' : 'Finalize & Save Record' }}
                        </button>
                    </div>

                </form>
            </div>
        </div>

        <!-- Table Section: Responsive Professional Table -->
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0 fw-bold">Recent Records</h5>
                <span class="badge bg-light text-dark border fw-normal">{{ $records->total() }} Total items</span>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 text-muted small text-uppercase fw-bold">ID</th>
                            <th class="text-muted small text-uppercase fw-bold">WhyChoose Tital Img</th>
                            <th class="text-muted small text-uppercase fw-bold">WhyChoose BG Img</th>
                            <th class="text-muted small text-uppercase fw-bold d-none d-md-table-cell">Description</th>
                            <th class="text-muted small text-uppercase fw-bold">Status</th>
                            <th class="text-muted small text-uppercase fw-bold text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($records as $record)
                            <tr>
                                <td class="ps-4">
                                    <span class="fw-bold text-muted">#{{ $record->id }}</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if ($record->main_image)
                                            <img src="{{ asset('storage/whychoose/' . $record->main_image) }}"
                                                class="rounded shadow-sm me-3 border" width="45" height="45"
                                                style="object-fit: cover;">
                                        @else
                                            <div class="bg-light rounded text-muted d-flex align-items-center justify-content-center me-3 border"
                                                style="width: 45px; height: 45px;">
                                                <i class="bi bi-image"></i>
                                            </div>
                                        @endif
                                        <div class="fw-bold text-dark">{{ $record->title }}</div>
                                    </div>
                                </td>

                                <td>
                                    <div class="d-flex align-items-center">
                                        @if ($record->bg_img)
                                            <img src="{{ asset('storage/whychoose/' . $record->bg_img) }}"
                                                class="rounded shadow-sm me-3 border" width="45" height="45"
                                                style="object-fit: cover;">
                                        @else
                                            <div class="bg-light rounded text-muted d-flex align-items-center justify-content-center me-3 border"
                                                style="width: 45px; height: 45px;">
                                                <i class="bi bi-image"></i>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td class="d-none d-md-table-cell">
                                    <small class="text-muted text-truncate d-inline-block" style="max-width: 200px;">
                                        {{ $record->subtitle }}
                                    </small>
                                </td>
                                <td>
                                    @if ($record->status)
                                        <span
                                            class="badge rounded-pill bg-success-subtle text-success border border-success px-3">Active</span>
                                    @else
                                        <span
                                            class="badge rounded-pill bg-secondary-subtle text-secondary border border-secondary px-3">Inactive</span>
                                    @endif
                                </td>
                                <td class="text-end pe-4">
                                    <div class="btn-group shadow-sm">
                                        <button wire:click="edit({{ $record->id }})"
                                            class="btn btn-sm btn-white border" title="Edit">
                                            <i class="bi bi-pencil-fill text-warning"></i>
                                        </button>
                                        <button wire:click="delete({{ $record->id }})"
                                            class="btn btn-sm btn-white border"
                                            onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
                                            title="Delete">
                                            <i class="bi bi-trash-fill text-danger"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer bg-white border-top py-3 px-4">
                {{ $records->links() }}
            </div>
        </div>
    </div>


    <style>
        .tracking-wider {
            letter-spacing: 0.08em;
        }

        .extra-small {
            font-size: 0.75rem;
        }

        .bg-light {
            background-color: #f8f9fa !important;
        }

        /* Custom Input Style */
        .form-control:focus,
        .form-select:focus {
            background-color: #fff !important;
            box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1) !important;
            border-color: #0d6efd !important;
        }

        /* Media Widget Styling */
        .upload-widget {
            transition: all 0.3s ease;
        }

        .upload-widget:hover {
            border-color: #0d6efd !important;
            background-color: #fff !important;
        }

        .preview-container {
            width: 100%;
            height: 160px;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .img-preview {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .placeholder-box {
            width: 100%;
            height: 100%;
            background-color: #f1f3f5;
            border: 2px dashed #dee2e6;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        /* Loading Spinner Overlay */
        .loading-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.8);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 5;
        }

        /* Custom File Input button style */
        .custom-file-input::-webkit-file-upload-button {
            visibility: hidden;
        }

        .custom-file-input::before {
            content: '📂 Choose New File';
            display: inline-block;
            background: #fff;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 5px 15px;
            outline: none;
            white-space: nowrap;
            cursor: pointer;
            font-weight: 600;
            font-size: 13px;
        }

        .custom-file-input:hover::before {
            border-color: #0d6efd;
        }

        .btn-attention {
            animation: attention-shake 4s ease infinite;
            transform-origin: center;
        }

        @keyframes attention-shake {

            0%,
            80%,
            100% {
                transform: rotate(0deg) scale(1);
            }

            85% {
                transform: rotate(5deg) scale(1.05);
            }

            90% {
                transform: rotate(-5deg) scale(1.05);
            }

            95% {
                transform: rotate(5deg) scale(1.05);
            }
        }

        /* Red pulse shadow */
        .btn-attention {
            box-shadow: 0 0 0 rgba(220, 53, 69, 0.4);
            animation: attention-shake 4s ease infinite, pulse-red 2s infinite;
        }

        @keyframes pulse-red {
            0% {
                box-shadow: 0 0 0 0 rgba(220, 53, 69, 0.7);
            }

            70% {
                box-shadow: 0 0 0 10px rgba(220, 53, 69, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(220, 53, 69, 0);
            }
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
