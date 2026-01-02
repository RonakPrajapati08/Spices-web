<div>

    <livewire:front.layout.header />

    <!-------------------------Slider Section Start--------------------->
    <section>
        <div class="container-fluid fst-italic">
            <div id="carouselExampleFade" class="carousel slide carousel-fade pt-24" data-bs-ride="carousel">
                <div class="carousel-inner">

                    @foreach ($sliders as $key => $slider)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}" data-bs-interval="2000">
                            <img src="{{ asset('storage/sliders/' . $slider->image) }}" class="d-block img-fluid asp"
                                alt="">
                            <div class="carousel-caption bg-b">
                                <h1 class="fs-1 fs-xs-3 d-block">{{ $slider->title ?? '' }}</h1>
                                <p class="fs-1">{{ $slider->subtitle ?? '' }}</p>
                            </div>
                        </div>
                    @endforeach

                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade"
                    data-bs-slide="prev">
                    <i class="bi bi-arrow-left-circle-fill fs-2"></i>
                </button>

                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade"
                    data-bs-slide="next">
                    <i class="bi bi-arrow-right-circle-fill fs-2"></i>
                </button>
            </div>
        </div>
    </section>

    <!-------------------------Slider Section End--------------------->


    <!-------------------------Header Section Start--------------------->
    {{-- <section class="header my-2">
        <div class="container text-center header">
            <div class="row justify-content-between">

                <div class="image">
                    <img src="{{ asset('assest/images/spices-float.png') }}" class="img-fluid">
                </div>

                <div class="col-md-5" data-aos="fade-right">
                    <h2 class="heading_spice text-md-center">Our Introduction</h2>
                    <h1 class="mt-4 text-md-center">
                        Exam Exim, India's first integrated
                        <span class="Tagline">Pulses & Spices</span> company
                    </h1>
                </div>

                <div class="col-md-7" data-aos="fade-left">
                    <h4 class="mt-4">
                        "We are leading exporter, manufacturer, processor of finest quality spices and pulses"
                    </h4>

                    <p class="mt-3 letter-space">
                        <b>
                            Discover each fresh spice you require for a fully stocked kitchen...
                        </b>
                    </p>
                </div>

            </div>
        </div>
    </section> --}}

    <section class="header my-2">
        <div class="container text-center header">
            <div class="row justify-content-between">

                <div class="image">
                    @if ($intro && $intro->image)
                        <img src="{{ asset('storage/introductions/' . $intro->image) }}" class="img-fluid"
                            alt="Introduction Image">
                    @else
                        <img src="{{ asset('assest/images/spices-float.png') }}" class="img-fluid" alt="Default Image">
                    @endif
                </div>

                <div class="col-md-5" data-aos="fade-right">
                    <h2 class="heading_spice text-md-center">Our Introduction</h2>
                    @if ($intro)
                        <h1 class="mt-4 text-md-center">
                            {{ $intro->heading }}
                        </h1>
                    @else
                        <h1 class="mt-4 text-md-center">
                            Exam Exim, India's first integrated
                            <span class="Tagline">Pulses & Spices</span> company
                        </h1>
                    @endif
                </div>

                <div class="col-md-7" data-aos="fade-left">
                    @if ($intro->sub_heading)
                        <h4 class="mt-4">{{ $intro->sub_heading }}</h4>
                    @endif
                    @if ($intro)
                        <p class="mt-3 letter-space">
                            <strong>{{ $intro->description }}</strong>
                        </p>
                    @else
                        <p class="mt-3 letter-space">
                            <b>
                                Discover each fresh spice you require for a fully stocked kitchen...
                            </b>
                        </p>
                    @endif
                </div>

            </div>
        </div>
    </section>

    <!-------------------------Header Section End--------------------->


    <!-------------------------Roating Section Start--------------------->
    <section id="Roating">
        <div class="container-fluid text-center bg-warning Roating">
            <div class="row my-4 align-items-center">

                <div class="col-md-7 px-4 my-2 d-flex justify-content-evenly">
                    <img class="rotate_img"
                        src="{{ $imgFeature?->image ? asset('storage/features/' . $imgFeature->image) : asset('assest/images/rotate.png') }}"
                        alt="Feature Image">
                </div>

                <div class="col-md-5 mt-4">
                    <h1 class="text-white text-center">
                        {{ $imgFeature?->title ?? '' }}
                    </h1>
                    <p class="text-white text-center">
                        {{ $imgFeature?->subtitle ?? '' }}
                </div>

            </div>
        </div>
    </section>
    <!-------------------------Roating Section End--------------------->


    <!-------------------------Products Cards Start--------------------->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="display-5 fw-bold text-dark">Our Products</h2>
                    <div class="mx-auto bg-success mb-3" style="height: 4px; width: 60px;"></div>
                </div>
            </div>

            <div class="row g-4">
                @forelse ($products as $product)
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                        <div class="card h-100 border-0 shadow-sm product-card">

                            <!-- Category Badge -->
                            @if ($product->category)
                                <span class="badge bg-success position-absolute m-3 px-3 py-2 z-index-1"
                                    style="top:0; left:0; z-index: 10;">
                                    {{ $product->category->name }}
                                </span>
                            @endif

                            <!-- Product Image Container -->
                            <div class="product-img-container overflow-hidden">
                                <img src="{{ $product->image ? asset('storage/products/' . $product->image) : asset('assest/images/product-placeholder.png') }}"
                                    class="card-img-top img-fluid product-zoom" alt="{{ $product->name }}">
                            </div>

                            <!-- Card Body -->
                            <div class="card-body d-flex flex-column p-4">
                                <h5 class="card-title fw-bold mb-2 text-truncate-2">
                                    {{ $product->name }}
                                </h5>

                                <p class="card-text text-muted small mb-4">
                                    {{ Str::limit($product->description ?? 'Premium quality product designed for your specific needs.', 60) }}
                                </p>

                                <!-- Button at the Bottom -->
                                <div class="mt-auto">
                                    <a href="{{ route('product.details', $product->id) }}"
                                        class="btn btn-outline-success w-100 fw-bold stretched-link">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <div class="py-5">
                            <i class="bi bi-box-seam display-1 text-muted"></i>
                            <h4 class="text-muted mt-3">No products available at the moment.</h4>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <style>
        /* Ensure all images have the same height and aspect ratio */
        .product-img-container {
            height: 250px;
            /* Fixed height for consistency */
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
            position: relative;
        }

        .product-img-container img {
            max-height: 100%;
            width: auto;
            object-fit: contain;
            transition: transform 0.4s ease;
        }

        /* Card Hover Effects */
        .product-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 15px;
            overflow: hidden;
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1) !important;
        }

        .product-card:hover .product-zoom {
            transform: scale(1.1);
        }

        /* Truncate text to 2 lines for title */
        .text-truncate-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            min-height: 3rem;
        }

        /* Button Styling */
        .btn-outline-success {
            border-width: 2px;
            border-radius: 8px;
            transition: 0.3s;
        }

        .btn-outline-success:hover {
            background-color: #198754;
            color: white;
        }
    </style>

    <!-------------------------Products Cards End--------------------->

    <!-------------------------Products Section Start--------------------->
    @if ($topProducts->count())
        <section id="products" class="shadow">
            <div class="container-fluid text-center products">

                @foreach ($topProducts as $index => $product)
                    <div class="row mt-4 p-0 align-items-center">

                        {{-- IMAGE LEFT for even, RIGHT for odd --}}
                        @if ($index % 2 == 0)
                            <div class="col-md-6 p-0" data-aos="zoom-in">
                                <img src="{{ asset('storage/products/' . $product->image) }}" class="img-fluid p-0"
                                    alt="{{ $product->name }}">
                            </div>
                        @endif

                        <div class="col-md-6 p-0 my-auto">
                            <h4 class="m-4 fs-2 text-uppercase">
                                <b>{{ $product->name }}</b>
                            </h4>

                            <h5 class="m-4">
                                {{ Str::limit($product->description, 180) }}
                            </h5>

                            <h4 class="heading_spice mx-auto">
                                <a href="{{ route('product.details', $product->id) }}"
                                    class="text-decoration-none text-white">
                                    Know More About This
                                </a>
                            </h4>
                        </div>

                        {{-- IMAGE RIGHT for odd --}}
                        @if ($index % 2 == 1)
                            <div class="col-md-6 p-0" data-aos="zoom-in">
                                <img src="{{ asset('storage/products/' . $product->image) }}" class="img-fluid p-0"
                                    alt="{{ $product->name }}">
                            </div>
                        @endif

                    </div>
                @endforeach

            </div>
        </section>
    @endif

    <!-------------------------Products Section End--------------------->

    <!-------------------------Why Choose Section Start--------------------->
    <section id="why" class="bg-body-tertiary">
        <div class="container text-center">
            <div class="row align-items-center">

                {{-- LEFT IMAGE --}}
                <div class="col-md-6">
                    @if ($whyChoose && $whyChoose->main_image)
                        <img src="{{ asset('storage/whychoose/' . $whyChoose->main_image) }}" class="img-fluid">
                    @endif
                </div>

                {{-- RIGHT CONTENT --}}
                <div class="col-md-6 mt-4 why-left">

                    @if ($whyChoose && $whyChoose->bg_img)
                        <img class="img-fluid why-left-image why"
                            src="{{ asset('storage/whychoose_features/' . $whyChoose->bg_img) }}">
                    @endif

                    @if ($whyChoose)
                        <h1 class="why mx-4 text-align-start">
                            {{ $whyChoose->title }}
                            <span class="Tagline">{{ $whyChoose->subtitle }}</span>
                        </h1>
                    @endif

                    {{-- WHY CHOOSE FEATURES --}}
                    @if ($whyChoose && $whyChoose->features->count())
                        @foreach ($whyChoose->features as $feature)
                            <div class="container text-center mt-4">
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        @if ($feature->icon)
                                            <img src="{{ asset('storage/whychoose_features/' . $feature->icon) }}"
                                                class="img-fluid">
                                        @endif
                                    </div>
                                    <div class="col-md-9">
                                        <h3 class="text-thik">{{ $feature->title }}</h3>
                                        <p class="text-thik">{{ $feature->description }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                </div>
            </div>
        </div>
    </section>

    <!-------------------------Why Choose Section End--------------------->

    <!-------------------------Products Slider Show Start--------------------->
    <section>
        <div class="container-fluid products_slid">
            <div class="row">

                <div class="col-md-5 mt-4">
                    <h2 class="why text-align-center my-4">
                        Find The New<br> Range Of<br>
                        <span class="Tagline">Spices & Pulses</span>
                    </h2>
                </div>

                <div class="col-md-7 d-flex justify-content-center align-items-center">
                    <div class="container-fluid">

                        <div class="swiper mySwiper">
                            <div class="swiper-wrapper d-flex align-items-center">

                                @foreach (['s.png', 'p.png', 'i.png', 'c.png', 'e.png', 's.png'] as $img)
                                    <div class="swiper-slide">
                                        <img src="{{ asset('assest/images/' . $img) }}" class="img-fluid asp1">
                                    </div>
                                @endforeach

                            </div>

                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-------------------------Products Slider Show End--------------------->

    <!-------------------------Testimonials Start--------------------->
    <section id="testimonials" class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold Tagline fs-1">What Our Customers Say</h2>
                <div class="mx-auto bg-brown" style="height: 3px; width: 70px;"></div>
            </div>

            @if ($testimonials->count())
                <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">

                    <!-- Indicators -->
                    <div class="carousel-indicators custom-indicators">
                        @foreach ($testimonials as $key => $item)
                            <button type="button" data-bs-target="#testimonialCarousel"
                                data-bs-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}">
                            </button>
                        @endforeach
                    </div>

                    <div class="carousel-inner pb-5">
                        @foreach ($testimonials as $key => $testimonial)
                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                <div class="row justify-content-center">
                                    <div class="col-md-8 col-lg-6">
                                        <div
                                            class="testimonial-card card border-0 h-100 shadow-sm position-relative bg-white p-5 rounded-4 mt-5">
                                            <!-- Quote Icon -->
                                            <div class="quote-icon shadow-sm">
                                                <i class="bi bi-quote"></i>
                                            </div>

                                            <!-- Profile Image -->
                                            <div class="profile-img-wrapper">
                                                @if ($testimonial->image)
                                                    <img src="{{ asset('storage/testimonials/' . $testimonial->image) }}"
                                                        class="rounded-circle border border-4 border-white shadow-sm"
                                                        alt="{{ $testimonial->customer_name }}">
                                                @else
                                                    <div
                                                        class="rounded-circle border border-4 border-white shadow-sm bg-secondary d-flex align-items-center justify-content-center text-white">
                                                        {{ substr($testimonial->customer_name, 0, 1) }}
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="text-center pt-4">
                                                <p class="text-muted fs-5 fst-italic mb-4">
                                                    "{{ $testimonial->description }}"
                                                </p>
                                                <h5 class="fw-bold mb-1 Tagline_brown">
                                                    {{ $testimonial->customer_name }}
                                                </h5>
                                                <small
                                                    class="text-uppercase text-muted fw-bold letter-spacing-1">Verified
                                                    Customer</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Custom Controls -->
                    <button class="carousel-control-prev custom-ctrl" type="button"
                        data-bs-target="#testimonialCarousel" data-bs-slide="prev">
                        <i class="bi bi-arrow-left-short"></i>
                    </button>
                    <button class="carousel-control-next custom-ctrl" type="button"
                        data-bs-target="#testimonialCarousel" data-bs-slide="next">
                        <i class="bi bi-arrow-right-short"></i>
                    </button>
                </div>
            @else
                <p class="text-center text-muted">No testimonials available.</p>
            @endif
        </div>
    </section>

    <style>
        .testimonial-card {
            min-height: 350px;
            margin-top: 50px;
            transition: transform 0.3s ease;
        }

        .profile-img-wrapper {
            position: absolute;
            top: -50px;
            left: 50%;
            transform: translateX(-50%);
        }

        .profile-img-wrapper img,
        .profile-img-wrapper div {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }

        .quote-icon {
            position: absolute;
            top: 20px;
            left: 20px;
            width: 40px;
            height: 40px;
            background: #8b5e3c;
            /* Change to your Tagline_brown color */
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .custom-indicators [data-bs-target] {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: #8b5e3c;
            margin: 0 5px;
        }

        .custom-ctrl i {
            background-color: #8b5e3c;
            /* Tagline brown */
            color: #fff;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        .custom-ctrl:hover i {
            background-color: #5d3e28;
            transform: scale(1.1);
        }


        .letter-spacing-1 {
            letter-spacing: 1px;
            font-size: 0.75rem;
        }

        .bg-brown {
            background-color: #8b5e3c;
        }

        /* Match your branding */
    </style>

    <script>
        const carousel = document.querySelector('#testimonialCarousel');
        if (carousel) {
            new bootstrap.Carousel(carousel, {
                interval: 5000,
                pause: 'hover',
                ride: 'carousel'
            });
        }
    </script>


    <!-------------------------Testimonials End--------------------->
    <style>
        .asp1 {
            aspect-ratio: 3/2;
            width: 100%;
            object-fit: contain;
        }
    </style>

    <livewire:front.layout.footer />

</div>
