@extends('layouts.app')

@section('title', 'Our Brands - Indigenous Brands | Discover Zambian Entrepreneurs')

@section('content')

    {{-- ===================== HERO BANNER ===================== --}}
    @include('partials.hero-banner', ['title' => 'Our Brands'])

    {{-- ===================== FILTER / SEARCH BAR ===================== --}}
    <section class="ftco-section ftco-no-pb">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="search-wrap-1 ftco-animate">
                        <form action="{{ route('brands.index') }}" method="GET" class="search-property-1">
                            <div class="row no-gutters">
                                <div class="col-lg d-flex">
                                    <div class="form-group p-4 border-0">
                                        <label for="brand_name">Brand Name</label>
                                        <div class="form-field">
                                            <div class="icon"><span class="fa fa-search"></span></div>
                                            <input style="z-index: 999; position: relative;" type="text" name="search" id="brand_name" class="form-control" placeholder="Search brand" value="{{ request('search') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg d-flex">
                                    <div class="form-group p-4">
                                        <label for="brand_category">Category</label>
                                        <div class="form-field">
                                            <div class="select-wrap">
                                                <div class="icon"><span class="fa fa-chevron-down"></span></div>
                                                <select style="z-index: 999; position: relative;" name="category" id="brand_category" class="form-control">
                                                    <option value="">All Categories</option>
                                                    @if(isset($categories) && $categories->isNotEmpty())
                                                        @foreach($categories as $category)
                                                            <option value="{{ $category->slug }}" {{ request('category') == $category->slug ? 'selected' : '' }}>
                                                                {{ $category->name }}
                                                            </option>
                                                        @endforeach
                                                    @else
                                                        <option value="fashion">Fashion</option>
                                                        <option value="crafts">Crafts</option>
                                                        <option value="food-beverage">Food &amp; Beverage</option>
                                                        <option value="art">Art</option>
                                                        <option value="jewelry">Jewelry</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg d-flex">
                                    <div class="form-group d-flex w-100 border-0">
                                        <div class="form-field w-100 align-items-center d-flex">
                                            <input type="submit" value="Search" class="align-self-stretch form-control btn btn-primary">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===================== BRANDS GRID ===================== --}}
    <section class="ftco-section">
        <div class="container">

            {{-- Active filters display --}}
            @if(request('search') || request('category'))
                <div class="row mb-3">
                    <div class="col-md-12 ftco-animate">
                        <p class="text-muted">
                            Showing results
                            @if(request('search')) for "<strong>{{ request('search') }}</strong>"@endif
                            @if(request('category')) in category "<strong>{{ request('category') }}</strong>"@endif
                            &mdash; <a href="{{ route('brands.index') }}">Clear filters</a>
                        </p>
                    </div>
                </div>
            @endif

            <div class="row">
                @if($brands->isEmpty())
                    <div class="col-md-12 text-center py-5 ftco-animate">
                        <div class="p-5">
                            <span class="fa fa-search fa-3x text-muted mb-3 d-block"></span>
                            <h4 class="text-muted">No brands found</h4>
                            <p class="text-muted">We couldn't find any brands matching your search criteria. Try adjusting your filters or browse all brands.</p>
                            <a href="{{ route('brands.index') }}" class="btn btn-primary mt-3">Browse All Brands</a>
                        </div>
                    </div>
                @else
                    @foreach($brands as $brand)
                        <div class="col-md-4 ftco-animate">
                            <div class="project-wrap">
                                <a href="{{ route('brands.show', $brand->slug) }}" class="img" style="background-image: url('{{ $brand->logo_url ?? 'https://i.ibb.co/mCBC0x28/1-18.jpg' }}');">
                                    <span class="price">{{ $brand->category->name ?? 'Brand' }}</span>
                                </a>
                                <div class="text p-4">
                                    <p class="star mb-2">
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                    </p>
                                    <h3><a href="{{ route('brands.show', $brand->slug) }}">{{ $brand->name }}</a></h3>
                                    <p class="location"><span class="fa fa-map-marker"></span> {{ $brand->location ?? 'Zambia' }}</p>
                                    @if($brand->tagline)
                                        <p class="text-muted small mb-2"><em>{{ Str::limit($brand->tagline, 80) }}</em></p>
                                    @endif
                                    <ul>
                                        <li><span class="flaticon-shower"></span>{{ $brand->category->name ?? 'Local Brand' }}</li>
                                        @if($brand->location)
                                            <li><span class="flaticon-king-size"></span>{{ $brand->location }}</li>
                                        @endif
                                        @if($brand->tagline)
                                            <li><span class="flaticon-mountains"></span>{{ Str::limit($brand->tagline, 30) }}</li>
                                        @endif
                                    </ul>
                                    <p class="mt-3">
                                        <a href="{{ route('brands.show', $brand->slug) }}" class="btn btn-primary px-4 py-2">View Brand</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            {{-- Pagination --}}
            @if($brands->hasPages())
                <div class="row mt-5">
                    <div class="col text-center ftco-animate">
                        {{ $brands->appends(request()->query())->links() }}
                    </div>
                </div>
            @endif

        </div>
    </section>

    {{-- ===================== CTA SECTION ===================== --}}
    @include('partials.cta-section')

@endsection
