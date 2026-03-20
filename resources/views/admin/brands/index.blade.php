@extends('layouts.admin')

@section('title', 'Manage Brands')
@section('page-title', 'Manage Brands')

@section('content')

<div class="admin-page-header d-flex align-items-center justify-content-between flex-wrap">
    <div>
        <h1>Brands</h1>
        <p>Review, approve, reject and feature brand listings.</p>
    </div>
</div>

{{-- ===================== FILTER FORM ===================== --}}
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body py-3">
        <form method="GET" action="{{ route('admin.brands.index') }}" class="form-inline flex-wrap" style="gap:0.5rem;">
            <div class="input-group mr-2 mb-2 mb-md-0" style="max-width:320px;">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-white border-right-0">
                        <i class="fa fa-search text-muted" style="font-size:0.85rem;"></i>
                    </span>
                </div>
                <input type="text"
                       name="search"
                       class="form-control border-left-0"
                       placeholder="Search brand name or owner..."
                       value="{{ request('search') }}">
            </div>

            <select name="status" class="form-control mr-2 mb-2 mb-md-0" style="width:auto;">
                <option value="">All Statuses</option>
                <option value="pending"  {{ request('status') === 'pending'  ? 'selected' : '' }}>Pending</option>
                <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Approved</option>
                <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
            </select>

            <button type="submit" class="btn btn-primary mr-2 mb-2 mb-md-0">
                <i class="fa fa-filter mr-1"></i>Filter
            </button>
            @if(request()->hasAny(['search','status']))
                <a href="{{ route('admin.brands.index') }}" class="btn btn-outline-secondary mb-2 mb-md-0">
                    <i class="fa fa-times mr-1"></i>Clear
                </a>
            @endif
        </form>
    </div>
</div>

{{-- ===================== TABLE ===================== --}}
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white border-bottom py-3 d-flex align-items-center justify-content-between">
        <h6 class="mb-0" style="font-weight:700;color:#0f172a;">
            Brand Listings
            <span class="badge badge-secondary ml-2" style="font-size:0.75rem;">
                {{ $brands->total() }}
            </span>
        </h6>
    </div>

    <div class="table-responsive">
        <table class="table table-hover mb-0" style="font-size:0.855rem;">
            <thead class="thead-light">
                <tr>
                    <th>Brand Name</th>
                    <th>Owner</th>
                    <th>Category</th>
                    <th class="text-center">Status</th>
                    <th>Created</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($brands as $brand)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                @if($brand->logo)
                                    <img src="{{ asset('storage/' . $brand->logo) }}"
                                         alt="{{ $brand->name }}"
                                         class="rounded mr-2"
                                         style="width:36px;height:36px;object-fit:cover;">
                                @else
                                    <div class="rounded mr-2 d-flex align-items-center justify-content-center"
                                         style="width:36px;height:36px;background:#e2e8f0;flex-shrink:0;">
                                        <i class="fa fa-building text-muted" style="font-size:0.85rem;"></i>
                                    </div>
                                @endif
                                <div>
                                    <div style="font-weight:600;color:#0f172a;">{{ $brand->name }}</div>
                                    @if($brand->is_featured)
                                        <span class="badge badge-info" style="font-size:0.65rem;">
                                            <i class="fa fa-star mr-1"></i>Featured
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>
                            <div style="font-weight:500;">{{ $brand->user->name ?? '—' }}</div>
                            <div class="text-muted" style="font-size:0.78rem;">{{ $brand->user->email ?? '' }}</div>
                        </td>
                        <td>{{ $brand->category->name ?? '—' }}</td>
                        <td class="text-center">
                            @if($brand->status === 'approved')
                                <span class="badge badge-success px-2 py-1">Approved</span>
                            @elseif($brand->status === 'pending')
                                <span class="badge badge-warning px-2 py-1">Pending</span>
                            @elseif($brand->status === 'rejected')
                                <span class="badge badge-danger px-2 py-1">Rejected</span>
                            @else
                                <span class="badge badge-secondary px-2 py-1">{{ ucfirst($brand->status) }}</span>
                            @endif
                        </td>
                        <td class="text-muted">{{ $brand->created_at->format('d M Y') }}</td>
                        <td class="text-center" style="white-space:nowrap;">
                            {{-- View --}}
                            <a href="{{ route('admin.brands.show', $brand) }}"
                               class="btn btn-sm btn-outline-primary mr-1"
                               title="View">
                                <i class="fa fa-eye"></i>
                            </a>

                            {{-- Approve --}}
                            @if($brand->status !== 'approved')
                                <form action="{{ route('admin.brands.approve', $brand) }}"
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                            class="btn btn-sm btn-success mr-1"
                                            title="Approve"
                                            onclick="return confirm('Approve \'{{ addslashes($brand->name) }}\'?')">
                                        <i class="fa fa-check"></i>
                                    </button>
                                </form>
                            @endif

                            {{-- Feature / Unfeature --}}
                            @if($brand->status === 'approved')
                                <form action="{{ route('admin.brands.feature', $brand) }}"
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                            class="btn btn-sm {{ $brand->is_featured ? 'btn-warning' : 'btn-outline-warning' }}"
                                            title="{{ $brand->is_featured ? 'Unfeature' : 'Feature' }}">
                                        <i class="fa fa-star"></i>
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-5">
                            <i class="fa fa-building fa-2x mb-2 d-block"></i>
                            No brands found matching your criteria.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($brands->hasPages())
        <div class="card-footer bg-white border-top py-3">
            {{ $brands->appends(request()->query())->links() }}
        </div>
    @endif
</div>

@endsection
