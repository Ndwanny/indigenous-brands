<footer class="ftco-footer bg-bottom ftco-no-pt"
        style="background-image: url({{ asset('images/bg_3.jpg') }});">
    <div class="container">
        <div class="row mb-5">

            {{-- Column 1: About --}}
            <div class="col-md pt-5">
                <div class="ftco-footer-widget pt-md-5 mb-4">
                    <h2 class="ftco-heading-2">About Indigenous Brands</h2>
                    <p>Indigenous Brands is a movement to empower Zambian entrepreneurs by connecting them with
                        customers, investors, and opportunities. We celebrate homegrown talent and showcase the
                        diversity of Zambian enterprise to the world.</p>
                    <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-3">
                        <li class="ftco-animate">
                            <a href="#" title="Twitter" target="_blank" rel="noopener noreferrer">
                                <span class="fa fa-twitter"></span>
                            </a>
                        </li>
                        <li class="ftco-animate">
                            <a href="#" title="Facebook" target="_blank" rel="noopener noreferrer">
                                <span class="fa fa-facebook"></span>
                            </a>
                        </li>
                        <li class="ftco-animate">
                            <a href="#" title="Instagram" target="_blank" rel="noopener noreferrer">
                                <span class="fa fa-instagram"></span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Column 2: Information --}}
            <div class="col-md pt-5">
                <div class="ftco-footer-widget pt-md-5 mb-4 ml-md-4">
                    <h2 class="ftco-heading-2">Information</h2>
                    <ul class="list-unstyled">
                        <li>
                            <a href="{{ route('home') }}" class="py-1 d-block">
                                <span class="fa fa-chevron-right mr-2"></span>Home
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('about') }}" class="py-1 d-block">
                                <span class="fa fa-chevron-right mr-2"></span>About Us
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('brands.index') }}" class="py-1 d-block">
                                <span class="fa fa-chevron-right mr-2"></span>Brands Directory
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('events.index') }}" class="py-1 d-block">
                                <span class="fa fa-chevron-right mr-2"></span>Events
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('blog.index') }}" class="py-1 d-block">
                                <span class="fa fa-chevron-right mr-2"></span>Blog
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('contact') }}" class="py-1 d-block">
                                <span class="fa fa-chevron-right mr-2"></span>Contact
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Column 3: Get Involved --}}
            <div class="col-md pt-5">
                <div class="ftco-footer-widget pt-md-5 mb-4">
                    <h2 class="ftco-heading-2">Get Involved</h2>
                    <ul class="list-unstyled">
                        <li>
                            <a href="{{ route('register') }}" class="py-1 d-block">
                                <span class="fa fa-chevron-right mr-2"></span>Register Your Brand
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('get-involved') }}" class="py-1 d-block">
                                <span class="fa fa-chevron-right mr-2"></span>Volunteer
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('get-involved') }}" class="py-1 d-block">
                                <span class="fa fa-chevron-right mr-2"></span>Partner With Us
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('get-involved') }}" class="py-1 d-block">
                                <span class="fa fa-chevron-right mr-2"></span>Sponsor an Event
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('get-involved') }}" class="py-1 d-block">
                                <span class="fa fa-chevron-right mr-2"></span>Advertise With Us
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Column 4: Have Questions? --}}
            <div class="col-md pt-5">
                <div class="ftco-footer-widget pt-md-5 mb-4">
                    <h2 class="ftco-heading-2">Have Questions?</h2>
                    <div class="block-23 mb-3">
                        <ul class="list-unstyled">
                            <li class="d-flex py-1">
                                <span class="fa fa-map-marker mr-3 mt-1 text-warning flex-shrink-0"></span>
                                <span>Lusaka, Zambia</span>
                            </li>
                            <li class="d-flex py-1">
                                <span class="fa fa-phone mr-3 mt-1 text-warning flex-shrink-0"></span>
                                <a href="tel:+260000000000">+260 000 000 000</a>
                            </li>
                            <li class="d-flex py-1">
                                <span class="fa fa-envelope mr-3 mt-1 text-warning flex-shrink-0"></span>
                                <a href="mailto:info@indigenousbrands.co.zm">info@indigenousbrands.co.zm</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>{{-- /.row --}}

        {{-- Copyright row --}}
        <div class="row">
            <div class="col-md-12 text-center">
                <p>
                    Copyright &copy; {{ date('Y') }} All rights reserved
                    | Made with <i class="fa fa-heart" aria-hidden="true" style="color:#fd7e14;"></i> by
                    <a href="#" style="color: #fd7e14;">Kondwani</a>
                    | <a href="{{ route('home') }}" style="color: #fd7e14;">Indigenous Brands Zambia</a>
                </p>
            </div>
        </div>

    </div>
</footer>
