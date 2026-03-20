@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('page-title', 'Admin Dashboard')

@section('content')

<div class="admin-page-header">
    <h1>Dashboard</h1>
    <p>Welcome back, {{ auth()->user()->name }}. Here's an overview of the platform.</p>
</div>

{{-- ===================== STAT CARDS ===================== --}}
<div class="row">

    {{-- Total Users --}}
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="stat-icon-wrap mr-3"
                     style="width:52px;height:52px;border-radius:12px;background:rgba(23,162,184,0.12);
                            display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <i class="fa fa-users" style="font-size:1.4rem;color:#17a2b8;"></i>
                </div>
                <div>
                    <div style="font-size:1.75rem;font-weight:700;color:#0f172a;line-height:1;">
                        {{ number_format($stats['total_users']) }}
                    </div>
                    <div class="text-muted" style="font-size:0.8rem;margin-top:2px;">Total Users</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Brand Owners --}}
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="stat-icon-wrap mr-3"
                     style="width:52px;height:52px;border-radius:12px;background:rgba(108,117,125,0.12);
                            display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <i class="fa fa-briefcase" style="font-size:1.4rem;color:#6c757d;"></i>
                </div>
                <div>
                    <div style="font-size:1.75rem;font-weight:700;color:#0f172a;line-height:1;">
                        {{ number_format($stats['brand_owners']) }}
                    </div>
                    <div class="text-muted" style="font-size:0.8rem;margin-top:2px;">Brand Owners</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Pending Brands --}}
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card border-0 shadow-sm h-100 {{ $stats['pending_brands'] > 0 ? 'border-left border-warning' : '' }}"
             style="{{ $stats['pending_brands'] > 0 ? 'border-left: 4px solid #fd7e14 !important;' : '' }}">
            <div class="card-body d-flex align-items-center">
                <div class="stat-icon-wrap mr-3"
                     style="width:52px;height:52px;border-radius:12px;
                            background:{{ $stats['pending_brands'] > 0 ? 'rgba(253,126,20,0.12)' : 'rgba(108,117,125,0.08)' }};
                            display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <i class="fa fa-clock-o"
                       style="font-size:1.4rem;color:{{ $stats['pending_brands'] > 0 ? '#fd7e14' : '#6c757d' }};"></i>
                </div>
                <div>
                    <div style="font-size:1.75rem;font-weight:700;
                                color:{{ $stats['pending_brands'] > 0 ? '#fd7e14' : '#0f172a' }};line-height:1;">
                        {{ number_format($stats['pending_brands']) }}
                    </div>
                    <div class="text-muted" style="font-size:0.8rem;margin-top:2px;">Pending Brands</div>
                </div>
                @if($stats['pending_brands'] > 0)
                    <a href="{{ route('admin.brands.index', ['status' => 'pending']) }}"
                       class="btn btn-sm btn-warning ml-auto" style="font-size:0.75rem;">Review</a>
                @endif
            </div>
        </div>
    </div>

    {{-- Approved Brands --}}
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="stat-icon-wrap mr-3"
                     style="width:52px;height:52px;border-radius:12px;background:rgba(40,167,69,0.12);
                            display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <i class="fa fa-check-circle" style="font-size:1.4rem;color:#28a745;"></i>
                </div>
                <div>
                    <div style="font-size:1.75rem;font-weight:700;color:#28a745;line-height:1;">
                        {{ number_format($stats['approved_brands']) }}
                    </div>
                    <div class="text-muted" style="font-size:0.8rem;margin-top:2px;">Approved Brands</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Total Posts --}}
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="stat-icon-wrap mr-3"
                     style="width:52px;height:52px;border-radius:12px;background:rgba(102,16,242,0.10);
                            display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <i class="fa fa-file-text" style="font-size:1.4rem;color:#6610f2;"></i>
                </div>
                <div>
                    <div style="font-size:1.75rem;font-weight:700;color:#0f172a;line-height:1;">
                        {{ number_format($stats['total_posts']) }}
                    </div>
                    <div class="text-muted" style="font-size:0.8rem;margin-top:2px;">Total Posts</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Published Posts --}}
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center">
                <div class="stat-icon-wrap mr-3"
                     style="width:52px;height:52px;border-radius:12px;background:rgba(0,123,255,0.10);
                            display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <i class="fa fa-globe" style="font-size:1.4rem;color:#007bff;"></i>
                </div>
                <div>
                    <div style="font-size:1.75rem;font-weight:700;color:#0f172a;line-height:1;">
                        {{ number_format($stats['published_posts']) }}
                    </div>
                    <div class="text-muted" style="font-size:0.8rem;margin-top:2px;">Published Posts</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Pending Comments --}}
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card border-0 shadow-sm h-100"
             style="{{ $stats['pending_comments'] > 0 ? 'border-left: 4px solid #fd7e14 !important;' : '' }}">
            <div class="card-body d-flex align-items-center">
                <div class="stat-icon-wrap mr-3"
                     style="width:52px;height:52px;border-radius:12px;
                            background:{{ $stats['pending_comments'] > 0 ? 'rgba(253,126,20,0.12)' : 'rgba(108,117,125,0.08)' }};
                            display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <i class="fa fa-comments"
                       style="font-size:1.4rem;color:{{ $stats['pending_comments'] > 0 ? '#fd7e14' : '#6c757d' }};"></i>
                </div>
                <div>
                    <div style="font-size:1.75rem;font-weight:700;
                                color:{{ $stats['pending_comments'] > 0 ? '#fd7e14' : '#0f172a' }};line-height:1;">
                        {{ number_format($stats['pending_comments']) }}
                    </div>
                    <div class="text-muted" style="font-size:0.8rem;margin-top:2px;">Pending Comments</div>
                </div>
                @if($stats['pending_comments'] > 0)
                    <a href="{{ route('admin.comments.index', ['status' => 'pending']) }}"
                       class="btn btn-sm btn-warning ml-auto" style="font-size:0.75rem;">Review</a>
                @endif
            </div>
        </div>
    </div>

    {{-- Unread Messages --}}
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card border-0 shadow-sm h-100"
             style="{{ $stats['unread_messages'] > 0 ? 'border-left: 4px solid #fd7e14 !important;' : '' }}">
            <div class="card-body d-flex align-items-center">
                <div class="stat-icon-wrap mr-3"
                     style="width:52px;height:52px;border-radius:12px;
                            background:{{ $stats['unread_messages'] > 0 ? 'rgba(253,126,20,0.12)' : 'rgba(108,117,125,0.08)' }};
                            display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <i class="fa fa-envelope"
                       style="font-size:1.4rem;color:{{ $stats['unread_messages'] > 0 ? '#fd7e14' : '#6c757d' }};"></i>
                </div>
                <div>
                    <div style="font-size:1.75rem;font-weight:700;
                                color:{{ $stats['unread_messages'] > 0 ? '#fd7e14' : '#0f172a' }};line-height:1;">
                        {{ number_format($stats['unread_messages']) }}
                    </div>
                    <div class="text-muted" style="font-size:0.8rem;margin-top:2px;">Unread Messages</div>
                </div>
                @if($stats['unread_messages'] > 0)
                    <a href="{{ route('admin.messages.index') }}"
                       class="btn btn-sm btn-warning ml-auto" style="font-size:0.75rem;">View</a>
                @endif
            </div>
        </div>
    </div>

    {{-- Pending Volunteers --}}
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card border-0 shadow-sm h-100"
             style="{{ $stats['pending_volunteers'] > 0 ? 'border-left: 4px solid #fd7e14 !important;' : '' }}">
            <div class="card-body d-flex align-items-center">
                <div class="stat-icon-wrap mr-3"
                     style="width:52px;height:52px;border-radius:12px;
                            background:{{ $stats['pending_volunteers'] > 0 ? 'rgba(253,126,20,0.12)' : 'rgba(108,117,125,0.08)' }};
                            display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <i class="fa fa-hand-paper-o"
                       style="font-size:1.4rem;color:{{ $stats['pending_volunteers'] > 0 ? '#fd7e14' : '#6c757d' }};"></i>
                </div>
                <div>
                    <div style="font-size:1.75rem;font-weight:700;
                                color:{{ $stats['pending_volunteers'] > 0 ? '#fd7e14' : '#0f172a' }};line-height:1;">
                        {{ number_format($stats['pending_volunteers']) }}
                    </div>
                    <div class="text-muted" style="font-size:0.8rem;margin-top:2px;">Pending Volunteers</div>
                </div>
                @if($stats['pending_volunteers'] > 0)
                    <a href="{{ route('admin.volunteers.index', ['status' => 'pending']) }}"
                       class="btn btn-sm btn-warning ml-auto" style="font-size:0.75rem;">Review</a>
                @endif
            </div>
        </div>
    </div>

