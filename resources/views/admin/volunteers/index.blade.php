@extends('layouts.admin')

@section('title', 'Volunteer Applications')
@section('page-title', 'Volunteer Applications')

@section('content')

<div class="admin-page-header">
    <h1>Volunteer Applications</h1>
    <p>Review and manage volunteer and brand ambassador applications.</p>
</div>

{{-- ===================== FILTER FORM ===================== --}}
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body py-3">
        <form method="GET" action="{{ route('admin.volunteers.index') }}" class="form-inline flex-wrap" style="gap:0.5rem;">
            <div class="input-group mr-2 mb-2 mb-md-0" style="max-width:300px;">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-white border-right-0">
                        <i class="fa fa-search text-muted" style="font-size:0.85rem;"></i>
                    </span>
                </div>
                <input type="text"
                       name="search"
                       class="form-control border-left-0"
                       placeholder="Search name or email..."
                       value="{{ request('search') }}">
            </div>

            <select name="status" class="form-control mr-2 mb-2 mb-md-0" style="width:auto;">
                <option value="">All Statuses</option>
                <option value="pending"  {{ request('status') === 'pending'  ? 'selected' : '' }}>Pending</option>
                <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Approved</option>
                <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
            </select>

            <select name="role" class="form-control mr-2 mb-2 mb-md-0" style="width:auto;">
                <option value="">All Roles</option>
                <option value="volunteer"  {{ request('role') === 'volunteer'  ? 'selected' : '' }}>Volunteer</option>
                <option value="ambassador" {{ request('role') === 'ambassador' ? 'selected' : '' }}>Ambassador</option>
            </select>

            <button type="submit" class="btn btn-primary mr-2 mb-2 mb-md-0">
                <i class="fa fa-filter mr-1"></i>Filter
            </button>
            @if(request()->hasAny(['search','status','role']))
                <a href="{{ route('admin.volunteers.index') }}" class="btn btn-outline-secondary mb-2 mb-md-0">
                    <i class="fa fa-times mr-1"></i>Clear
                </a>
            @endif
        </form>
    </div>
</div>

{{-- ===================== TABLE ===================== --}}
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white border-bottom py-3">
        <h6 class="mb-0" style="font-weight:700;color:#0f172a;">
            Applications
            <span class="badge badge-secondary ml-2" style="font-size:0.75rem;">
                {{ $applications->total() }}
            </span>
        </h6>
    </div>

    <div class="table-responsive">
        <table class="table table-hover mb-0" style="font-size:0.855rem;">
            <thead class="thead-light">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th class="text-center">Role</th>
                    <th>Message</th>
                    <th class="text-center">Status</th>
                    <th>Date</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($applications as $application)
                    <tr>
                        <td style="font-weight:600;color:#0f172a;white-space:nowrap;">
                            {{ $application->name }}
                        </td>
                        <td>
                            <a href="mailto:{{ $application->email }}"
                               class="text-decoration-none text-muted">
                                {{ $application->email }}
                            </a>
                        </td>
                        <td class="text-muted">{{ $application->phone ?? '—' }}</td>
                        <td class="text-center">
                            @if($application->role === 'ambassador')
                                <span class="badge badge-primary px-2 py-1">Ambassador</span>
                            @else
                                <span class="badge badge-info px-2 py-1">Volunteer</span>
                            @endif
                        </td>
                        <td style="max-width:220px;" class="text-muted">
                            @if($application->message)
                                <span title="{{ $application->message }}">
                                    {{ Str::limit($application->message, 80) }}
                                </span>
                            @else
                                —
                            @endif
                        </td>
                        <td class="text-center">
                            @if($application->status === 'approved')
                                <span class="badge badge-success px-2 py-1">Approved</span>
                            @elseif($application->status === 'rejected')
                                <span class="badge badge-danger px-2 py-1">Rejected</span>
                            @else
                                <span class="badge badge-warning px-2 py-1">Pending</span>
                            @endif
                        </td>
                        <td class="text-muted" style="white-space:nowrap;">
                            {{ $application->created_at->format('d M Y') }}
                        </td>
                        <td class="text-center" style="white-space:nowrap;">
                            {{-- Status Update --}}
                            <form action="{{ route('admin.volunteers.status', $application) }}"
                                  method="POST"
                                  class="d-inline-flex align-items-center">
                                @csrf
                                @method('PATCH')
                                <select name="status"
                                        class="form-control form-control-sm mr-1"
                                        style="width:auto;font-size:0.78rem;"
                                        onchange="this.form.submit()">
                                    <option value="pending"  {{ $application->status === 'pending'  ? 'selected' : '' }}>Pending</option>
                                    <option value="approved" {{ $application->status === 'approved' ? 'selected' : '' }}>Approved</option>
                                    <option value="rejected" {{ $application->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                                </select>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-5">
                            <i class="fa fa-hand-paper-o fa-2x mb-2 d-block"></i>
                            No volunteer applications found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($applications->hasPages())
        <div class="card-footer bg-white border-top py-3">
            {{ $applications->appends(request()->query())->links() }}
        </div>
    @endif
</div>

@endsection
