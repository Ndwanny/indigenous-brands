@extends('layouts.brand-owner')

@section('title', 'Dashboard')

@section('content')

    <div class="bo-page-header d-flex align-items-center justify-content-between flex-wrap">
        <div>
            <h1><i class="fa fa-tachometer mr-2"></i>Dashboard</h1>
            <p>Welcome back, {{ auth()->user()->name }}. Here's an overview of your brand activity.</p>
        </div>
    </div>

    {{-- ===== NO BRAND YET ===== --}}
    @if (! $brand)
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center py-5">
                <div style="font-size:3.5rem; color:#fd7e14; margin-bottom:1rem;">
                    <i class="fa fa-building-o"></i>
                </div>
                <h3 class="font-weight-bold" style="color:#1a1a2e;">Complete Your Brand Profile</h3>
                <p class="text-muted mb-4" style="max-width:480px; margin:0 auto 1.5rem;">
                    You haven't set up your brand yet. Create your brand profile so you can start publishing
                    posts and reaching customers on Indigenous Brands Zambia.
                </p>
                <a href="{{ route('brand-owner.brand.create') }}" class="btn btn-primary btn-lg px-5">
                    <i class="fa fa-plus-circle mr-2"></i>Set Up My Brand
                </a>
            </div>
        </div>

    {{-- ===== BRAND EXISTS ===== --}}
    @else

        {{-- Brand Status Banner --}}
        @if ($brand->status === 'rejected')
            <div class="alert alert-danger d-flex align-items-start" role="alert">
                <i class="fa fa-times-circle fa-lg mr-3 mt-1"></i>
                <div>
                    <strong>Your brand profile was rejected.</strong>
                    @if ($brand->rejection_reason)
                        <br>
                        <span>{{ $brand->rejection_reason }}</span>
                    @endif
                    <br>
                    <a href="{{ route('brand-owner.brand.edit', $brand) }}" class="alert-link mt-1 d-inline-block">
                        <i class="fa fa-pencil mr-1"></i>Update your profile and resubmit
                    </a>
                </div>
            </div>
        @elseif ($brand->status === 'pending')
            <div class="alert alert-warning d-flex align-items-start" role="alert">
                <i class="fa fa-clock-o fa-lg mr-3 mt-1"></i>
                <div>
                    <strong>Your brand profile is under review.</strong>
                    Our team will approve it shortly. You will be notified once it goes live.
                </div>
            </div>
        @elseif ($brand->status === 'approved')
            <div class="alert alert-success d-flex align-items-start" role="alert">
                <i class="fa fa-check-circle fa-lg mr-3 mt-1"></i>
                <div>
                    <strong>Your brand is live!</strong>
                    Your profile is approved and visible to the public.
                </div>
            </div>
        @endif

        {{-- ===== STATS ROW ===== --}}
        <div class="row mb-4">

            {{-- Total Posts --}}
            <div class="col-sm-6 col-lg-4 mb-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body d-flex align-items-center">
                        <div class="rounded-circle d-flex align-items-center justify-content-center mr-3"
                             style="width:52px;height:52px;background:rgba(253,126,20,0.12);flex-shrink:0;">
                            <i class="fa fa-file-text-o fa-lg" style="color:#fd7e14;"></i>
                        </div>
                        <div>
                            <div class="text-muted" style="font-size:0.75rem;text-transform:uppercase;letter-spacing:0.8px;font-weight:600;">Total Posts</div>
                            <div class="font-weight-bold" style="font-size:1.75rem;color:#1a1a2e;line-height:1.2;">{{ $postCount }}</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Published Posts --}}
            <div class="col-sm-6 col-lg-4 mb-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body d-flex align-items-center">
                        <div class="rounded-circle d-flex align-items-center justify-content-center mr-3"
                             style="width:52px;height:52px;background:rgba(40,167,69,0.12);flex-shrink:0;">
                            <i class="fa fa-check-square-o fa-lg" style="color:#28a745;"></i>
                        </div>
                        <div>
                            <div class="text-muted" style="font-size:0.75rem;text-transform:uppercase;letter-spacing:0.8px;font-weight:600;">Published</div>
                            <div class="font-weight-bold" style="font-size:1.75rem;color:#1a1a2e;line-height:1.2;">{{ $publishedCount }}</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Brand Status --}}
            <div class="col-sm-6 col-lg-4 mb-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body d-flex align-items-center">
                        <div class="rounded-circle d-flex align-items-center justify-content-center mr-3"
                             style="width:52px;height:52px;
                                @if($brand->status === 'approved') background:rgba(40,167,69,0.12);
                                @elseif($brand->status === 'rejected') background:rgba(220,53,69,0.12);
                                @else background:rgba(255,193,7,0.15); @endif
                                flex-shrink:0;">
                            @if($brand->status === 'approved')
                                <i class="fa fa-check-circle fa-lg" style="color:#28a745;"></i>
                            @elseif($brand->status === 'rejected')
                                <i class="fa fa-times-circle fa-lg" style="color:#dc3545;"></i>
                            @else
                                <i class="fa fa-hourglass-half fa-lg" style="color:#856404;"></i>
                            @endif
                        </div>
                        <div>
                            <div class="text-muted" style="font-size:0.75rem;text-transform:uppercase;letter-spacing:0.8px;font-weight:600;">Brand Status</div>
                            <div class="mt-1">
                                @if($brand->status === 'approved')
                                    <span class="badge badge-success px-2 py-1" style="font-size:0.85rem;">Approved</span>
                                @elseif($brand->status === 'rejected')
                                    <span class="badge badge-danger px-2 py-1" style="font-size:0.85rem;">Rejected</span>
                                @else
                                    <span class="badge badge-warning px-2 py-1" style="font-size:0.85rem;">Pending Review</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- ===== RECENT POSTS + QUICK ACTIONS ===== --}}
        <div class="row">

            {{-- Recent Posts Table --}}
            <div class="col-lg-8 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white d-flex align-items-center justify-content-between py-3">
                        <h6 class="mb-0 font-weight-700" style="font-weight:700;">Recent Posts</h6>
                        <a href="{{ route('brand-owner.posts.index') }}" class="btn btn-sm btn-outline-secondary">
                            View All
                        </a>
                    </div>
                    <div class="card-body p-0">
                        @if ($recentPosts->isEmpty())
                            <div class="text-center text-muted py-5">
                                <i class="fa fa-file-text-o fa-2x mb-2 d-block"></i>
                                No posts yet. Create your first post!
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Title</th>
                                            <th>Status</th>
                                            <th>Created</th>
                                            <th class="text-right">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($recentPosts as $post)
                                            <tr>
                                                <td class="align-middle">
                                                    <span class="font-weight-500">{{ Str::limit($post->title, 45) }}</span>
                                                </td>
                                                <td class="align-middle">
                                                    @if ($post->status === 'published')
                                                        <span class="badge badge-success">Published</span>
                                                    @elseif ($post->status === 'archived')
                                                        <span class="badge badge-warning">Archived</span>
                                                    @else
                                                        <span class="badge badge-secondary">Draft</span>
                                                    @endif
                                                </td>
                                                <td class="align-middle text-muted" style="font-size:0.8rem; white-space:nowrap;">
                                                    {{ $post->created_at->format('d M Y') }}
                                                </td>
                                                <td class="align-middle text-right">
                                                    <a href="{{ route('brand-owner.posts.edit', $post) }}"
                                                       class="btn btn-sm btn-outline-primary mr-1">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                    <form method="POST"
                                                          action="{{ route('brand-owner.posts.destroy', $post) }}"
                                                          class="d-inline"
                                                          onsubmit="return confirm('Are you sure you want to delete this post? This action cannot be undone.')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Quick Actions --}}
            <div class="col-lg-4 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h6 class="mb-0" style="font-weight:700;">Quick Actions</h6>
                    </div>
                    <div class="card-body d-flex flex-column" style="gap:0.75rem;">

                        {{-- Create New Post: disabled unless approved --}}
                        @if ($brand->status === 'approved')
                            <a href="{{ route('brand-owner.posts.create') }}" class="btn btn-primary btn-block">
                                <i class="fa fa-plus-circle mr-2"></i>Create New Post
                            </a>
                        @else
                            <button type="button" class="btn btn-primary btn-block" disabled
                                    title="Your brand must be approved before you can publish posts.">
                                <i class="fa fa-plus-circle mr-2"></i>Create New Post
                            </button>
                            <small class="text-muted text-center">
                                <i class="fa fa-lock mr-1"></i>
                                Available once your brand is approved.
                            </small>
                        @endif

                        <a href="{{ route('brand-owner.brand.edit', $brand) }}" class="btn btn-outline-secondary btn-block">
                            <i class="fa fa-pencil-square-o mr-2"></i>Edit Brand Profile
                        </a>

                        <a href="{{ route('brand-owner.posts.index') }}" class="btn btn-outline-secondary btn-block">
                            <i class="fa fa-list mr-2"></i>Manage All Posts
                        </a>

                    </div>
                </div>
            </div>

        </div>

    @endif

@endsection
