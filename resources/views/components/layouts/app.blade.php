<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    {{-- Basic --}}
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    {{-- Responsive --}}
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- CSRF --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- SEO --}}
    <title>@yield('title', 'VYAK Global - Supplying Quality Worldwide')</title>
    <meta name="description" content="@yield('meta_description', 'VYAK Global - Supplying Quality Worldwide')">
    <meta name="keywords" content="@yield('meta_keywords', 'VYAK Global - Supplying Quality Worldwide')">
    <meta name="author" content="@yield('meta_author', 'VYAK Global - Supplying Quality Worldwide')">

    {{-- Open Graph (Social Share) --}}
    <meta property="og:title" content="@yield('og_title', config('app.name'))">
    <meta property="og:description" content="@yield('og_description', 'VYAK Global - Supplying Quality Worldwide')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="@yield('og_image', asset('images/og.png'))">

    {{-- Favicon --}}
    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('assest/images/DESIGN.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('assets/images/DESIGN.png') }}">

    {{-- Fonts (Example) --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Option 1: Include in HTML -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <!-- Navbar CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">


    <link href="{{ asset('assest/css/style.css') }}" type="text/css" rel="stylesheet">

    {{-- Vite Assets (Laravel 11 Default) --}}
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
<base href="{{ url('/') }}/">

    {{-- Livewire Styles --}}
    @livewireStyles

    {{-- Extra Head Content --}}
    @stack('styles')
</head>

<body class="antialiased">

    <style>
        :root {
            --primary-color: #4F46E5;
            --primary-hover: #4338CA;
            --sidebar-width: 250px;
            --topbar-height: 70px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #F9FAFB;
        }

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background: white;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
            z-index: 1000;
            overflow-y: auto;
        }

        .sidebar-logo {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid #E5E7EB;
        }

        .sidebar-logo h4 {
            color: var(--primary-color);
            font-weight: 700;
            margin: 0;
        }

        .sidebar-menu {
            padding: 20px 0;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 14px 24px;
            color: #6B7280;
            text-decoration: none;
            transition: all 0.3s ease;
            margin: 4px 12px;
            border-radius: 8px;
        }

        .menu-item:hover {
            background: #F3F4F6;
            color: var(--primary-color);
            transform: translateX(4px);
        }

        .menu-item.active {
            background: var(--primary-color);
            color: white;
        }

        .menu-item i {
            width: 24px;
            margin-right: 12px;
            font-size: 18px;
        }

        /* Top Navigation */
        .topbar {
            position: fixed;
            top: 0;
            left: var(--sidebar-width);
            right: 0;
            height: var(--topbar-height);
            background: white;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            z-index: 999;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
        }

        .page-title h3 {
            margin: 0;
            color: #111827;
            font-weight: 600;
        }

        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .search-box {
            position: relative;
        }

        .search-box input {
            width: 300px;
            padding: 10px 16px 10px 40px;
            border: 1px solid #E5E7EB;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .search-box input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .search-box i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #9CA3AF;
        }

        .notification-icon {
            position: relative;
            width: 40px;
            height: 40px;
            background: #F3F4F6;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .notification-icon:hover {
            background: #E5E7EB;
        }

        .notification-badge {
            position: absolute;
            top: -4px;
            right: -4px;
            background: #EF4444;
            color: white;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            font-size: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }

        .admin-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            padding: 8px 12px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .admin-profile:hover {
            background: #F3F4F6;
        }

        .admin-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--primary-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }

        .admin-info p {
            margin: 0;
            font-size: 14px;
            color: #111827;
            font-weight: 500;
        }
    </style>

    <div id="page-loader">
        <div aria-label="Loading..." role="status" class="loader">
            <svg class="icon" viewBox="0 0 256 256">
                <line x1="128" y1="32" x2="128" y2="64" stroke-linecap="round"
                    stroke-linejoin="round" stroke-width="24"></line>
                <line x1="195.9" y1="60.1" x2="173.3" y2="82.7" stroke-linecap="round"
                    stroke-linejoin="round" stroke-width="24"></line>
                <line x1="224" y1="128" x2="192" y2="128" stroke-linecap="round"
                    stroke-linejoin="round" stroke-width="24"></line>
                <line x1="195.9" y1="195.9" x2="173.3" y2="173.3" stroke-linecap="round"
                    stroke-linejoin="round" stroke-width="24"></line>
                <line x1="128" y1="224" x2="128" y2="192" stroke-linecap="round"
                    stroke-linejoin="round" stroke-width="24"></line>
                <line x1="60.1" y1="195.9" x2="82.7" y2="173.3" stroke-linecap="round"
                    stroke-linejoin="round" stroke-width="24"></line>
                <line x1="32" y1="128" x2="64" y2="128" stroke-linecap="round"
                    stroke-linejoin="round" stroke-width="24"></line>
                <line x1="60.1" y1="60.1" x2="82.7" y2="82.7" stroke-linecap="round"
                    stroke-linejoin="round" stroke-width="24"></line>
            </svg>
            <span class="loading-text">Loading...</span>
        </div>
    </div>

    {{-- Page Content --}}
    {{ $slot }}


    <style>
        #page-loader {
            position: fixed;
            inset: 0;
            background: #fffffff8;
            z-index: 99999;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        body.loader-active {
            overflow: hidden !important;
            height: 100vh;
        }

        /* From Uiverse.io by Yaya12085 */
        .loader {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .icon {
            height: 3rem;
            /* pehla 1.5rem hatu */
            width: 3rem;
            animation: spin 1s linear infinite;
            stroke: rgba(107, 114, 128, 1);
        }

        .loading-text {
            font-size: 1.2rem;
            line-height: 1rem;
            font-weight: 500;
            color: rgba(107, 114, 128, 1);
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }
    </style>


    <script>
        // Page start thay tya thi scroll lock
        document.body.classList.add('loader-active');

        window.addEventListener('load', function() {
            const loader = document.getElementById('page-loader');

            if (loader) {
                loader.style.transition = 'opacity 0.4s ease';
                loader.style.opacity = '0';

                setTimeout(() => {
                    loader.style.display = 'none';

                    // Scroll unlock only after loader fully removed
                    document.body.classList.remove('loader-active');
                }, 400);
            }
        });
    </script>



    <!-- --------------Enquiry Form------------------- -->

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <!-- modal-xl for a spacious side-by-side layout on desktop -->
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content border-0 shadow-lg rounded-5 overflow-hidden">

                <div class="modal-body p-0">
                    <div class="row g-0">

                        <!-- Left Panel: Information (Hidden on extra small screens, visible on MD+) -->
                        <div class="col-lg-5 bg-light p-5 d-none d-lg-flex flex-column justify-content-center">
                            <div class="mb-4">
                                <span
                                    class="badge bg-success-subtle text-success px-3 py-2 rounded-pill fw-bold mb-3">CONTACT
                                    US</span>
                                <h2 class="display-6 fw-bold text-dark">Let's grow your business <span
                                        class="text-success">together.</span></h2>
                                <p class="lead text-muted">Fill out the form and our strategy team will reach out
                                    within 24 hours.</p>
                            </div>

                            <div class="d-flex align-items-center mb-4">
                                <div class="bg-white shadow-sm rounded-3 p-3 me-3">
                                    <i class="bi bi-envelope-check text-success fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold">Email us</h6>
                                    <p class="mb-0 text-muted small">{{ $contact->email ?? 'not available' }}</p>
                                </div>
                            </div>

                            <div class="d-flex align-items-center mb-4">
                                <div class="bg-white shadow-sm rounded-3 p-3 me-3">
                                    <i class="bi bi-telephone-outbound text-success fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold">Call us</h6>
                                    <p class="mb-0 text-muted small">{{ $contact->phone ?? 'not available' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Right Panel: The Form -->
                        <div class="col-lg-7 p-4 p-md-5 bg-white">
                            <div class="d-flex justify-content-between align-items-start mb-4">
                                <div>
                                    <h4 class="fw-bold m-0">Send Enquiry</h4>
                                    <p class="text-muted small">Required fields are marked with *</p>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <form action="{{ route('contact.inquiry.store') }}" method="POST">
                                @csrf
                                <div class="row g-4">
                                    <!-- Full Name -->
                                    <div class="col-12">
                                        <label class="form-label fw-semibold">Full Name <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-transparent border-end-0"><i
                                                    class="bi bi-person text-muted"></i></span>
                                            <input type="text" class="form-control border-start-0 ps-0"
                                                name="name" placeholder="Enter your full name" required>
                                        </div>
                                    </div>

                                    <!-- Email -->
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Email Address <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-transparent border-end-0"><i
                                                    class="bi bi-envelope text-muted"></i></span>
                                            <input type="email" class="form-control border-start-0 ps-0"
                                                name="email" placeholder="email@example.com" required>
                                        </div>
                                    </div>

                                    <!-- Phone -->
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Phone Number</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-transparent border-end-0"><i
                                                    class="bi bi-phone text-muted"></i></span>
                                            <input type="tel" class="form-control border-start-0 ps-0"
                                                name="phone" placeholder="+1 (555) 000">
                                        </div>
                                    </div>

                                    <!-- Message -->
                                    <div class="col-12">
                                        <label class="form-label fw-semibold">How can we help? <span
                                                class="text-danger">*</span></label>
                                        <textarea class="form-control shadow-none" name="message" rows="4" placeholder="Tell us about your project..."
                                            required></textarea>
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="col-12 mt-4">
                                        <div class="row g-3">
                                            <div class="col-md-8">
                                                <button
                                                    class="btn btn-success btn-lg w-100 py-3 fw-bold rounded-3 shadow-sm"
                                                    type="submit">
                                                    Start Conversation <i class="bi bi-arrow-right ms-2"></i>
                                                </button>
                                            </div>
                                            <div class="col-md-4">
                                                <button type="button"
                                                    class="btn btn-outline-secondary btn-lg w-100 py-3 fw-bold rounded-3"
                                                    data-bs-dismiss="modal">
                                                    Cancel
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
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

    {{-- Livewire Scripts --}}
    @livewireScripts
    <script>
        var modal = document.getElementById("myModal");

        // Get the button that opens the modal
        var btn = document.getElementById("myBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on the button, open the modal
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

    <!-- ----------------END Enquairy Form------------------- -->



    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 1,
            spaceBetween: 10,
            autoplay: {
                delay: 1000,
                disableOnInteraction: false
            },
            loop: true, // Enable looping
            initialSlide: 0, // Start with the first slide

            pagination: {
                el: ".swiper-pagination",
                clickable: true,
                loop: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                340: {
                    slidesPerView: 2,
                    spaceBetween: 2,
                },
                640: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 3,
                    spaceBetween: 40,
                },
                1024: {
                    slidesPerView: 5,
                    spaceBetween: 8,
                },
            },
        });
    </script>


    <script>
        function googleTranslateElementInit() {

            new google.translate.TranslateElement({
                pageLanguage: 'en',
                layout: google.translate.TranslateElement.InlineLayout.SIMPLE
            }, 'google_translate_element');
        }
    </script>

    <script src="{{ asset('assest/js/main.js') }}"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous">
    </script>

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

    <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
    </script>

    {{-- Extra Scripts --}}
    @stack('scripts')
</body>

</html>
