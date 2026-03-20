@extends('layouts.admin')

@section('title', $brand->name . ' — Brand Detail')
@section('page-title', 'Brand Detail')

@section('content')

<div class="admin-page-header d-flex align-items-center justify-content-between flex-wrap">
    <div>
        <h1>{{ $brand->name }}</h1>
        <p>
            <a href="{{ route('admin.brands.index') }}" class="text-muted">
                <i class="fa fa-arrow-left mr-1"></i>Back to Brands
            </a>
        </p>
    </div>
    <div class="d-flex flex-wrap" style="gap:0.5rem;">
        {{-- Feature / Unfeature --}}
        <form action="{{ route('admin.brands.feature', $brand) }}" method="POST" class="d-inline">
            @csrf
            @method('PATCH')
            <button type="submit"
                    class="btn {{ $brand->is_featured ? 'btn-warning' : 'btn-outline-warning' }}">
                <i class="fa fa-star mr-1"></i>
                {{ $brand->is_featured ? 'Unfeature Brand' : 'Feature Brand' }}
            </button>
        </form>
    </div>
</div>

<div class="row">

    {{-- ============ LEFT COLUMN ============ --}}
    <div class="col-lg-8">

        {{-- Brand Details Card --}}
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white border-bottom py-3">
                <h6 class="mb-0" style="font-weight:700;color:#0f172a;">
                    <i class="fa fa-building mr-2 text-primary"></i>Brand Details
                </h6>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-start mb-4">
                    @if($brand->logo)
                        <img src="{{ asset('storage/' . $brand->logo) }}"
                             alt="{{ $brand->name }}"
                             class="rounded mr-4"
                             style="width:90px;height:90px;object-fit:cover;border:1px solid #e2e8f0;">
                    @else
                        <div class="rounded mr-4 d-flex align-items-center justify-content-center"
                             style="width:90px;height:90px;background:#e2e8f0;flex-shrink:0;">
                            <i class="fa fa-building text-muted fa-2x"></i>
                        </div>
                    @endif
                    <div>
                        <h4 class="mb-1" style="font-weight:700;color:#0f172a;">{{ $brand->name }}</h4>
                        @if($brand->tagline)
                            <p class="text-muted mb-2" style="font-style:italic;">{{ $brand->tagline }}</p>
                        @endif
                        <div class="d-flex flex-wrap" style="gap:0.5rem;">
                            {{-- Status Badge --}}
                            @if($brand->status === 'approved')
                                <span class="badge badge-success px-2 py-1">
                                    <i class="fa fa-check mr-1"></i>Approved
                                </span>
                            @elseif($brand->status === 'pending')
                                <span class="badge badge-warning px-2 py-1">
                                    <i class="fa fa-clock-o mr-1"></i>Pending Review
                                </span>
                            @elseif($brand->status === 'rejected')
                                <span class="badge badge-danger px-2 py-1">
                                    <i class="fa fa-times mr-1"></i>Rejected
                                </span>
                            @endif
                            @if($brand->is_featured)
                                <span class="badge badge-info px-2 py-1">
                                    <i class="fa fa-star mr-1"></i>Featured
                                </span>
                            @endif
                            @if($brand->category)
                                <span class="badge badge-secondary px-2 py-1">
                                    <i class="fa fa-tag mr-1"></i>{{ $brand->category->name }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                @if($brand->status === 'rejected' && $brand->rejection_reason)
                    <div class="alert alert-danger" role="alert">
                        <strong><i class="fa fa-exclamation-circle mr-1"></i>Rejection Reason:</strong>
                        {{ $brand->rejection_reason }}
                    </div>
                @endif

                <div class="row">
                    <div class="col-md-6">
                        <dl class="row mb-0">
                            <dt class="col-sm-4 text-muted" style="font-size:0.8rem;">Location</dt>
                            <dd class="col-sm-8" style="font-size:0.855rem;">{{ $brand->location ?? '—' }}</dd>

                            <dt class="col-sm-4 text-muted" style="font-size:0.8rem;">Phone</dt>
                            <dd class="col-sm-8" style="font-size:0.855rem;">{{ $brand->phone ?? '—' }}</dd>

                            <dt class="col-sm-4 text-muted" style="font-size:0.8rem;">Email</dt>
                            <dd class="col-sm-8" style="font-size:0.855rem;">{{ $brand->contact_email ?? '—' }}</dd>

                            <dt class="col-sm-4 text-muted" style="font-size:0.8rem;">Website</dt>
                            <dd class="col-sm-8" style="font-size:0.855rem;">
                                @if($brand->website)
                                    <a href="{{ $brand->website }}" target="_blank" rel="noopener">
                                        {{ $brand->website }}
                                    </a>
                                @else
                                    —
                                @endif
                            </dd>
                        </dl>
                    </div>
                    <div class="col-md-6">
                        <dl class="row mb-0">
                            <dt class="col-sm-5 text-muted" style="font-size:0.8rem;">Instagram</dt>
                            <dd class="col-sm-7" style="font-size:0.855rem;">
                                {{ $brand->instagram ? '@' . ltrim($brand->instagram, '@') : '—' }}
                            </dd>

                            <dt class="col-sm-5 text-muted" style="font-size:0.8rem;">Facebook</dt>
                            <dd class="col-sm-7" style="font-size:0.855rem;">{{ $brand->facebook ?? '—' }}</dd>

                            <dt class="col-sm-5 text-muted" style="font-size:0.8rem;">Twitter / X</dt>
                            <dd class="col-sm-7" style="font-size:0.855rem;">{{ $brand->twitter ?? '—' }}</dd>

                            <dt class="col-sm-5 text-muted" style="font-size:0.8rem;">Submitted</dt>
                            <dd class="col-sm-7" style="font-size:0.855rem;">
                                {{ $brand->created_at->format('d M Y, H:i') }}
                            </dd>
                        </dl>
                    </div>
                </div>

                @if($brand->description)
                    <hr>
                    <h6 class="mb-2" style="font-weight:600;">Description</h6>
                    <p class="text-muted mb-0" style="font-size:0.9rem;line-height:1.7;">
                        {{ $brand->description }}
                    </p>
                @endif
            </div>
        </div>

        {{-- Brand Posts --}}
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white border-bottom py-3">
                <h6 class="mb-0" style="font-weight:700;color:#0f172a;">
                    <i class="fa fa-file-text mr-2 text-primary"></i>Brand Posts
                    <span class="badge badge-secondary ml-1">{{ $brand->posts->count() }}</span>
                </h6>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0" style="font-size:0.855rem;">
                    <thead class="thead-light">
                        <tr>
                            <th>Title</th>
                            <th class="text-center">Status</th>
                            <th>Published At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($brand->posts as $post)
                            <tr>
                                <td style="font-weight:500;">{{ $post->title }}</td>
                                <td class="text-center">
                                    @if($post->status === 'published')
                                        <span class="badge badge-success">Published</span>
                                    @elseif($post->status === 'draft')
                                        <span class="badge badge-secondary">Draft</span>
                                    @else
                                        <span class="badge badge-warning">{{ ucfirst($post->status) }}</span>
                                    @endif
                                </td>
                                <td class="text-muted">
                                    {{ $post->published_at ? $post->published_at->format('d M Y') : '—' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted py-4">
                                    No posts for this brand yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    {{-- ============ RIGHT COLUMN ============ --}}
    <div class="col-lg-4">

        {{-- Brand Owner --}}
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white border-bottom py-3">
                <h6 class="mb-0" style="font-weight:700;color:#0f172a;">
                    <i class="fa fa-user mr-2 text-primary"></i>Brand Owner
                </h6>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <div class="rounded-circle mr-3 d-flex align-items-center justify-content-center"
                         style="width:46px;height:46px;background:linear-gradient(135deg,#fd7e14,#e65c00);
                                flex-shrink:0;color:#fff;font-weight:700;font-size:1.1rem;">
                        {{ strtoupper(substr($brand->user->name ?? 'U', 0, 1)) }}
                    </div>
                    <div>
                        <div style="font-weight:600;color:#0f172a;">{{ $brand->user->name ?? '—' }}</div>
                        <div class="text-muted" style="font-size:0.8rem;">{{ $brand->user->email ?? '' }}</div>
                    </div>
                </div>
                <a href="{{ route('admin.users.index', ['search' => $brand->user->email ?? '']) }}"
                   class="btn btn-sm btn-outline-secondary btn-block">
                    <i class="fa fa-external-link mr-1"></i>View User Profile
                </a>
            </div>
        </div>

        {{-- Approve Action --}}
        @if($brand->status !== 'approved')
            <div class="card border-0 shadow-sm mb-4 border-success" style="border-left:4px solid #28a745 !important;">
                <div class="card-body">
                    <h6 class="mb-3 text-success" style="font-weight:700;">
                        <i class="fa fa-check-circle mr-1"></i>Approve Brand
                    </h6>
                    <p class="text-muted mb-3" style="font-size:0.85rem;">
                        Approving this brand will make it visible on the public directory.
                    </p>
                    <form action="{{ route('admin.brands.approve', $brand) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit"
                                class="btn btn-success btn-block"
                                onclick="return confirm('Approve this brand and publish it to the directory?')">
                            <i class="fa fa-check mr-1"></i>Approve Brand
                        </button>
                    </form>
                </div>
            </div>
        @endif

        {{-- Reject Action --}}
        @if($brand->status !== 'rejected')
            <div class="card border-0 shadow-sm mb-4" style="border-left:4px solid #dc3545 !important;">
                <div class="card-body">
                    <h6 class="mb-3 text-danger" style="font-weight:700;">
                        <i class="fa fa-times-circle mr-1"></i>Reject Brand
                    </h6>
                    <form action="{{ route('admin.brands.reject', $brand) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-group mb-3">
                            <label for="rejection_reason" class="text-muted" style="font-size:0.8rem;">
                                Reason for rejection <span class="text-danger">*</span>
                            </label>
                            <textarea name="rejection_reason"
                                      id="rejection_reason"
                                      class="form-control @error('rejection_reason') is-invalid @enderror"
                                      rows="3"
                                      placeholder="Explain why this brand is being rejected..."
                                      style="font-size:0.855rem;">{{ old('rejection_reason', $brand->rejection_reason) }}</textarea>
                            @error('rejection_reason')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit"
                                class="btn btn-danger btn-block"
                                onclick="return confirm('Reject this brand? The owner will be notified.')">
                            <i class="fa fa-times mr-1"></i>Reject Brand
                        </button>
                    </form>
                </div>
            </div>
        @endif

    </div>

</div>

@endsection
