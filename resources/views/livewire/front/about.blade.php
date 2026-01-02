<div>

    <livewire:front.layout.header />

    <!-- Hero Section -->
    <section class="about-hero-section position-relative overflow-hidden">
        {{-- Overlay --}}
        <div class="hero-overlay position-absolute w-100 h-100" style="background: rgba(0, 0, 0, 0.5); z-index: 1;"></div>

        {{-- Hero Background Image --}}
        @if ($aboutUs && $aboutUs->hero_bg_image)
            <img src="{{ asset('storage/aboutus/' . $aboutUs->hero_bg_image) }}" class="w-100 object-fit-cover hero-img"
                alt="About Banner">
        @endif

        {{-- Content Center --}}
        <div class="container position-absolute top-50 start-50 translate-middle text-center text-white"
            style="z-index: 2;">
            <nav aria-label="breadcrumb" class="d-flex justify-content-center mb-2">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"
                            class="text-white-50 text-decoration-none">Home</a>
                    </li>
                    <li class="breadcrumb-item active text-white fw-bold" aria-current="page">About Us</li>
                </ol>
            </nav>

            <h1 class="display-3 fw-extrabold text-uppercase hero-title">
                About <span class="text-brown-light">Us</span>
            </h1>

            <div class="mx-auto bg-brown-light mt-2" style="height: 4px; width: 60px; border-radius: 2px;"></div>
        </div>
    </section>

    <!-- Story Section -->
    <section class="py-5 mt-lg-5">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-5">
                    <span class="text-brown fw-bold text-uppercase mb-2 d-block" style="letter-spacing: 2px;">
                        Established & Trusted
                    </span>
                    <h2 class="display-5 fw-bold mb-4">
                        "{{ $aboutUs->about_heading ?? 'Our Story of Decades' }}"
                    </h2>
                    <p class="lead text-muted fst-italic">
                        {!! $aboutUs->small_descri ?? '' !!}
                    </p>
                    <div class="bg-brown mb-4" style="height: 4px; width: 80px;"></div>
                </div>
                <div class="col-lg-7">
                    <div class="ps-lg-4 border-start border-4 border-light">
                        {!! $aboutUs->about_full_desc ?? '' !!}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section (New: Adds credibility) -->
    <section class="py-5 bg-brown text-white">
        <div class="container text-center">
            <div class="row g-4">
                <div class="col-md-4">
                    <h2 class="fw-bold display-4 mb-0">20+</h2>
                    <p class="text-uppercase small fw-light">Years of Experience</p>
                </div>
                <div class="col-md-4 border-start border-end border-white border-opacity-25">
                    <h2 class="fw-bold display-4 mb-0">50+</h2>
                    <p class="text-uppercase small fw-light">Global Destinations</p>
                </div>
                <div class="col-md-4">
                    <h2 class="fw-bold display-4 mb-0">100%</h2>
                    <p class="text-uppercase small fw-light">Pesticide Free</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Clipping Mask Text -->
    <section class="py-5 bg-light position-relative">
        <div class="container">
            <div class="py-5 text-center">
                <h2 class="display-6 fw-bold text-dark opacity-75 mb-0" style="letter-spacing: 1px; line-height: 1.4;">
                    We Serve <span class="text-brown">Awesome Products</span> For<br>
                    Our Clients Around The World.
                </h2>
            </div>
        </div>
    </section>


    <!-------------------------Mission And Vision Start--------------------->
    <div class="container-fluid mission-vision">
        <div class="container mt-4">

            <div class="row justify-content-end">
                <div class="col-md-6 py-4 px-5 box mt-3">
                    <h4 class="mt-4 text-white">
                        <i class="bi bi-bullseye"></i> Our Mission
                    </h4>
                    <hr>
                    <p class="mb-4 fs-5 text-white" style="letter-spacing: 2px;">
                        {!! $aboutUs->mission_description ?? '' !!}
                    </p>
                </div>
            </div>

            <div class="row justify-content-start">
                <div class="col-md-6 py-4 px-5 box1 mb-3">
                    <h4 class="mt-4 text-white">
                        <i class="bi bi-eye"></i> Our Vision
                    </h4>
                    <hr>
                    <p class="mb-4 fs-5 text-white" style="letter-spacing: 2px;">
                        {!! $aboutUs->vision_description ?? '' !!}
                    </p>
                </div>
            </div>

        </div>
    </div>
    <!-------------------------Mission And Vision End--------------------->

    <livewire:front.layout.footer />

    <style>
        /* Add this to your CSS file */
        /* Hero Section Heights */
        .about-hero-section {
            height: 300px;
            /* Mobile Default */
        }

        .hero-img {
            height: 100%;
            object-fit: cover;
        }

        @media (min-width: 768px) {
            .about-hero-section {
                height: 450px;
                /* Tablet/Desktop */
            }
        }

        /* Typography Enhancements */
        .hero-title {
            letter-spacing: 6px;
            text-shadow: 2px 4px 10px rgba(0, 0, 0, 0.3);
            font-weight: 800;
        }

        .text-brown-light {
            color: #d4a373;
            /* Example light brown/gold color */
        }

        .bg-brown-light {
            background-color: #d4a373;
        }

        /* Breadcrumb Styling */
        .breadcrumb-item+.breadcrumb-item::before {
            content: "|";
            /* Modern separator */
            color: rgba(255, 255, 255, 0.5);
            padding: 0 10px;
        }

        .breadcrumb-item a:hover {
            color: #fff !important;
            text-shadow: 0 0 5px rgba(255, 255, 255, 0.5);
        }

        /* Ensure the container stays centered on all screens */
        .hero-title {
            font-size: calc(1.8rem + 2.5vw);
            /* Fluid typography */
        }

        .text-brown {
            color: #8b5e3c !important;
        }

        /* Use your brand color */
        .bg-brown {
            background-color: #8b5e3c !important;
        }

        .object-fit-cover {
            object-fit: cover;
        }

        /* Card Hover Animation */
        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175) !important;
        }

        .border-brown {
            border-color: #8b5e3c !important;
        }
    </style>

</div>
