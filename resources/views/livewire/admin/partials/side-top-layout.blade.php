<div>
    {{-- ================= Modern CSS ================= --}}
    <style>
        :root {
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --sidebar-bg: #ffffff;
            --sidebar-width: 280px;
            --topbar-height: 72px;
            --bg-body: #f8fafc;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --border-color: #e2e8f0;
            --card-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-body);
            color: var(--text-main);
            margin: 0;
        }

        /* --- Sidebar Modern Styling --- */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background: var(--sidebar-bg);
            border-right: 1px solid var(--border-color);
            z-index: 1040;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
        }

        .sidebar-logo {
            height: var(--topbar-height);
            display: flex;
            align-items: center;
            padding: 0 24px;
            margin-bottom: 10px;
        }

        .sidebar-logo h4 {
            margin: 0;
            font-size: 1.25rem;
            font-weight: 800;
            color: var(--primary);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* --- Navigation --- */
        .sidebar-menu {
            padding: 0 16px 1.5rem 16px;
            flex-grow: 1;
            overflow-y: auto;
        }

        .menu-label {
            padding: 20px 12px 10px;
            font-size: 0.7rem;
            text-transform: uppercase;
            font-weight: 700;
            color: var(--text-muted);
            letter-spacing: 1.2px;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 12px 16px;
            color: var(--text-muted);
            text-decoration: none;
            transition: all 0.2s ease;
            border-radius: 12px;
            margin-bottom: 4px;
            font-weight: 500;
            font-size: 0.925rem;
        }

        .menu-item i {
            font-size: 1.25rem;
            margin-right: 12px;
            transition: 0.2s;
        }

        .menu-item:hover {
            background: #f1f5f9;
            color: var(--primary);
        }

        .menu-item.active {
            background: var(--primary);
            color: #ffffff;
            box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.3);
        }

        .menu-item.active i {
            color: #ffffff;
        }

        .menu-item.text-danger:hover {
            background: #fef2f2;
            color: #dc2626;
        }

        /* --- Topbar Modern Styling --- */
        .topbar {
            position: fixed;
            top: 0;
            left: var(--sidebar-width);
            right: 0;
            height: var(--topbar-height);
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            padding: 0 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            z-index: 1000;
            border-bottom: 1px solid var(--border-color);
            transition: all 0.3s ease;
        }

        .page-title h3 {
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0;
            color: var(--text-main);
        }

        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        /* Search Box */
        .search-box {
            position: relative;
            display: none;
            /* Hide on small screens, show on large */
        }

        @media (min-width: 1200px) {
            .search-box {
                display: block;
            }
        }

        .search-box input {
            background: #f1f5f9;
            border: 1px solid transparent;
            padding: 8px 16px 8px 40px;
            border-radius: 10px;
            width: 240px;
            font-size: 0.875rem;
            outline: none;
            transition: 0.2s;
        }

        .search-box input:focus {
            background: #fff;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
        }

        .search-box i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
        }

        /* Profile Section */
        .admin-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 6px;
            padding-left: 12px;
            border-radius: 12px;
            cursor: pointer;
            transition: background 0.2s;
        }

        .admin-profile:hover {
            background: #f1f5f9;
        }

        .admin-avatar {
            width: 40px;
            height: 40px;
            background: var(--primary);
            color: white;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.9rem;
        }

        .admin-info p {
            margin: 0;
            font-weight: 600;
            font-size: 0.875rem;
        }

        /* --- Layout --- */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 32px;
            margin-top: var(--topbar-height);
            transition: all 0.3s ease;
        }

        /* --- Responsive Logic --- */
        #mobile-toggle {
            display: none;
            background: #f1f5f9;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 10px;
            cursor: pointer;
            color: var(--text-main);
        }

        @media (max-width: 992px) {
            .sidebar {
                left: calc(-1 * var(--sidebar-width));
                box-shadow: 20px 0 25px -5px rgba(0, 0, 0, 0.1);
            }

            .sidebar.show {
                left: 0;
            }

            .topbar {
                left: 0;
                padding: 0 20px;
            }

            .main-content {
                margin-left: 0;
                padding: 20px;
            }

            #mobile-toggle {
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .sidebar-overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(15, 23, 42, 0.5);
                backdrop-filter: blur(4px);
                z-index: 1030;
            }

            .sidebar-overlay.show {
                display: block;
            }

            .page-title h3 {
                font-size: 1.1rem;
            }
        }

        /* Scrollbar styling */
        .sidebar-menu::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar-menu::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }
    </style>

    {{-- ================= SIDEBAR ================= --}}
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <div class="sidebar" id="sidebar">
        <div class="sidebar-logo">
            <h4>
                <i class="bi bi-lightning-charge-fill"></i>
                <span>Smart Admin</span>
            </h4>
            <button class="btn ms-auto d-lg-none" onclick="toggleSidebar()">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>

        <nav class="sidebar-menu">
            <div class="menu-label">Main</div>
            <a href="{{ route('admin.dashboard') }}"
                class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2"></i>
                <span>Dashboard</span>
            </a>

            <div class="menu-label">Website Content</div>
            <a href="{{ route('admin.home-slider') }}"
                class="menu-item {{ request()->routeIs('admin.home-slider') ? 'active' : '' }}">
                <i class="bi bi-images"></i>
                <span>Sliders</span>
            </a>
            <a href="{{ route('admin.about-us-form') }}"
                class="menu-item {{ request()->routeIs('admin.about-us-form') ? 'active' : '' }}">
                <i class="bi bi-journal-text"></i>
                <span>About Us</span>
            </a>
            <a href="{{ route('admin.introduction-form') }}"
                class="menu-item {{ request()->routeIs('admin.introduction-form') ? 'active' : '' }}">
                <i class="bi bi-info-circle"></i>
                <span>Introduction</span>
            </a>

            <div class="menu-label">Inventory</div>
            <a href="{{ route('admin.product-hero-form') }}"
                class="menu-item {{ request()->routeIs('admin.product-hero-form') ? 'active' : '' }}">
                <i class="bi bi-window-stack"></i>
                <span>Products Spotlight</span>
            </a>
            <a href="{{ route('admin.category-form') }}"
                class="menu-item {{ request()->routeIs('admin.category-form') ? 'active' : '' }}">
                <i class="bi bi-collection"></i>
                <span>Categories</span>
            </a>
            <a href="{{ route('admin.products-form') }}"
                class="menu-item {{ request()->routeIs('admin.products-form') ? 'active' : '' }}">
                <i class="bi bi-box-seam"></i>
                <span>Products</span>
            </a>

            <a href="{{ route('admin.img-feature-form') }}"
                class="menu-item {{ request()->routeIs('admin.img-feature-form') ? 'active' : '' }}">
                <i class="bi bi-stars"></i>
                <span>Rotate Image Features</span>
            </a>

            <div class="menu-label">Trust Indicators</div>
            <a href="{{ route('admin.why-choose-form') }}"
                class="menu-item {{ request()->routeIs('admin.why-choose-form') ? 'active' : '' }}">
                <i class="bi bi-patch-check"></i>
                <span>Why Choose Us</span>
            </a>

            <div class="menu-label">Customer Relations</div>
            <a href="{{ route('admin.testimonial-form') }}"
                class="menu-item {{ request()->routeIs('admin.testimonial-form') ? 'active' : '' }}">
                <i class="bi bi-chat-heart"></i>
                <span>Testimonials</span>
            </a>
            <a href="{{ route('admin.contactus-form') }}"
                class="menu-item {{ request()->routeIs('admin.contactus-form') ? 'active' : '' }}">
                <i class="bi bi-envelope"></i>
                <span>Contact Messages</span>
            </a>

            <div class="menu-label">System</div>
            <a href="#" class="menu-item">
                <i class="bi bi-shield-lock"></i>
                <span>Settings</span>
            </a>
            <a href="#" class="menu-item text-danger"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right"></i>
                <span>Logout</span>
            </a>
        </nav>
    </div>

    {{-- ================= TOPBAR ================= --}}
    <div class="topbar">
        <div class="d-flex align-items-center">
            <button id="mobile-toggle" class="me-3">
                <i class="bi bi-list fs-4"></i>
            </button>
            <div class="page-title">
                <h3>{{ $title ?? 'Dashboard' }}</h3>
            </div>
        </div>

        <div class="topbar-actions">
            <div class="search-box">
                <i class="bi bi-search"></i>
                <input type="text" placeholder="Quick search...">
            </div>

            <div class="admin-profile">
                <div class="admin-info d-none d-md-block text-end">
                    <p>Admin User</p>
                    <small class="text-muted" style="font-size: 0.7rem;">Super Admin</small>
                </div>
                <div class="admin-avatar">AD</div>
            </div>
        </div>
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>

    <script>
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');

        function toggleSidebar() {
            sidebar.classList.toggle('show');
            overlay.classList.toggle('show');
        }

        document.querySelectorAll('#mobile-toggle').forEach(btn => {
            btn.addEventListener('click', toggleSidebar);
        });

        overlay.addEventListener('click', toggleSidebar);

        window.addEventListener('resize', () => {
            if (window.innerWidth > 992) {
                sidebar.classList.remove('show');
                overlay.classList.remove('show');
            }
        });
    </script>
</div>
