<div>

    <livewire:front.layout.header />

    <!-------------------------Slider Section Start--------------------->
    @if ($hero)
        <!-- Products Hero Section -->
        <section class="about-hero-section position-relative overflow-hidden">

            {{-- Overlay --}}
            <div class="hero-overlay position-absolute w-100 h-100" style="background: rgba(0, 0, 0, 0.5); z-index: 1;">
            </div>

            {{-- Hero Background Image --}}
            @if ($hero && $hero->bg_image)
                <img src="{{ asset('storage/product-hero/' . $hero->bg_image) }}" class="d-block w-100 asp"
                    alt="Products Banner">
            @endif

            {{-- Content Center --}}
            <div class="container position-absolute top-50 start-50 translate-middle text-center text-white"
                style="z-index: 2;">

                {{-- Breadcrumb --}}
                <nav aria-label="breadcrumb" class="d-flex justify-content-center mb-2">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}" class="text-white-50 text-decoration-none">
                                Home
                            </a>
                        </li>
                        <li class="breadcrumb-item active text-white fw-bold" aria-current="page">
                            Products
                        </li>
                    </ol>
                </nav>

                {{-- Heading --}}
                <h1 class="display-3 fw-extrabold text-uppercase hero-title">
                    Our <span class="text-brown-light">Products</span>
                </h1>

                {{-- Underline --}}
                <div class="mx-auto bg-brown-light mt-2" style="height: 4px; width: 60px; border-radius: 2px;"></div>

            </div>
        </section>
    @endif
    <!-------------------------Slider Section End--------------------->


    <!-------------------------Spice Section Start--------------------->
    @if ($hero)
        <section class="header">
            <div class="container text-center header">
                <div class="row justify-content-between align-items-center">

                    <div class="col-md-6 align-self-center">
                        <h2 class="Tagline_brown text-align-start">
                            <b>{{ $hero->heading }}</b>
                        </h2>

                        <p class="text-start mt-4">
                            {{ $hero->description }}
                        </p>
                    </div>

                    <div class="col-md-6">
                        @if ($hero->intro_img)
                            <img src="{{ asset('storage/product-hero/' . $hero->intro_img) }}" class="img-fluid"
                                alt="Products Intro">
                        @endif
                    </div>

                </div>
            </div>
        </section>
    @endif

    <!-------------------------Spice Section End--------------------->


    <!-------------------------Products Grid Start--------------------->
    {{-- <section class="py-4">
        <div class="container-fluid">
            <h2 class="fs-1 text-align-center Tagline">Products</h2>

            @php
                $products = [
                    ['img' => 'product1.png', 'name' => 'Cloves'],
                    ['img' => 'product2.png', 'name' => 'Star Anise'],
                    ['img' => 'product3.png', 'name' => 'Nutmeg'],
                    ['img' => 'product4.png', 'name' => 'Turmeric'],
                    ['img' => 'product5.png', 'name' => 'Red Chilly Powder'],
                    ['img' => 'product6.png', 'name' => 'Cumin'],
                    ['img' => 'product7.png', 'name' => 'Black Paper'],
                    ['img' => 'product8.png', 'name' => 'Cinnamon'],
                    ['img' => 'product9.png', 'name' => 'Garam Masala'],
                    ['img' => 'product10.png', 'name' => 'Bay Leaf'],
                    ['img' => 'product11.png', 'name' => 'Cardamon Brown'],
                    ['img' => 'product12.png', 'name' => 'Black Cumin'],
                ];
            @endphp

            <div class="row prod">

                @foreach ($products as $product)
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-7 mx-auto">
                        <div class="card product-card1 my-3">

                            <div class="product-img three">
                                <img src="{{ asset('assest/images/' . $product['img']) }}" class="object-fit-contain"
                                    alt="">
                            </div>

                            <div class="text-center product-detail p-3">
                                <h4 class="fw-bold">{{ $product['name'] }}</h4>
                            </div>

                            <div class="pro-btn mx-auto mb-4">
                                <a href="{{ route('product.details') }}">
                                    <button class="bg-success fw-bold rounded-3 btn text-white">
                                        Read More
                                    </button>
                                </a>
                            </div>

                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section> --}}
    <section class="py-4">
        <div class="container-fluid">
            <h2 class="fs-1 text-align-center Tagline">Products</h2>

            <div class="row prod">

                @forelse ($products as $product)
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-7 mx-auto">
                        <div class="card product-card1 my-3">

                            <!-- Product Image -->
                            <div class="product-img three">
                                <img src="{{ asset('storage/products/' . $product->image) }}" class="object-fit-contain"
                                    alt="{{ $product->name }}">
                            </div>

                            <!-- Product Name -->
                            <div class="text-center product-detail p-3">
                                <h4 class="fw-bold">{{ $product->name }}</h4>

                                @if ($product->category)
                                    <small class="text-muted">
                                        {{ $product->category->name }}
                                    </small>
                                @endif
                            </div>

                            <!-- Button -->
                            <div class="pro-btn mx-auto mb-4">
                                <a href="{{ route('product.details', $product->id) }}">
                                    <button class="bg-success fw-bold rounded-3 btn text-white">
                                        Read More
                                    </button>
                                </a>
                            </div>

                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted fs-5">No products available.</p>
                    </div>
                @endforelse

            </div>
        </div>
    </section>

    <!-------------------------Products Grid End--------------------->

    <livewire:front.layout.footer />

</div>
