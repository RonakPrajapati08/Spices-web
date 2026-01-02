<div>

    <livewire:front.layout.header />

    <section class="py-5 bg-light">
        <div class="container">
            <div class="card p-3 border-2 shadow-sm">
                <div class="row g-0 align-items-center">

                    <!-- Image Section -->
                    <div class="col-md-6 d-flex justify-content-center">
                        <img src="{{ $product->image ? asset('storage/products/' . $product->image) : asset('assest/images/product-placeholder.png') }}"
                            alt="{{ $product->name }}" class="img-fluid rounded border border-2"
                            style="max-height: 400px; object-fit: contain; width: 100%;">
                    </div>

                    <!-- Content Section -->
                    <div class="col-md-6">
                        <div class="card-body">
                            <h2 class="card-title display-6">
                                {{ $product->name }}
                            </h2>

                            @if ($product->category)
                                <p class="text-muted mb-2">
                                    Category: {{ $product->category->name }}
                                </p>
                            @endif

                            <p class="card-text">
                                {{ $product->description ?? 'No description available.' }}
                            </p>

                            {{-- @if ($product->link)
                                <a href="{{ $product->link }}" target="_blank" class="btn btn-success mt-3 fw-bold">
                                    Visit Product
                                </a>
                            @endif --}}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <livewire:front.layout.footer />

</div>
