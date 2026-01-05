<div>

    <footer class="agro-footer">
        <!-- Wavy Top Shape -->
        <div class="footer-wave">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path
                    d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"
                    class="shape-fill"></path>
            </svg>
        </div>

        <div class="container footer-container">
            <!-- Floating Glassmorphic Newsletter Section -->
            <div class="cta-floating-card mt-5">
                <div class="row align-items-center p-4">
                    <div class="col-lg-7 mb-3 mb-lg-0">
                        <h3 class="fw-bold mb-1">Stay Growing With Us</h3>
                        <p class="mb-0 text-white-50">Join our newsletter for the latest in sustainable farming and
                            product updates.</p>
                    </div>
                    <div class="col-lg-5">
                        <form class="input-group" action="{{ route('contact.inquiry.store') }}" method="POST">
                            @csrf
                            <input type="email" name="email" class="form-control custom-input"
                                placeholder="Enter your email">
                            <button class="btn btn-agro" type="submit">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row gy-5 mt-4">
                <!-- Brand Column -->
                <div class="col-lg-4">
                    <a href="#" class="footer-brand">
                        {{-- <span class="brand-v">V</span>imal <span>Agro</span> --}}
                        <img class="rounded-3" src="{{ asset('assest/images/DESIGN.png') }}" alt=""
                            style="width: 100%; max-width: 200px;">
                    </a>
                    <p class="brand-text mt-3">
                        Empowering farmers with high-quality agro-solutions. We blend technology with tradition to
                        ensure a greener future for everyone.
                    </p>
                    <div class="social-glass-icons mt-4">
                        @if ($contact && $contact->facebook_url)
                            <a href="{{ $contact->facebook_url }}" class="glass-icon"><i class="bi bi-facebook"></i></a>
                        @endif
                        @if ($contact && $contact->instagram_url)
                            <a href="{{ $contact->instagram_url }}" class="glass-icon"><i
                                    class="bi bi-instagram"></i></a>
                        @endif
                        @if ($contact && $contact->linkedin_url)
                            <a href="{{ $contact->linkedin_url }}" class="glass-icon"><i class="bi bi-linkedin"></i></a>
                        @endif
                    </div>
                </div>

                <!-- Links Column -->
                <div class="col-lg-2 col-md-4">
                    <h6 class="footer-title">Explore</h6>
                    <ul class="footer-links-list">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('AboutUs') }}">Our Legacy</a></li>
                        <li><a href="{{ route('Products') }}">Products</a></li>
                        <li><a href="{{ route('ContactUs') }}">Contact</a></li>
                    </ul>
                </div>

                <!-- Services Column -->
                <div class="col-lg-3 col-md-4">
                    <h6 class="footer-title">Address</h6>
                    <div class="contact-info">
                        <div class="d-flex align-items-start mb-3">
                            <i class="bi bi-geo-alt-fill text-success me-3"></i>
                            <p class="mb-0">{{ $contact->address ?? 'Corporate Office, Agriculture Zone, India' }}</p>
                        </div>

                    </div>
                </div>

                <!-- Support Column -->
                <div class="col-lg-3 col-md-4 text-md-end">
                    <h6 class="footer-title">Direct Support</h6>
                    <p class="mb-1 text-white-50 small">Have questions? Reach us at:</p>
                    <h4 class="fw-bold text-success mb-0"><a class="text-success text-decoration-none"
                            href="tel:{{ $contact->phone ?? 'N/A' }}">{{ $contact->phone ?? 'N/A' }}</a>
                    </h4>
                    <p class="small text-light mt-2"><i class="bi bi-clock me-1"></i> Mon - Sat: 9:00 AM - 6:00 PM</p>
                </div>
            </div>

            <hr class="footer-divider mt-5">

            <div class="bottom-bar py-4">
                <div class="row align-items-center">
                    <div class="col-md-6 text-center text-md-start">
                        <p class="copyright-text mb-0">© {{ date('Y') }} Vimal Agro Applied. Designed with <i
                                class="bi bi-heart-fill text-danger"></i></p>
                    </div>
                    <div class="col-md-6 text-center text-md-end mt-2 mt-md-0">
                        {{-- <div class="legal-links">
                            <a >Privacy</a>
                            <span class="mx-2 text-muted">|</span>
                            <a href="#">Terms</a>
                        </div> --}}
                        <div id="google_translate_element" class="mini-translate"></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <style>
        /* Color Palette */
        :root {
            --agro-deep: #3d2b1f;
            /* Very Dark Forest Green */
            --agro-mid: #143625;
            --agro-accent: #2d6a4f;
            /* Vibrant Green */
            --agro-text: #d1d5db;
            --agro-box-bg: #3d2b1f;
        }

        .agro-footer {
            background: var(--agro-deep);
            color: var(--agro-text);
            position: relative;
            padding-top: 0;
            overflow: hidden;
        }

        /* Wavy Top Divider */
        .footer-wave {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            overflow: hidden;
            line-height: 0;
        }

        .footer-wave svg {
            position: relative;
            display: block;
            width: calc(100% + 1.3px);
            height: 70px;
        }

        .footer-wave .shape-fill {
            fill: #f8f9fa;
            /* Should match the section color above the footer */
        }

        /* Floating Card Effect */
        .cta-floating-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            margin-top: -30px;
            /* Pulls it up over the wave */
            position: relative;
            z-index: 10;
            color: white;
        }

        /* .cta-floating-card {
    background: var(--agro-box-bg);
    border-radius: 15px;
    margin-top: -60px;
    position: relative;
    z-index: 100;
    border: 1px solid rgba(0,0,0,0.1);
    color: white;
} */

        .custom-input {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white !important;
        }

        .custom-input::placeholder {
            color: #999;
        }

        .btn-agro {
            background: var(--agro-accent);
            color: white;
            font-weight: 600;
            padding: 0.7rem 1.5rem;
            transition: 0.3s;
        }

        .btn-agro:hover {
            background: #27ae60;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(46, 204, 113, 0.4);
        }

        /* Typography & Links */
        .footer-brand {
            font-size: 1.8rem;
            font-weight: 800;
            color: white;
            text-decoration: none;
            letter-spacing: -1px;
        }

        .footer-brand .brand-v {
            color: var(--agro-accent);
        }

        .footer-brand span {
            font-weight: 300;
        }

        .footer-title {
            color: white;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 0.85rem;
            margin-bottom: 25px;
            position: relative;
        }

        .footer-links-list {
            list-style: none;
            padding: 0;
        }

        .footer-links-list li {
            margin-bottom: 12px;
        }

        .footer-links-list a {
            color: var(--agro-text);
            text-decoration: none;
            transition: 0.3s ease;
        }

        .footer-links-list a:hover {
            /* color: var(--agro-accent); */
            padding-left: 8px;
        }

        /* Social Icons Glass Effect */
        .glass-icon {
            width: 42px;
            height: 42px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            color: white;
            margin-right: 10px;
            font-size: 1.1rem;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .glass-icon:hover {
            background: #9b3c1b;
            color: white;
            transform: rotate(360deg) scale(1.1);
        }

        .footer-divider {
            border-color: rgba(255, 255, 255, 0.05);
        }

        /* Bottom Bar */
        .copyright-text,
        .legal-links a {
            font-size: 0.85rem;
            color: #6b7280;
            text-decoration: none;
        }

        .legal-links a:hover {
            color: white;
        }
    </style>

</div>