</div>{{-- /row --}}

{{-- ===================== BOTTOM TWO COLUMNS ===================== --}}
<div class="row mt-2">

    {{-- Recent Pending Brands --}}
    <div class="col-lg-7 mb-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom d-flex align-items-center justify-content-between py-3">
                <h6 class="mb-0 font-weight-700" style="font-weight:700;color:#0f172a;">
                    <i class="fa fa-clock-o text-warning mr-2"></i>Recent Pending Brands
                </h6>
                <a href="{{ route('admin.brands.index', ['status' => 'pending']) }}"
                   class="btn btn-sm btn-outline-secondary" style="font-size:0.75rem;">View All</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0" style="font-size:0.855rem;">
                    <thead class="thead-light">
                        <tr>
                            <th>Brand Name</th>
                            <th>Owner Email</th>
                            <th>Submitted</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentBrands as $brand)
                            <tr>
                                <td>
                                    <a href="{{ route('admin.brands.show', $brand) }}"
                                       class="font-weight-600 text-dark" style="font-weight:600;">
                                        {{ $brand->name }}
                                    </a>
                                </td>
                                <td class="text-muted">{{ $brand->user->email ?? '—' }}</td>
                                <td class="text-muted">{{ $brand->created_at->format('d M Y') }}</td>
                                <td class="text-center" style="white-space:nowrap;">
                                    <a href="{{ route('admin.brands.show', $brand) }}"
                                       class="btn btn-sm btn-outline-primary mr-1" style="font-size:0.75rem;">
                                        <i class="fa fa-eye"></i> View
                                    </a>
                                    <form action="{{ route('admin.brands.approve', $brand) }}"
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-success"
                                                style="font-size:0.75rem;"
                                                onclick="return confirm('Approve this brand?')">
                                            <i class="fa fa-check"></i> Approve
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">
                                    <i class="fa fa-check-circle text-success mr-1"></i>
                                    No pending brands — all caught up!
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Recent Unread Messages --}}
    <div class="col-lg-5 mb-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom d-flex align-items-center justify-content-between py-3">
                <h6 class="mb-0" style="font-weight:700;color:#0f172a;">
                    <i class="fa fa-envelope text-info mr-2"></i>Recent Unread Messages
                </h6>
                <a href="{{ route('admin.messages.index') }}"
                   class="btn btn-sm btn-outline-secondary" style="font-size:0.75rem;">View All</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0" style="font-size:0.855rem;">
                    <thead class="thead-light">
                        <tr>
                            <th>Name / Subject</th>
                            <th>Date</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentMessages as $message)
                            <tr>
                                <td>
                                    <div class="font-weight-600" style="font-weight:600;">
                                        {{ $message->name }}
                                    </div>
                                    <div class="text-muted" style="font-size:0.78rem;">
                                        {{ Str::limit($message->subject, 35) }}
                                    </div>
                                    <div class="text-muted" style="font-size:0.75rem;">
                                        {{ $message->email }}
                                    </div>
                                </td>
                                <td class="text-muted" style="white-space:nowrap;">
                                    {{ $message->created_at->format('d M') }}
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('admin.messages.read', $message) }}"
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-outline-info"
                                                style="font-size:0.72rem;">
                                            <i class="fa fa-check"></i> Mark Read
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted py-4">
                                    <i class="fa fa-inbox mr-1"></i>No unread messages.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>{{-- /row --}}

@endsection
