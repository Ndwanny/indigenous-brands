@extends('layouts.app')

@section('title', $brand->name . ' - Indigenous Brands')

@section('content')

    {{-- ===================== HERO BANNER WITH BRAND COVER ===================== --}}
    <section class="hero-wrap hero-wrap-2 js-fullheight"
        style="background-image: url('{{ $brand->cover_image_url ?? $brand->logo_url ?? 'https://i.ibb.co/dRLr6zG/1-12.jpg' }}');">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
                <div class="col-md-9 ftco-animate pb-5 text-center">
                    <p class="breadcrumbs">
                        <span class="mr-2"><a href="{{ route('home') }}">Home <i class="fa fa-chevron-right"></i></a></span>
                        <span class="mr-2"><a href="{{ route('brands.index') }}">Brands <i class="fa fa-chevron-right"></i></a></span>
                        <span>{{ $brand->name }} <i class="fa fa-chevron-right"></i></span>
                    </p>
                    <h1 class="mb-0 bread">{{ $brand->name }}</h1>
                </div>
            </div>
        </div>
    </section>

    {{-- ===================== BRAND PROFILE SECTION ===================== --}}
    <section class="ftco-section">
        <div class="container">
            <div class="row">

                {{-- Brand Logo & Info Card --}}
                <div class="col-md-4 ftco-animate">
                    <div class="project-wrap text-center">
                        @if($brand->logo_url)
                            <div class="p-4">
                                <img src="{{ $brand->logo_url }}" alt="{{ $brand->name }} logo" class="img-fluid mb-3" style="max-height: 180px; object-fit: contain;">
                            </div>
                        @else
                            <div class="img" style="background-image: url('https://i.ibb.co/mCBC0x28/1-18.jpg'); height: 200px;"></div>
                        @endif
                        <div class="text p-4">
                            <h3>{{ $brand->name }}</h3>
                            @if($brand->category)
                                <span class="badge badge-primary mb-2">{{ $brand->category->name }}</span>
                            @endif
                            @if($brand->location)
                                <p class="location mt-2"><span class="fa fa-map-marker"></span> {{ $brand->location }}</p>
                            @endif
                            @if($brand->website)
                                <p><a href="{{ $brand->website }}" target="_blank" rel="noopener noreferrer" class="btn btn-outline-primary btn-sm mt-2">
                                    <span class="fa fa-globe"></span> Visit Website
                                </a></p>
                            @endif

                            {{-- Social Links --}}
                            @if($brand->facebook || $brand->instagram || $brand->twitter)
                                <div class="social-links mt-3">
                                    <p class="text-muted small mb-2">Follow Us</p>
                                    <ul class="ftco-footer-social list-unstyled d-flex justify-content-center">
                                        @if($brand->twitter)
                                            <li><a href="{{ $brand->twitter }}" target="_blank" rel="noopener noreferrer"><span class="fa fa-twitter"></span></a></li>
                                        @endif
                                        @if($brand->facebook)
                                            <li><a href="{{ $brand->facebook }}" target="_blank" rel="noopener noreferrer"><span class="fa fa-facebook"></span></a></li>
                                        @endif
                                        @if($brand->instagram)
                                            <li><a href="{{ $brand->instagram }}" target="_blank" rel="noopener noreferrer"><span class="fa fa-instagram"></span></a></li>
                                        @endif
                                    </ul>
                                </div>
                            @endif

                            {{-- Contact Info --}}
                            @if($brand->email || $brand->phone)
                                <div class="block-23 mt-3 text-left">
                                    <ul>
                                        @if($brand->email)
                                            <li>
                                                <a href="mailto:{{ $brand->email }}">
                                                    <span class="icon fa fa-paper-plane"></span>
                                                    <span class="text">{{ $brand->email }}</span>
                                                </a>
                                            </li>
                                        @endif
                                        @if($brand->phone)
                                            <li>
                                                <a href="tel:{{ $brand->phone }}">
                                                    <span class="icon fa fa-phone"></span>
                                                    <span class="text">{{ $brand->phone }}</span>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Brand Description --}}
                <div class="col-md-8 pl-md-5 ftco-animate">
                    <div class="heading-section mb-4">
                        <span class="subheading">{{ $brand->category->name ?? 'Indigenous Brand' }}</span>
                        <h2 class="mb-3">{{ $brand->name }}</h2>
                        @if($brand->tagline)
                            <p class="text-muted lead"><em>"{{ $brand->tagline }}"</em></p>
                        @endif
                    </div>

                    @if($brand->description)
                        <div class="brand-description mb-4">
                            {!! $brand->description !!}
                        </div>
                    @endif

                    <div class="row mt-4">
                        @if($brand->location)
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-start">
                                    <span class="fa fa-map-marker mt-1 mr-2 text-primary"></span>
                                    <div>
                                        <strong>Location</strong><br>
                                        <span class="text-muted">{{ $brand->location }}</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($brand->category)
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-start">
                                    <span class="fa fa-tag mt-1 mr-2 text-primary"></span>
                                    <div>
                                        <strong>Category</strong><br>
                                        <span class="text-muted">{{ $brand->category->name }}</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($brand->website)
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-start">
                                    <span class="fa fa-globe mt-1 mr-2 text-primary"></span>
                                    <div>
                                        <strong>Website</strong><br>
                                        <a href="{{ $brand->website }}" target="_blank" rel="noopener noreferrer" class="text-muted">{{ $brand->website }}</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($brand->user)
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-start">
                                    <span class="fa fa-user mt-1 mr-2 text-primary"></span>
                                    <div>
                                        <strong>Brand Owner</strong><br>
                                        <span class="text-muted">{{ $brand->user->name }}</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('contact') }}" class="btn btn-primary py-3 px-4 mr-2">
                            <span class="fa fa-envelope mr-1"></span> Contact Brand
                        </a>
                        <a href="{{ route('brands.index') }}" class="btn btn-outline-secondary py-3 px-4">
                            <span class="fa fa-arrow-left mr-1"></span> Back to Brands
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ===================== BRAND POSTS SECTION ===================== --}}
    @if(isset($brand->posts) && $brand->posts->isNotEmpty())
        <section class="ftco-section bg-light">
            <div class="container">
                <div class="row justify-content-center pb-4">
                    <div class="col-md-12 heading-section text-center ftco-animate">
                        <span class="subheading">From {{ $brand->name }}</span>
                        <h2 class="mb-4">Brand Stories &amp; Updates</h2>
                    </div>
                </div>
                <div class="row d-flex">
                    @foreach($brand->posts->take(6) as $post)
                        <div class="col-md-4 d-flex ftco-animate">
                            <div class="blog-entry justify-content-end">
                                <a href="{{ route('blog.show', $post->slug) }}" class="block-20"
                                    style="background-image: url('{{ $post->featured_image_url ?? 'https://i.ibb.co/5f6Zzpz/1-2.jpg' }}');"></a>
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
                                    <h3 class="heading"><a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a></h3>
                                    @if($post->excerpt)
                                        <p>{{ Str::limit($post->excerpt, 90) }}</p>
                                    @endif
                                    <p><a href="{{ route('blog.show', $post->slug) }}" class="btn btn-primary">Read more</a></p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row mt-4">
                    <div class="col-md-12 text-center ftco-animate">
                        <a href="{{ route('blog.index') }}" class="btn btn-outline-primary py-3 px-5">View All Posts</a>
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- ===================== CTA SECTION ===================== --}}
    @include('partials.cta-section')

@endsection
