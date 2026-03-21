@extends('layouts.app')

@section('title', 'About Us - Indigenous Brands | Empowering Zambian Entrepreneurs')

@section('content')

    {{-- ===================== HERO BANNER ===================== --}}
    @include('partials.hero-banner', ['title' => 'About Us'])

    {{-- ===================== OUR STORY / MISSION SECTION ===================== --}}
    <section class="ftco-section services-section">
        <div class="container">
            <div class="row d-flex">
                <div class="col-md-6 order-md-last heading-section pl-md-5 ftco-animate d-flex align-items-center">
                    <div class="w-100">
                        <span class="subheading">Our Mission</span>
                        <h2 class="mb-4">Empowering Zambian Entrepreneurs</h2>
                        <p>Indigenous Brands (IB) is dedicated to celebrating and promoting Zambian entrepreneurs and their locally made brands. Our mission is to create a vibrant platform that showcases the creativity, strength, and growth of Zambia's business community.</p>
                        <p>We believe in the power of local innovation to transform lives and communities. By connecting entrepreneurs with opportunities, resources, and a supportive network, IB aims to build a thriving ecosystem for Zambian brands to shine on a global stage.</p>
                        <p><a href="{{ route('get-involved') }}" class="btn btn-primary py-3 px-4">Join the Movement</a></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12 col-lg-6 d-flex align-self-stretch ftco-animate">
                            <div class="services services-1 color-1 d-block img" style="background-image: url('https://i.ibb.co/mCBC0x28/1-18.jpg');">
                                <div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-rocket"></span></div>
                                <div class="media-body">
                                    <h3 class="heading mb-3">Brand Visibility</h3>
                                    <p>We provide a platform to showcase Zambian brands to a wide audience.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6 d-flex align-self-stretch ftco-animate">
                            <div class="services services-1 color-2 d-block img" style="background-image: url('https://i.ibb.co/dRLr6zG/1-12.jpg');">
                                <div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-road"></span></div>
                                <div class="media-body">
                                    <h3 class="heading mb-3">Community Engagement</h3>
                                    <p>Our events and programs foster collaboration and networking.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6 d-flex align-self-stretch ftco-animate">
                            <div class="services services-1 color-3 d-block img" style="background-image: url('https://i.ibb.co/k60rzb0t/1-16.jpg');">
                                <div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-users"></span></div>
                                <div class="media-body">
                                    <h3 class="heading mb-3">Entrepreneur Support</h3>
                                    <p>We offer resources and mentorship to help brands grow.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6 d-flex align-self-stretch ftco-animate">
                            <div class="services services-1 color-4 d-block img" style="background-image: url('https://i.ibb.co/5f6Zzpz/1-2.jpg');">
                                <div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-map-marker"></span></div>
                                <div class="media-body">
                                    <h3 class="heading mb-3">Proudly Zambian</h3>
                                    <p>We celebrate the heritage and innovation of Zambia.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===================== VIDEO SECTION ===================== --}}
    <section class="ftco-section ftco-about img" style="background-image: url('https://i.ibb.co/dRLr6zG/1-12.jpg');">
        <div class="overlay"></div>
        <div class="container py-md-5">
            <div class="row py-md-5">
                <div class="col-md d-flex align-items-center justify-content-center">
                    <a href="https://www.youtube.com/watch?v=jNQXAC9IVRw" class="icon-video popup-youtube d-flex align-items-center justify-content-center mb-4">
                        <span class="fa fa-play"></span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- ===================== VISION SECTION ===================== --}}
    <section class="ftco-section ftco-about ftco-no-pt img">
        <div class="container">
            <div class="row d-flex">
                <div class="col-md-12 about-intro">
                    <div class="row">
                        <div class="col-md-6 d-flex align-items-stretch">
                            <div class="img d-flex w-100 align-items-center justify-content-center" style="background-image:url('https://i.ibb.co/5f6Zzpz/1-2.jpg');">
                            </div>
                        </div>
                        <div class="col-md-6 pl-md-5 py-5">
                            <div class="row justify-content-start pb-3">
                                <div class="col-md-12 heading-section ftco-animate">
                                    <span class="subheading">Our Vision</span>
                                    <h2 class="mb-4">Building a Thriving Zambian Ecosystem</h2>
                                    <p>Our vision is to create a dynamic community where Zambian entrepreneurs can connect, innovate, and grow. We aim to empower local brands with the tools, visibility, and support they need to succeed, while celebrating the rich heritage and creativity of Zambia.</p>
                                    <p><a href="{{ route('get-involved') }}" class="btn btn-primary">Get Involved</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===================== VALUES SECTION ===================== --}}
    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row justify-content-center pb-4">
                <div class="col-md-12 heading-section text-center ftco-animate">
                    <span class="subheading">What We Stand For</span>
                    <h2 class="mb-4">Our Core Values</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 ftco-animate text-center mb-4">
                    <div class="p-4">
                        <div class="icon d-flex align-items-center justify-content-center mb-3" style="width:70px;height:70px;background:#fd7e14;border-radius:50%;margin:0 auto;">
                            <span class="fa fa-heart fa-2x text-white"></span>
                        </div>
                        <h3>Pride &amp; Heritage</h3>
                        <p>We celebrate Zambia's rich cultural heritage and foster pride in locally made products and brands that represent our nation's creativity.</p>
                    </div>
                </div>
                <div class="col-md-4 ftco-animate text-center mb-4">
                    <div class="p-4">
                        <div class="icon d-flex align-items-center justify-content-center mb-3" style="width:70px;height:70px;background:#fd7e14;border-radius:50%;margin:0 auto;">
                            <span class="fa fa-users fa-2x text-white"></span>
                        </div>
                        <h3>Community First</h3>
                        <p>We believe that a strong community is the foundation of every successful entrepreneurship journey. Together we grow.</p>
                    </div>
                </div>
                <div class="col-md-4 ftco-animate text-center mb-4">
                    <div class="p-4">
                        <div class="icon d-flex align-items-center justify-content-center mb-3" style="width:70px;height:70px;background:#fd7e14;border-radius:50%;margin:0 auto;">
                            <span class="fa fa-lightbulb-o fa-2x text-white"></span>
                        </div>
                        <h3>Innovation</h3>
                        <p>We encourage entrepreneurs to think boldly, challenge norms, and develop innovative solutions that make Zambian brands globally competitive.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===================== TEAM SECTION ===================== --}}
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center pb-4">
                <div class="col-md-12 heading-section text-center ftco-animate">
                    <span class="subheading">The People Behind IB</span>
                    <h2 class="mb-4">Meet Our Team</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 ftco-animate text-center mb-4">
                    <div class="staff">
                        <div class="img-wrap d-flex align-items-stretch">
                            <div class="img align-self-stretch" style="background-image:url('https://i.ibb.co/mCBC0x28/1-18.jpg'); height: 200px; background-size: cover; background-position: center; border-radius: 8px;"></div>
                        </div>
                        <div class="text pt-3 px-3 pb-4">
                            <h3>Kondwani Banda</h3>
                            <span class="position">Founder &amp; Director</span>
                            <div class="ftco-footer-social list-unstyled d-flex justify-content-center mt-2">
                                <li class="ftco-animate"><a href="#"><span class="fa fa-twitter"></span></a></li>
                                <li class="ftco-animate"><a href="#"><span class="fa fa-facebook"></span></a></li>
                                <li class="ftco-animate"><a href="#"><span class="fa fa-instagram"></span></a></li>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 ftco-animate text-center mb-4">
                    <div class="staff">
                        <div class="img-wrap d-flex align-items-stretch">
                            <div class="img align-self-stretch" style="background-image:url('https://i.ibb.co/k60rzb0t/1-16.jpg'); height: 200px; background-size: cover; background-position: center; border-radius: 8px;"></div>
                        </div>
                        <div class="text pt-3 px-3 pb-4">
                            <h3>Chanda Mwale</h3>
                            <span class="position">Community Manager</span>
                            <div class="ftco-footer-social list-unstyled d-flex justify-content-center mt-2">
                                <li class="ftco-animate"><a href="#"><span class="fa fa-twitter"></span></a></li>
                                <li class="ftco-animate"><a href="#"><span class="fa fa-facebook"></span></a></li>
                                <li class="ftco-animate"><a href="#"><span class="fa fa-instagram"></span></a></li>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 ftco-animate text-center mb-4">
                    <div class="staff">
                        <div class="img-wrap d-flex align-items-stretch">
                            <div class="img align-self-stretch" style="background-image:url('https://i.ibb.co/dRLr6zG/1-12.jpg'); height: 200px; background-size: cover; background-position: center; border-radius: 8px;"></div>
                        </div>
                        <div class="text pt-3 px-3 pb-4">
                            <h3>Tembo Zulu</h3>
                            <span class="position">Events Coordinator</span>
                            <div class="ftco-footer-social list-unstyled d-flex justify-content-center mt-2">
                                <li class="ftco-animate"><a href="#"><span class="fa fa-twitter"></span></a></li>
                                <li class="ftco-animate"><a href="#"><span class="fa fa-facebook"></span></a></li>
                                <li class="ftco-animate"><a href="#"><span class="fa fa-instagram"></span></a></li>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 ftco-animate text-center mb-4">
                    <div class="staff">
                        <div class="img-wrap d-flex align-items-stretch">
                            <div class="img align-self-stretch" style="background-image:url('https://i.ibb.co/Csp2yHc6/1-2.jpg'); height: 200px; background-size: cover; background-position: center; border-radius: 8px;"></div>
                        </div>
                        <div class="text pt-3 px-3 pb-4">
                            <h3>Nalu Phiri</h3>
                            <span class="position">Brand Partnerships</span>
                            <div class="ftco-footer-social list-unstyled d-flex justify-content-center mt-2">
                                <li class="ftco-animate"><a href="#"><span class="fa fa-twitter"></span></a></li>
                                <li class="ftco-animate"><a href="#"><span class="fa fa-facebook"></span></a></li>
                                <li class="ftco-animate"><a href="#"><span class="fa fa-instagram"></span></a></li>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===================== TESTIMONIALS SECTION ===================== --}}
    <section class="ftco-section testimony-section bg-bottom" style="background-image: url('https://i.ibb.co/k60rzb0t/1-16.jpg');">
        <div class="overlay"></div>
        <div class="container">
            <div class="row justify-content-center pb-4">
                <div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
                    <span class="subheading">Testimonials</span>
                    <h2 class="mb-4">Entrepreneur Stories</h2>
                </div>
            </div>
            <div class="row ftco-animate">
                <div class="col-md-12">
                    <div class="carousel-testimony owl-carousel">
                        <div class="item">
                            <div class="testimony-wrap py-4">
                                <div class="text">
                                    <p class="star">
                                        <span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span>
                                    </p>
                                    <p class="mb-4">Indigenous Brands gave my small business the visibility it needed to grow. The community support is incredible!</p>
                                    <div class="d-flex align-items-center">
                                        <div class="user-img" style="background-image: url('https://i.ibb.co/mCBC0x28/1-18.jpg')"></div>
                                        <div class="pl-3">
                                            <p class="name">Chanda Mwale</p>
                                            <span class="position">Jewelry Designer</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimony-wrap py-4">
                                <div class="text">
                                    <p class="star">
                                        <span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span>
                                    </p>
                                    <p class="mb-4">The IB Bootcamp transformed my approach to marketing. I now have a clear strategy for my brand!</p>
                                    <div class="d-flex align-items-center">
                                        <div class="user-img" style="background-image: url('https://i.ibb.co/dRLr6zG/1-12.jpg')"></div>
                                        <div class="pl-3">
                                            <p class="name">Tembo Zulu</p>
                                            <span class="position">Coffee Producer</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimony-wrap py-4">
                                <div class="text">
                                    <p class="star">
                                        <span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span>
                                    </p>
                                    <p class="mb-4">Being featured on IB's platform connected me with new customers across Zambia. It's a game-changer!</p>
                                    <div class="d-flex align-items-center">
                                        <div class="user-img" style="background-image: url('https://i.ibb.co/k60rzb0t/1-16.jpg')"></div>
                                        <div class="pl-3">
                                            <p class="name">Mutinta Chileshe</p>
                                            <span class="position">Fashion Designer</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimony-wrap py-4">
                                <div class="text">
                                    <p class="star">
                                        <span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span>
                                    </p>
                                    <p class="mb-4">The networking events helped me find partners who believe in my vision. IB is truly a community!</p>
                                    <div class="d-flex align-items-center">
                                        <div class="user-img" style="background-image: url('https://i.ibb.co/Csp2yHc6/1-2.jpg')"></div>
                                        <div class="pl-3">
                                            <p class="name">Lungu Banda</p>
                                            <span class="position">Tech Entrepreneur</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimony-wrap py-4">
                                <div class="text">
                                    <p class="star">
                                        <span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span>
                                    </p>
                                    <p class="mb-4">IB's platform is a proud showcase of Zambian innovation. I'm honored to be part of this movement!</p>
                                    <div class="d-flex align-items-center">
                                        <div class="user-img" style="background-image: url('https://i.ibb.co/5f6Zzpz/1-2.jpg')"></div>
                                        <div class="pl-3">
                                            <p class="name">Nalu Phiri</p>
                                            <span class="position">Beauty Entrepreneur</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===================== STATS COUNTERS SECTION ===================== --}}
    <section class="ftco-section ftco-counter img ftco-no-pt ftco-no-pb" style="background-image:url('https://i.ibb.co/dRLr6zG/1-12.jpg');">
        <div class="overlay"></div>
        <div class="container py-5">
            <div class="row py-md-5">
                <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                    <div class="block-18 text-center">
                        <div class="text">
                            <strong class="number" data-number="500">0</strong><span>+</span>
                        </div>
                        <div class="text">
                            <span>Brands</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                    <div class="block-18 text-center">
                        <div class="text">
                            <strong class="number" data-number="50">0</strong><span>+</span>
                        </div>
                        <div class="text">
                            <span>Events</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                    <div class="block-18 text-center">
                        <div class="text">
                            <strong class="number" data-number="1000">0</strong><span>+</span>
                        </div>
                        <div class="text">
                            <span>Community Members</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                    <div class="block-18 text-center">
                        <div class="text">
                            <strong class="number" data-number="10">0</strong><span>+</span>
                        </div>
                        <div class="text">
                            <span>Categories</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===================== CTA SECTION ===================== --}}
    @include('partials.cta-section')

@endsection
