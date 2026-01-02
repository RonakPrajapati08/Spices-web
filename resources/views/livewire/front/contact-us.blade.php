<div>
    <livewire:front.layout.header />

    <!-- Hero Banner with Overlay Title -->
    <div class="position-relative overflow-hidden bg-dark" style="height: 40vh; min-height: 300px;">
        <img src="{{ asset('assest/images/contactus-banner.png') }}" class="w-100 h-100 object-fit-cover opacity-50"
            alt="Contact Banner">
        <div class="position-absolute top-50 start-50 translate-middle text-center w-100 px-3">
            <h1 class="display-4 fw-bold text-white text-uppercase tracking-wider">Get In Touch</h1>
            <p class="text-white-50 fs-5">We'd love to hear from you. Send us a message and we'll respond as soon as
                possible.</p>
        </div>
    </div>

    <!-- Main Contact Section -->
    <section class="py-5 bg-light">
        <div class="container py-lg-5">
            <div class="row g-5">

                <!-- Left Column: Contact Details -->
                <div class="col-lg-5 col-md-12 animate-fade-in">
                    <div class="pe-lg-4">
                        <h2 class="fw-bold text-dark mb-4">Contact Information</h2>
                        <p class="text-muted mb-5 fs-5">Fill out the form and our team will get back to you within 24
                            hours.</p>

                        <div class="d-flex flex-column gap-4">
                            @if ($contact && $contact->address)
                                <div
                                    class="contact-item d-flex align-items-center gap-3 p-3 bg-white rounded-4 shadow-sm border-start border-primary border-4">
                                    <div class="icon-box bg-primary-subtle text-primary rounded-circle d-flex align-items-center justify-content-center"
                                        style="width: 50px; height: 50px;">
                                        <i class="bi bi-geo-alt fs-4"></i>
                                    </div>
                                    <div>
                                        <small class="text-uppercase text-muted fw-bold tracking-tight d-block"
                                            style="font-size: 0.7rem;">Visit Us</small>
                                        <span class="text-dark fw-medium">{{ $contact->address }}</span>
                                    </div>
                                </div>
                            @endif

                            @if ($contact && $contact->email)
                                <div
                                    class="contact-item d-flex align-items-center gap-3 p-3 bg-white rounded-4 shadow-sm border-start border-info border-4">
                                    <div class="icon-box bg-info-subtle text-info rounded-circle d-flex align-items-center justify-content-center"
                                        style="width: 50px; height: 50px;">
                                        <i class="bi bi-envelope-at fs-4"></i>
                                    </div>
                                    <div>
                                        <small class="text-uppercase text-muted fw-bold tracking-tight d-block"
                                            style="font-size: 0.7rem;">Email Support</small>
                                        <a href="mailto:{{ $contact->email }}"
                                            class="text-decoration-none text-dark fw-medium">{{ $contact->email }}</a>
                                    </div>
                                </div>
                            @endif

                            @if ($contact && $contact->phone)
                                <div
                                    class="contact-item d-flex align-items-center gap-3 p-3 bg-white rounded-4 shadow-sm border-start border-success border-4">
                                    <div class="icon-box bg-success-subtle text-success rounded-circle d-flex align-items-center justify-content-center"
                                        style="width: 50px; height: 50px;">
                                        <i class="bi bi-telephone-forward fs-4"></i>
                                    </div>
                                    <div>
                                        <small class="text-uppercase text-muted fw-bold tracking-tight d-block"
                                            style="font-size: 0.7rem;">Call Anytime</small>
                                        <a href="tel:{{ $contact->phone }}"
                                            class="text-decoration-none text-dark fw-medium">{{ $contact->phone }}</a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Right Column: Modern Floating Label Form -->
                <div class="col-lg-7 col-md-12">
                    <div class="card border-0 shadow-lg rounded-4 overflow-hidden animate-slide-up">
                        <div class="card-body p-4 p-md-5">
                            <h3 class="fw-bold mb-4">Send a Message</h3>
                            {{-- <form wire:submit.prevent="submitForm" class="row g-4"> --}}
                            <form method="POST" action="{{ route('contact.inquiry.store') }}" class="row g-4">
                                @csrf
                                <!-- Full Name -->
                                <div class="col-md-12">
                                    <div class="form-floating mb-1">
                                        <input type="text" class="form-control bg-light border-0" id="fullname"
                                            name="name" placeholder="John Doe" required>
                                        <label for="fullname">Full Name *</label>
                                    </div>
                                </div>

                                <!-- Email & Phone Row -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control bg-light border-0" id="email"
                                            name="email" placeholder="name@example.com" required>
                                        <label for="email">Email Address *</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="tel" class="form-control bg-light border-0" id="phone"
                                            name="phone" placeholder="Phone">
                                        <label for="phone">Phone Number</label>
                                    </div>
                                </div>

                                <!-- Message -->
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control bg-light border-0" id="message" style="height: 150px" name="message"
                                            placeholder="Leave a message here" required></textarea>
                                        <label for="message">Your Message *</label>
                                    </div>
                                </div>

                                <!-- Submit -->
                                <div class="col-12">
                                    <button
                                        class="btn btn-primary btn-lg w-100 rounded-pill py-3 fw-bold shadow-sm transition-all"
                                        type="submit" wire:loading.attr="disabled">
                                        <span wire:loading.remove>Send Message</span>
                                        <span wire:loading><span class="spinner-border spinner-border-sm me-2"></span>
                                            Sending...</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Google Map Section (Seamless Edge-to-Edge) -->
    @if ($contact && $contact->google_map_iframe)
        <div class="container-fluid p-0">
            <div class="ratio ratio-21x9 shadow-lg map-container" style="min-height: 400px;">
                {!! $contact->google_map_iframe !!}
            </div>
        </div>
    @endif

    <livewire:front.layout.footer />

    @if (session()->has('success'))
        <div class="position-fixed top-0 end-0 d-flex m-3 alert alert-success alert-dismissible fade show shadow-lg rounded"
            role="alert" style="min-width: 280px; max-width: 400px; z-index: 1050; padding-right: 2.5rem;"
            x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 6000)">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close position-absolute top-50 end-0 translate-middle-y me-2 p-1"
                data-bs-dismiss="alert" aria-label="Close" style="width: 0.4rem; height: 0.4rem;"></button>
        </div>
    @endif

</div>
