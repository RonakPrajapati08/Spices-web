<div>
    <style>
        :root {
            --primary-color: #4F46E5;
            --primary-hover: #4338CA;
            --sidebar-width: 250px;
            --topbar-height: 70px;
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            margin-top: var(--topbar-height);
            padding: 30px;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 24px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transform: translateY(-4px);
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
        }

        .stat-title {
            color: #6B7280;
            font-size: 14px;
            font-weight: 500;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }

        .stat-icon.blue {
            background: #DBEAFE;
            color: #2563EB;
        }

        .stat-icon.green {
            background: #D1FAE5;
            color: #10B981;
        }

        .stat-icon.purple {
            background: #E9D5FF;
            color: #9333EA;
        }

        .stat-icon.orange {
            background: #FED7AA;
            color: #F97316;
        }

        .stat-number {
            font-size: 32px;
            font-weight: 700;
            color: #111827;
        }

        /* Table Section */
        .table-section {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .section-title {
            font-size: 18px;
            font-weight: 600;
            color: #111827;
        }

        .view-all-btn {
            color: var(--primary-color);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .view-all-btn:hover {
            color: var(--primary-hover);
        }

        .custom-table {
            width: 100%;
            margin-top: 16px;
        }

        .custom-table thead {
            background: #F9FAFB;
        }

        .custom-table th {
            padding: 14px 16px;
            text-align: left;
            font-size: 13px;
            font-weight: 600;
            color: #6B7280;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: none;
        }

        .custom-table td {
            padding: 16px;
            border-bottom: 1px solid #F3F4F6;
            color: #374151;
        }

        .custom-table tbody tr {
            transition: all 0.2s ease;
        }

        .custom-table tbody tr:hover {
            background: #F9FAFB;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        .status-badge.new {
            background: #DBEAFE;
            color: #1E40AF;
        }

        .status-badge.replied {
            background: #D1FAE5;
            color: #065F46;
        }

        .status-badge.pending {
            background: #FEF3C7;
            color: #92400E;
        }

        .action-btn {
            padding: 6px 12px;
            border: none;
            border-radius: 6px;
            font-size: 13px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-right: 6px;
        }

        .action-btn.view {
            background: #EEF2FF;
            color: var(--primary-color);
        }

        .action-btn.view:hover {
            background: var(--primary-color);
            color: white;
        }

        .action-btn.delete {
            background: #FEE2E2;
            color: #DC2626;
        }

        .action-btn.delete:hover {
            background: #DC2626;
            color: white;
        }

        /* Responsive Design */
        /* @media (max-width: 768px) {
            .sidebar {
                width: 70px;
            }

            .sidebar-logo h4,
            .menu-item span {
                display: none;
            }

            .menu-item {
                justify-content: center;
            }

            .topbar {
                left: 70px;
            }

            .main-content {
                margin-left: 70px;
            }

            .search-box input {
                width: 200px;
            }

            .admin-info {
                display: none;
            }
        } */
    </style>

    @include('livewire.admin.partials.side-top-layout', ['title' => 'Dashboard Overview'])

    <!-- Main Content -->
    <div class="main-content">
        <!-- Statistics Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <a href="{{ route('admin.home-slider') }}" class="text-decoration-none">
                    <div class="stat-header">
                        <span class="stat-title">Home Sliders</span>
                        <div class="stat-icon blue">
                            <i class="bi bi-images"></i>
                        </div>
                    </div>
                    <div class="stat-number">{{ $sliderCount }}</div>
                </a>
            </div>

            <div class="stat-card">
                <a href="{{ route('admin.products-form') }}" class="text-decoration-none">
                    <div class="stat-header">
                        <span class="stat-title">Products</span>
                        <div class="stat-icon green">
                            <i class="bi bi-box-seam"></i>
                        </div>
                    </div>
                    <div class="stat-number">{{ $productsCount }}</div>
                </a>

            </div>

            <div class="stat-card">
                <a href="{{ route('admin.testimonial-form') }}" class="text-decoration-none">
                    <div class="stat-header">
                        <span class="stat-title">Testimonials</span>
                        <div class="stat-icon purple">
                            <i class="bi bi-star"></i>
                        </div>
                    </div>
                    <div class="stat-number">{{ $testimonialsCount }}</div>
                </a>
            </div>

            <div class="stat-card">
                <a href="{{ route('admin.dashboard') }}" class="text-decoration-none">
                    <div class="stat-header">
                        <span class="stat-title">Contact Queries</span>
                        <div class="stat-icon orange">
                            <i class="bi bi-envelope"></i>
                        </div>
                    </div>
                    <div class="stat-number">{{ $inquiriesCount }}</div>
                </a>
            </div>

        </div>

        <!-- Recent Contact Messages -->
        <div class="table-section">
            <div class="section-header">
                <h2 class="section-title">Recent Contact Messages</h2>
                {{-- <a href="{{ route('admin.inquiries') }}" class="view-all-btn">
                    View All <i class="fas fa-arrow-right"></i>
                </a> --}}
            </div>

            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($inquiries as $inquiry)
                        <tr>
                            <td>{{ $inquiry->name }}</td>

                            <td>{{ $inquiry->email }}</td>

                            <td style="max-width: 300px;">
                                {{ Str::limit($inquiry->message, 80) }}
                            </td>

                            <td>{{ $inquiry->created_at->format('d M Y') }}</td>

                            <td>
                                <button class="action-btn delete" wire:click="delete({{ $inquiry->id }})"
                                    onclick="confirm('Are you sure?') || event.stopImmediatePropagation()">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">
                                No inquiries found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-4">
                {{ $inquiries->links() }}
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
