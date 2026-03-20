@extends('layouts.app')

@section('title', $post->title . ' - Indigenous Brands Blog')

@section('content')

    {{-- ===================== HERO BANNER ===================== --}}
    <section class="hero-wrap hero-wrap-2 js-fullheight"
        style="background-image: url('{{ $post->featured_image_url ?? 'https://i.ibb.co/dRLr6zG/1-12.jpg' }}');">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
                <div class="col-md-9 ftco-animate pb-5 text-center">
                    <p class="breadcrumbs">
                        <span class="mr-2"><a href="{{ route('home') }}">Home <i class="fa fa-chevron-right"></i></a></span>
                        <span class="mr-2"><a href="{{ route('blog.index') }}">Blog <i class="fa fa-chevron-right"></i></a></span>
                        <span>{{ Str::limit($post->title, 40) }} <i class="fa fa-chevron-right"></i></span>
                    </p>
                    <h1 class="mb-0 bread">{{ $post->title }}</h1>
                </div>
            </div>
        </div>
    </section>

    {{-- ===================== BLOG POST CONTENT + SIDEBAR ===================== --}}
    <section class="ftco-section ftco-no-pt ftco-no-pb">
        <div class="container">
            <div class="row">

                {{-- ============ MAIN POST COLUMN ============ --}}
                <div class="col-lg-8 ftco-animate py-md-5 mt-md-5">

                    {{-- Post Meta --}}
                    <div class="d-flex align-items-center mb-3 flex-wrap">
                        @if($post->category)
                            <span class="badge badge-primary mr-2">{{ $post->category->name }}</span>
                        @endif
                        <span class="text-muted mr-3">
                            <span class="fa fa-calendar mr-1"></span>
                            {{ isset($post->published_at_formatted)
                                ? $post->published_at_formatted
                                : ($post->published_at instanceof \Carbon\Carbon
                                    ? $post->published_at->format('F j, Y')
                                    : \Carbon\Carbon::parse($post->published_at)->format('F j, Y')) }}
                        </span>
                        @if($post->brand)
                            <span class="text-muted">
                                <span class="fa fa-user mr-1"></span>
                                <a href="{{ route('brands.show', $post->brand->slug) }}">{{ $post->brand->name }}</a>
                            </span>
                        @endif
                    </div>

                    <h2 class="mb-3">{{ $post->title }}</h2>

                    {{-- Featured Image --}}
                    @if($post->featured_image_url)
                        <p>
                            <img src="{{ $post->featured_image_url }}" alt="{{ $post->title }}" class="img-fluid rounded">
                        </p>
                    @endif

                    {{-- Post Body --}}
                    <div class="post-body mt-4">
                        {!! $post->body !!}
                    </div>

                    {{-- Tags --}}
                    @if(isset($post->tags) && $post->tags->isNotEmpty())
                        <div class="tag-widget post-tag-container mb-5 mt-5">
                            <div class="tagcloud">
                                @foreach($post->tags as $tag)
                                    <a href="{{ route('blog.index', ['tag' => $tag->slug]) }}" class="tag-cloud-link">{{ $tag->name }}</a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Author Bio Box --}}
                    @if($post->brand)
                        <div class="about-author d-flex p-4 bg-light mt-5">
                            <div class="bio mr-5">
                                @if($post->brand->logo_url)
                                    <img src="{{ $post->brand->logo_url }}" alt="{{ $post->brand->name }}" class="img-fluid mb-4" style="max-width: 80px; border-radius: 50%;">
                                @else
                                    <div style="width:80px;height:80px;background:#fd7e14;border-radius:50%;display:flex;align-items:center;justify-content:center;">
                                        <span class="fa fa-user fa-2x text-white"></span>
                                    </div>
                                @endif
                            </div>
                            <div class="desc">
                                <h3>{{ $post->brand->name }}</h3>
                                @if($post->brand->tagline)
                                    <p class="text-muted"><em>{{ $post->brand->tagline }}</em></p>
                                @endif
                                @if($post->brand->description)
                                    <p>{{ Str::limit(strip_tags($post->brand->description), 200) }}</p>
                                @endif
                                <a href="{{ route('brands.show', $post->brand->slug) }}" class="btn btn-primary btn-sm">View Brand</a>
                            </div>
                        </div>
                    @endif

                    {{-- ============ COMMENTS SECTION ============ --}}
                    <div class="pt-5 mt-5">
                        @php
                            $totalComments = 0;
                            foreach($comments as $comment) {
                                $totalComments++;
                                if(isset($comment->replies)) {
                                    $totalComments += $comment->replies->count();
                                }
                            }
                        @endphp

                        <h3 class="mb-5" style="font-size: 20px; font-weight: bold;">
                            {{ $totalComments }} {{ Str::plural('Comment', $totalComments) }}
                        </h3>

                        @if($comments->isNotEmpty())
                            <ul class="comment-list">
                                @foreach($comments as $comment)
                                    <li class="comment">
                                        <div class="vcard bio">
                                            <img src="https://i.ibb.co/mCBC0x28/1-18.jpg" alt="{{ $comment->name }}">
                                        </div>
                                        <div class="comment-body">
                                            <h3>{{ $comment->name }}</h3>
                                            <div class="meta">
                                                {{ $comment->created_at instanceof \Carbon\Carbon
                                                    ? $comment->created_at->format('F j, Y') . ' at ' . $comment->created_at->format('g:ia')
                                                    : \Carbon\Carbon::parse($comment->created_at)->format('F j, Y \a\t g:ia') }}
                                            </div>
                                            <p>{{ $comment->message }}</p>
                                        </div>

                                        {{-- Replies --}}
                                        @if(isset($comment->replies) && $comment->replies->isNotEmpty())
                                            <ul class="children">
                                                @foreach($comment->replies as $reply)
                                                    <li class="comment">
                                                        <div class="vcard bio">
                                                            <img src="https://i.ibb.co/dRLr6zG/1-12.jpg" alt="{{ $reply->name }}">
                                                        </div>
                                                        <div class="comment-body">
                                                            <h3>{{ $reply->name }}</h3>
                                                            <div class="meta">
                                                                {{ $reply->created_at instanceof \Carbon\Carbon
                                                                    ? $reply->created_at->format('F j, Y') . ' at ' . $reply->created_at->format('g:ia')
                                                                    : \Carbon\Carbon::parse($reply->created_at)->format('F j, Y \a\t g:ia') }}
                                                            </div>
                                                            <p>{{ $reply->message }}</p>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-muted">No comments yet. Be the first to share your thoughts!</p>
                        @endif

                        {{-- ============ COMMENT FORM ============ --}}
                        <div class="comment-form-wrap pt-5">
                            <h3 class="mb-5" style="font-size: 20px; font-weight: bold;">Leave a Comment</h3>

                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <span class="fa fa-check-circle mr-2"></span>
                                    {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <div class="p-5 bg-light">
                                <form action="{{ route('blog.comments.store', $post->slug) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="parent_id" value="0">

                                    <div class="form-group">
                                        <label for="comment_name">Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" id="comment_name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="comment_email">Email <span class="text-danger">*</span></label>
                                        <input type="email" name="email" id="comment_email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="comment_website">Website</label>
                                        <input type="url" name="website" id="comment_website" class="form-control @error('website') is-invalid @enderror" value="{{ old('website') }}">
                                        @error('website')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="comment_message">Message <span class="text-danger">*</span></label>
                                        <textarea name="message" id="comment_message" cols="30" rows="10" class="form-control @error('message') is-invalid @enderror" required>{{ old('message') }}</textarea>
                                        @error('message')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <input type="submit" value="Post Comment" class="btn py-3 px-4 btn-primary">
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
                {{-- END main post column --}}

                {{-- ============ SIDEBAR COLUMN ============ --}}
                <div class="col-lg-4 sidebar ftco-animate bg-light py-md-5">

                    {{-- Search Widget --}}
                    <div class="sidebar-box pt-md-5">
                        <form action="{{ route('blog.index') }}" method="GET" class="search-form">
                            <div class="form-group">
                                <span class="icon fa fa-search"></span>
                                <input type="text" name="search" class="form-control" placeholder="Search..." value="{{ request('search') }}">
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
