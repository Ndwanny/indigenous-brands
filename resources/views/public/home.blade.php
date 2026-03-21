@extends('layouts.app')

@section('title', 'Home - Indigenous Brands | Empowering Zambian Entrepreneurs')

@section('content')

    {{-- ===================== HERO SECTION ===================== --}}
    <div class="hero-wrap js-fullheight" style="background-image: url('{{ asset('images/hero-bg.jpg') }}');">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-center" data-scrollax-parent="true">
                <div class="col-md-7 ftco-animate">
                    <span class="subheading">Welcome to Indigenous Brands</span>
                    <h1 class="mb-4">Your Brand, Our Pride</h1>
                    <p class="caps">Join the movement to celebrate and empower Zambian entrepreneurs</p>
                </div>
                <a href="https://vimeo.com/45830194" class="icon-video popup-vimeo d-flex align-items-center justify-content-center mb-4">
                    <span class="fa fa-play"></span>
                </a>
            </div>
        </div>
    </div>

    {{-- ===================== SEARCH TABS SECTION ===================== --}}
    <section class="ftco-section ftco-no-pb ftco-no-pt">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="ftco-search d-flex justify-content-center">
                        <div class="row">
                            <div class="col-md-12 nav-link-wrap">
                                <div class="nav nav-pills text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <a class="nav-link active mr-md-1" id="v-pills-1-tab" data-toggle="pill" href="#v-pills-1" role="tab" aria-controls="v-pills-1" aria-selected="true">Find Brands</a>
                                    <a class="nav-link" id="v-pills-2-tab" data-toggle="pill" href="#v-pills-2" role="tab" aria-controls="v-pills-2" aria-selected="false">Events</a>
                                </div>
                            </div>
                            <div class="col-md-12 tab-wrap">
                                <div class="tab-content" id="v-pills-tabContent">

                                    {{-- Find Brands Tab --}}
                                    <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel" aria-labelledby="v-pills-1-tab">
                                        <form action="{{ route('brands.index') }}" method="GET" class="search-property-1">
                                            <div class="row no-gutters">
                                                <div class="col-md d-flex">
                                                    <div class="form-group p-4 border-0">
                                                        <label for="brand_search">Search Brands</label>
                                                        <div class="form-field">
                                                            <div class="icon"><span class="fa fa-search"></span></div>
                                                            <input style="z-index: 999; position: relative;" type="text" name="search" id="brand_search" class="form-control" placeholder="Search for Zambian brands" value="{{ request('search') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md d-flex">
                                                    <div class="form-group p-4">
                                                        <label for="brand_category">Category</label>
                                                        <div class="form-field">
                                                            <div class="select-wrap">
                                                                <div class="icon"><span class="fa fa-chevron-down"></span></div>
                                                                <select style="z-index: 999; position: relative;" name="category" id="brand_category" class="form-control">
                                                                    <option value="">All Categories</option>
                                                                    <option value="fashion">Fashion</option>
                                                                    <option value="food-beverage">Food &amp; Beverage</option>
                                                                    <option value="art-crafts">Art &amp; Crafts</option>
                                                                    <option value="technology">Technology</option>
                                                                    <option value="beauty">Beauty</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md d-flex">
                                                    <div class="form-group d-flex w-100 border-0">
                                                        <div class="form-field w-100 align-items-center d-flex">
                                                            <input type="submit" value="Search" class="align-self-stretch form-control btn btn-primary">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    {{-- Events Tab --}}
                                    <div class="tab-pane fade" id="v-pills-2" role="tabpanel" aria-labelledby="v-pills-2-tab">
                                        <form action="{{ route('events.index') }}" method="GET" class="search-property-1">
                                            <div class="row no-gutters">
                                                <div class="col-lg d-flex">
                                                    <div class="form-group p-4 border-0">
                                                        <label for="event_search">Event Name</label>
                                                        <div class="form-field">
                                                            <div class="icon"><span class="fa fa-search"></span></div>
                                                            <input style="z-index: 999; position: relative;" type="text" name="search" id="event_search" class="form-control" placeholder="Search for events" value="{{ request('search') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg d-flex">
                                                    <div class="form-group p-4">
                                                        <label for="event_date">Event Date</label>
                                                        <div class="form-field">
                                                            <div class="icon"><span class="fa fa-calendar"></span></div>
                                                            <input style="z-index: 999; position: relative;" type="text" name="date" id="event_date" class="form-control checkin_date" placeholder="Select Date">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg d-flex">
                                                    <div class="form-group d-flex w-100 border-0">
                                                        <div class="form-field w-100 align-items-center d-flex">
                                                            <input type="submit" value="Search" class="align-self-stretch form-control btn btn-primary p-0">
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
            </div>
        </div>
    </section>

    {{-- ===================== INTRO / SERVICES SECTION ===================== --}}
    <section class="ftco-section services-section">
        <div class="container">
            <div class="row d-flex">
                <div class="col-md-6 order-md-last heading-section pl-md-5 ftco-animate d-flex align-items-center">
                    <div class="w-100">
                        <span class="subheading">Welcome to Indigenous Brands</span>
                        <h2 class="mb-4">Join the Movement</h2>
                        <p>Indigenous Brands (IB) is a vibrant movement celebrating the creativity, strength, and growth of Zambian entrepreneurs. We empower local brands to shine on a national and global stage.</p>
                        <p>From artisan crafts to innovative startups, IB is your platform to discover and support Zambia's finest. Join our community to connect, collaborate, and grow together!</p>
                        <p><a href="{{ route('get-involved') }}" class="btn btn-primary py-3 px-4">Get Involved</a></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12 col-lg-6 d-flex align-self-stretch ftco-animate">
                            <div class="services services-1 color-1 d-block img" style="background-image: url('https://i.ibb.co/mCBC0x28/1-18.jpg');">
                                <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-paragliding"></span></div>
                                <div class="media-body">
                                    <h3 class="heading mb-3">Brand Features</h3>
                                    <p>Showcase your Zambian-made products to a passionate community.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6 d-flex align-self-stretch ftco-animate">
                            <div class="services services-1 color-2 d-block img" style="background-image: url('https://i.ibb.co/dRLr6zG/1-12.jpg');">
                                <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-route"></span></div>
                                <div class="media-body">
                                    <h3 class="heading mb-3">Events &amp; Bootcamps</h3>
                                    <p>Join our Coffee Dates and Bootcamps to network and learn.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6 d-flex align-self-stretch ftco-animate">
                            <div class="services services-1 color-3 d-block img" style="background-image: url('https://i.ibb.co/k60rzb0t/1-16.jpg');">
                                <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-tour-guide"></span></div>
                                <div class="media-body">
                                    <h3 class="heading mb-3">Community Support</h3>
                                    <p>Connect with mentors, partners, and ambassadors to grow your brand.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6 d-flex align-self-stretch ftco-animate">
                            <div class="services services-1 color-4 d-block img" style="background-image: url('https://i.ibb.co/Csp2yHc6/1-2.jpg');">
                                <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-map"></span></div>
                                <div class="media-body">
                                    <h3 class="heading mb-3">Newsletter</h3>
                                    <p>Stay updated with the latest IB news and opportunities.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===================== FEATURED BRANDS CAROUSEL ===================== --}}
    <section class="ftco-section img ftco-select-destination" style="background-image: url('https://i.ibb.co/dRLr6zG/1-12.jpg');">
        <div class="container">
            <div class="row justify-content-center pb-4">
                <div class="col-md-12 heading-section text-center ftco-animate">
                    <span class="subheading">Discover Local Talent</span>
                    <h2 class="mb-4">Featured Zambian Brands</h2>
                </div>
            </div>
        </div>
        <div class="container container-2">
            <div class="row">
                <div class="col-md-12">
                    @if($featuredBrands->isNotEmpty())
                        <div class="carousel-destination owl-carousel ftco-animate">
                            @foreach($featuredBrands as $brand)
                                <div class="item">
                                    <div class="project-destination">
                                        <a href="{{ route('brands.show', $brand->slug) }}" class="img" style="background-image: url('{{ $brand->logo_url ?? 'https://i.ibb.co/mCBC0x28/1-18.jpg' }}');">
                                            <div class="text">
                                                <h3>{{ $brand->name }}</h3>
                                                <span>{{ $brand->category->name ?? 'Zambian Brand' }}</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5">
                            <p class="text-white">No featured brands available at the moment. <a href="{{ route('get-involved') }}" class="btn btn-primary btn-sm mt-2">Feature Your Brand</a></p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- ===================== UPCOMING EVENTS SECTION ===================== --}}
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center pb-4">
                <div class="col-md-12 heading-section text-center ftco-animate">
                    <span class="subheading">Upcoming Events</span>
                    <h2 class="mb-4">Join Our Community Events</h2>
                </div>
            </div>
            <div class="row">
                @if($upcomingEvents->isNotEmpty())
                    @foreach($upcomingEvents as $event)
                        <div class="col-md-4 ftco-animate">
                            <div class="project-wrap">
                                <a href="{{ route('events.index') }}" class="img" style="background-image: url('{{ $event->featured_image_url ?? 'https://i.ibb.co/dRLr6zG/1-12.jpg' }}');">
                                    <span class="price">{{ $event->formatted_price ?? 'Free' }}</span>
                                </a>
                                <div class="text p-4">
                                    <span class="days">{{ $event->event_type ?? 'Event' }}</span>
                                    <h3><a href="{{ route('events.index') }}">{{ $event->title }}</a></h3>
                                    <p class="location"><span class="fa fa-map-marker"></span> {{ $event->location }}</p>
                                    <ul>
                                        <li><span class="flaticon-shower"></span>{{ $event->event_type ?? 'Community Event' }}</li>
                                        <li><span class="flaticon-king-size"></span>{{ $event->event_date instanceof \Carbon\Carbon ? $event->event_date->format('F j, Y') : $event->event_date }}</li>
                                        <li><span class="flaticon-mountains"></span>{{ $event->venue ?? $event->location }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-md-12 text-center py-4 ftco-animate">
                        <p class="text-muted">No upcoming events at the moment. Check back soon!</p>
                        <a href="{{ route('events.index') }}" class="btn btn-primary mt-2">View All Events</a>
                    </div>
                @endif
            </div>
            <div class="row mt-4">
                <div class="col-md-12 text-center ftco-animate">
                    <a href="{{ route('events.index') }}" class="btn btn-primary py-3 px-5">View All Events</a>
                </div>
            </div>
        </div>
    </section>

    {{-- ===================== VIDEO SECTION ===================== --}}
    <section class="ftco-section ftco-about img" style="background-image: url('https://i.ibb.co/k60rzb0t/1-16.jpg');">
        <div class="overlay"></div>
        <div class="container py-md-5">
            <div class="row py-md-5">
                <div class="col-md d-flex align-items-center justify-content-center">
                    <a href="https://vimeo.com/45830194" class="icon-video popup-vimeo d-flex align-items-center justify-content-center mb-4">
                        <span class="fa fa-play"></span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- ===================== ABOUT INTRO SECTION ===================== --}}
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
                                    <span class="subheading">About Indigenous Brands</span>
                                    <h2 class="mb-4">Empowering Zambian Entrepreneurs</h2>
                                    <p>Indigenous Brands is a movement to celebrate and uplift Zambian creativity, innovation, and entrepreneurship. Our mission is to provide a platform for local brands to shine, connect, and grow, fostering a vibrant community of proud Zambian businesses.</p>
                                    <p><a href="{{ route('about') }}" class="btn btn-primary">Learn More</a></p>
                                </div>
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

    {{-- ===================== STATS SECTION ===================== --}}
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

    {{-- ===================== RECENT BLOG POSTS SECTION ===================== --}}
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center pb-4">
                <div class="col-md-12 heading-section text-center ftco-animate">
                    <span class="subheading">Our Stories</span>
                    <h2 class="mb-4">Recent Posts</h2>
                </div>
            </div>
            <div class="row d-flex">
                @if($recentPosts->isNotEmpty())
                    @foreach($recentPosts->take(3) as $post)
                        <div class="col-md-4 d-flex ftco-animate">
                            <div class="blog-entry justify-content-end">
                                <a href="{{ route('blog.show', $post->slug) }}" class="block-20" style="background-image: url('{{ $post->featured_image_url ?? 'https://i.ibb.co/5f6Zzpz/1-2.jpg' }}');"></a>
                                <div class="text">
                                    <div class="d-flex align-items-center mb-4 topp">
                                        <div class="one">
                                            <span class="day">{{ $post->published_at instanceof \Carbon\Carbon ? $post->published_at->format('d') : \Carbon\Carbon::parse($post->published_at)->format('d') }}</span>
                                        </div>
                                        <div class="two">
                                            <span class="yr">{{ $post->published_at instanceof \Carbon\Carbon ? $post->published_at->format('Y') : \Carbon\Carbon::parse($post->published_at)->format('Y') }}</span>
                                            <span class="mos">{{ $post->published_at instanceof \Carbon\Carbon ? $post->published_at->format('F') : \Carbon\Carbon::parse($post->published_at)->format('F') }}</span>
                                        </div>
                                    </div>
                                    @if($post->category)
                                        <div class="meta-info mb-2">
                                            <span class="badge badge-primary">{{ $post->category->name }}</span>
                                        </div>
                                    @endif
                                    <h3 class="heading"><a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a></h3>
                                    @if($post->excerpt)
                                        <p>{{ Str::limit($post->excerpt, 100) }}</p>
                                    @endif
                                    @if($post->brand)
                                        <p class="text-muted small"><span class="fa fa-user"></span> {{ $post->brand->name }}</p>
                                    @endif
                                    <p><a href="{{ route('blog.show', $post->slug) }}" class="btn btn-primary">Read more</a></p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-md-12 text-center py-4 ftco-animate">
                        <p class="text-muted">No blog posts available yet. Check back soon for stories from the IB community!</p>
                        <a href="{{ route('blog.index') }}" class="btn btn-primary mt-2">Visit Blog</a>
                    </div>
                @endif
            </div>
        </div>
    </section>

    {{-- ===================== CTA SECTION ===================== --}}
    @include('partials.cta-section')

@endsection
