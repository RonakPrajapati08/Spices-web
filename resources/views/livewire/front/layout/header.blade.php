<div>

    <i class="bi bi-list mobile-nav-toggle d-lg-none bg-black text-white"></i>

    <header id="header" class="d-flex flex-column justify-content-center gap-4">
        <a href="#" class="footer-brand d-lg-none">
            <img class="rounded-3" src="{{ asset('assest/images/DESIGN.png') }}" alt=""
                style="width: 100%; max-width: 200px;">
        </a>
        <nav id="navbar" class="navbar nav-menu">
            <ul>
                <li>
                    <a href="{{ route('home') }}"
                        class="nav-link scrollto {{ request()->routeIs('home') ? 'active' : '' }}">
                        <i class="bi bi-house-add"></i>
                        <span>Home</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('AboutUs') }}"
                        class="nav-link scrollto {{ request()->routeIs('AboutUs') ? 'active' : '' }}">
                        <i class="bi bi-person"></i>
                        <span>Our Story</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('Products') }}"
                        class="nav-link scrollto {{ request()->routeIs('Products') ? 'active' : '' }}">
                        <i class="bi bi-hdd-rack"></i>
                        <span>We Deals In</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('ContactUs') }}"
                        class="nav-link scrollto {{ request()->routeIs('ContactUs') ? 'active' : '' }}">
                        <i class="bi bi-person-rolodex"></i>
                        <span>Reach Us</span>
                    </a>
                </li>

                <li>
                    <a href="#" target="_blank" id="myBtn" data-bs-toggle="modal"
                        data-bs-target="#exampleModal" data-whatever="@mdo" class="nav-link scrollto">
                        <i class="bi bi-info-circle"></i>
                        <span>Enquiry</span>
                    </a>
                </li>
            </ul>
        </nav>
    </header>


    <!-- ------------START Sticky Icon-------------- -->

    @if ($contact && $contact->phone)
        <a href="tel:{{ preg_replace('/[^0-9+]/', '', $contact->phone) }}"
            class="back-to-top row rounded-pill align-items-center justify-content-center" id="Aenker">
            <i class="bi bi-telephone-inbound-fill"></i>
        </a>
    @endif

    @if ($contact && $contact->phone)
        <a href="https://wa.me/{{ $contact->phone }}"
            class="back-to-top_1 row rounded-pill align-items-center justify-content-center" id="Aenker1"><i
                class="bi bi-whatsapp"></i></a>
    @endif

    <!-- The Button -->
    <a href="javascript:void(0)" class="back-to-top_2 row align-items-center justify-content-center mb-2" id="Aenker2"
        style="display: none;">
        <i class="bi bi-arrow-up"></i>
    </a>

    <style>
        /* WhatsApp button */
        #Aenker1 {
            background-color: #25D366;
            /* WhatsApp green */
            color: white;
            width: 50px;
            height: 50px;
        }

        /* Phone button */
        #Aenker {
            background-color: #0d6efd;
            /* Bootstrap blue */
            color: white;
            width: 50px;
            height: 50px;
        }

        /* Optional hover colors */
        #Aenker1:hover {
            background-color: #128C7E;
            /* Darker WhatsApp green */
        }

        #Aenker:hover {
            background-color: #0a58ca;
            /* Darker blue */
        }
    </style>

    <script>
        function initBackToTop() {
            const backToTopBtn = document.querySelector(".back-to-top_2");

            if (!backToTopBtn) return;

            // 1. Handle Visibility on Scroll
            window.onscroll = function() {
                if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
                    backToTopBtn.style.display = "flex"; // Show button
                } else {
                    backToTopBtn.style.display = "none"; // Hide button
                }
            };

            // 2. Handle Click Event
            backToTopBtn.onclick = function(e) {
                e.preventDefault();
                window.scrollTo({
                    top: 0,
                    behavior: "smooth"
                });
            };
        }

        // Initialize on first load
        document.addEventListener('DOMContentLoaded', initBackToTop);

        // Re-initialize after Livewire navigation (Crucial for Livewire 3)
        document.addEventListener('livewire:navigated', initBackToTop);
    </script>

</div>
