@extends('layouts.app')

@section('title', 'Blog - Indigenous Brands | Stories from Zambian Entrepreneurs')

@section('content')

    {{-- ===================== HERO BANNER ===================== --}}
    @include('partials.hero-banner', ['title' => 'Blog'])

    {{-- ===================== BLOG CONTENT + SIDEBAR ===================== --}}
    <section class="ftco-section">
        <div class="container">
            <div class="row">

                {{-- ============ MAIN POSTS COLUMN ============ --}}
                <div class="col-lg-8">
                    <div class="row d-flex">

                        @if($posts->isEmpty())
                            <div class="col-md-12 text-center py-5 ftco-animate">
                                <div class="p-5">
                                    <span class="fa fa-newspaper-o fa-3x text-muted mb-3 d-block"></span>
                                    <h4 class="text-muted">No posts found</h4>
                                    <p class="text-muted">There are no blog posts available yet. Check back soon for stories from the IB community!</p>
                                </div>
                            </div>
                        @else
                            @foreach($posts as $post)
                                <div class="col-md-6 d-flex ftco-animate">
                                    <div class="blog-entry justify-content-end">
                                        <a href="{{ route('blog.show', $post->slug) }}" class="block-20"
                                            style="background-image: url('{{ $post->featured_image_url ?? 'https://i.ibb.co/5f6Zzpz/1-2.jpg' }}');"></a>
                                        <div class="text">
                                            <div class="d-flex align-items-center mb-4 topp">
                                                <div class="one">
                                                    <span class="day">
                                                        {{ $post->published_at instanceof \Carbon\Carbon
                                                            ? $post->published_at->format('d')
                                                            : \Carbon\Carbon::parse($post->published_at)->format('d') }}
                                                    </span>
                                                </div>
                                                <div class="two">
                                                    <span class="yr">
                                                        {{ $post->published_at instanceof \Carbon\Carbon
                                                            ? $post->published_at->format('Y')
                                                            : \Carbon\Carbon::parse($post->published_at)->format('Y') }}
                                                    </span>
                                                    <span class="mos">
                                                        {{ $post->published_at instanceof \Carbon\Carbon
                                                            ? $post->published_at->format('F')
                                                            : \Carbon\Carbon::parse($post->published_at)->format('F') }}
                                                    </span>
                                                </div>
                                            </div>
                                            @if($post->category)
                                                <div class="meta-info mb-2">
                                                    <span class="badge badge-primary">{{ $post->category->name }}</span>
                                                </div>
                                            @endif
                                            <h3 class="heading">
                                                <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                                            </h3>
                                            @if($post->excerpt)
                                                <p>{{ Str::limit($post->excerpt, 100) }}</p>
                                            @endif
                                            @if($post->brand)
                                                <p class="text-muted small">
                                                    <span class="fa fa-user mr-1"></span>{{ $post->brand->name }}
                                                </p>
                                            @endif
                                            <p><a href="{{ route('blog.show', $post->slug) }}" class="btn btn-primary">Read more</a></p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                    </div>

                    {{-- Pagination --}}
                    @if($posts->hasPages())
                        <div class="row mt-5">
                            <div class="col text-center ftco-animate">
                                {{ $posts->appends(request()->query())->links() }}
                            </div>
                        </div>
                    @endif
                </div>

                {{-- ============ SIDEBAR COLUMN ============ --}}
                <div class="col-lg-4 sidebar ftco-animate bg-light py-4 px-3">

                    {{-- Search Widget --}}
                    <div class="sidebar-box pt-md-4">
                        <form action="{{ route('blog.index') }}" method="GET" class="search-form">
                            <div class="form-group">
                                <span class="icon fa fa-search"></span>
                                <input type="text" name="search" class="form-control" placeholder="Search posts..." value="{{ request('search') }}">
                            </div>
                        </form>
                    </div>

                    {{-- Categories Widget --}}
                    <div class="sidebar-box ftco-animate">
                        <div class="categories">
                            <h3>Categories</h3>
                            @if(isset($categories) && $categories->isNotEmpty())
                                @foreach($categories as $category)
                                    <li>
                                        <a href="{{ route('blog.index', ['category' => $category->slug]) }}">
                                            {{ $category->name }}
                                            @if(isset($category->posts_count))
                                                <span>({{ $category->posts_count }})</span>
                                            @endif
                                        </a>
                                    </li>
                                @endforeach
                            @else
                                <li><a href="{{ route('blog.index', ['category' => 'fashion']) }}">Fashion <span>(12)</span></a></li>
                                <li><a href="{{ route('blog.index', ['category' => 'entrepreneurship']) }}">Entrepreneurship <span>(22)</span></a></li>
                                <li><a href="{{ route('blog.index', ['category' => 'zambian-culture']) }}">Zambian Culture <span>(37)</span></a></li>
                                <li><a href="{{ route('blog.index', ['category' => 'innovation']) }}">Innovation <span>(42)</span></a></li>
                                <li><a href="{{ route('blog.index', ['category' => 'sustainability']) }}">Sustainability <span>(14)</span></a></li>
                                <li><a href="{{ route('blog.index', ['category' => 'events']) }}">Events <span>(140)</span></a></li>
                            @endif
                        </div>
                    </div>

                    {{-- Recent Posts Widget --}}
                    <div class="sidebar-box ftco-animate">
                        <h3>Recent Blog</h3>
                        @if(isset($recentPosts) && $recentPosts->isNotEmpty())
                            @foreach($recentPosts->take(3) as $recentPost)
                                <div class="block-21 mb-4 d-flex">
                                    <a href="{{ route('blog.show', $recentPost->slug) }}" class="blog-img mr-4"
                                        style="background-image: url('{{ $recentPost->featured_image_url ?? 'https://i.ibb.co/5f6Zzpz/1-2.jpg' }}');"></a>
                                    <div class="text">
                                        <h3 class="heading">
                                            <a href="{{ route('blog.show', $recentPost->slug) }}">{{ Str::limit($recentPost->title, 50) }}</a>
                                        </h3>
                                        <div class="meta">
                                            <div>
                                                <a href="{{ route('blog.show', $recentPost->slug) }}">
                                                    <span class="fa fa-calendar"></span>
                                                    {{ $recentPost->published_at instanceof \Carbon\Carbon
                                                        ? $recentPost->published_at->format('F j, Y')
                                                        : \Carbon\Carbon::parse($recentPost->published_at)->format('F j, Y') }}
                                                </a>
                                            </div>
                                            @if($recentPost->brand)
                                                <div>
                                                    <a href="{{ route('blog.show', $recentPost->slug) }}">
                                                        <span class="fa fa-user"></span> {{ $recentPost->brand->name }}
                                                    </a>
                                                </div>
                                            @endif
                                            @if(isset($recentPost->comments_count))
                                                <div>
                                                    <a href="{{ route('blog.show', $recentPost->slug) }}">
                                                        <span class="fa fa-comment"></span> {{ $recentPost->comments_count }}
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-muted">No recent posts available.</p>
                        @endif
                    </div>

                    {{-- Tag Cloud Widget --}}
                    <div class="sidebar-box ftco-animate">
                        <h3>Tag Cloud</h3>
                        <div class="tagcloud">
                            @if(isset($tags) && $tags->isNotEmpty())
                                @foreach($tags as $tag)
                                    <a href="{{ route('blog.index', ['tag' => $tag->slug]) }}" class="tag-cloud-link">{{ $tag->name }}</a>
                                @endforeach
                            @else
                                <a href="{{ route('blog.index', ['tag' => 'fashion']) }}" class="tag-cloud-link">Fashion</a>
                                <a href="{{ route('blog.index', ['tag' => 'entrepreneurship']) }}" class="tag-cloud-link">Entrepreneurship</a>
                                <a href="{{ route('blog.index', ['tag' => 'zambian-culture']) }}" class="tag-cloud-link">Zambian Culture</a>
                                <a href="{{ route('blog.index', ['tag' => 'sustainability']) }}" class="tag-cloud-link">Sustainability</a>
                                <a href="{{ route('blog.index', ['tag' => 'innovation']) }}" class="tag-cloud-link">Innovation</a>
                                <a href="{{ route('blog.index', ['tag' => 'artisans']) }}" class="tag-cloud-link">Artisans</a>
                                <a href="{{ route('blog.index', ['tag' => 'community']) }}" class="tag-cloud-link">Community</a>
                                <a href="{{ route('blog.index', ['tag' => 'events']) }}" class="tag-cloud-link">Events</a>
                            @endif
                        </div>
                    </div>

                    {{-- About Widget --}}
                    <div class="sidebar-box ftco-animate">
                        <h3>About Indigenous Brands</h3>
                        <p>Indigenous Brands is a movement to empower Zambian entrepreneurs, showcasing their creativity and innovation to the world. Join us to celebrate and support local talent!</p>
                        <p><a href="{{ route('about') }}" class="btn btn-primary btn-sm">Learn More</a></p>
                    </div>

                </div>
                {{-- END sidebar --}}

            </div>
        </div>
    </section>

    {{-- ===================== CTA SECTION ===================== --}}
    @include('partials.cta-section')

@endsection
