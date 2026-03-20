@extends('layouts.admin')

@section('title', 'Manage Users')
@section('page-title', 'Manage Users')

@section('content')

<div class="admin-page-header">
    <h1>Users</h1>
    <p>View and manage all registered platform users.</p>
</div>

{{-- ===================== FILTER FORM ===================== --}}
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body py-3">
        <form method="GET" action="{{ route('admin.users.index') }}" class="form-inline flex-wrap" style="gap:0.5rem;">
            <div class="input-group mr-2 mb-2 mb-md-0" style="max-width:320px;">
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

            <select name="role" class="form-control mr-2 mb-2 mb-md-0" style="width:auto;">
                <option value="">All Roles</option>
                <option value="admin"       {{ request('role') === 'admin'       ? 'selected' : '' }}>Admin</option>
                <option value="brand_owner" {{ request('role') === 'brand_owner' ? 'selected' : '' }}>Brand Owner</option>
                <option value="user"        {{ request('role') === 'user'        ? 'selected' : '' }}>User</option>
            </select>

            <button type="submit" class="btn btn-primary mr-2 mb-2 mb-md-0">
                <i class="fa fa-filter mr-1"></i>Filter
            </button>
            @if(request()->hasAny(['search','role']))
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary mb-2 mb-md-0">
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
            Registered Users
            <span class="badge badge-secondary ml-2" style="font-size:0.75rem;">
                {{ $users->total() }}
            </span>
        </h6>
    </div>

    <div class="table-responsive">
        <table class="table table-hover mb-0" style="font-size:0.855rem;">
            <thead class="thead-light">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th class="text-center">Role</th>
                    <th>Brand</th>
                    <th>Joined</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle mr-2 d-flex align-items-center justify-content-center"
                                     style="width:34px;height:34px;
                                            background:linear-gradient(135deg,#fd7e14,#e65c00);
                                            color:#fff;font-weight:700;font-size:0.8rem;flex-shrink:0;">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <span style="font-weight:500;color:#0f172a;">{{ $user->name }}</span>
                            </div>
                        </td>
                        <td class="text-muted">{{ $user->email }}</td>
                        <td class="text-center">
                            @if($user->role === 'admin')
                                <span class="badge badge-danger px-2 py-1">Admin</span>
                            @elseif($user->role === 'brand_owner')
                                <span class="badge badge-primary px-2 py-1">Brand Owner</span>
                            @else
                                <span class="badge badge-secondary px-2 py-1">User</span>
                            @endif
                        </td>
                        <td>
                            @if($user->brand)
                                <a href="{{ route('admin.brands.show', $user->brand) }}"
                                   class="text-decoration-none" style="color:#0f172a;font-weight:500;">
                                    {{ $user->brand->name }}
                                </a>
                            @else
                                <span class="text-muted">No brand</span>
                            @endif
                        </td>
                        <td class="text-muted">{{ $user->created_at->format('d M Y') }}</td>
                        <td class="text-center" style="white-space:nowrap;">
                            {{-- Role Change --}}
                            <form action="{{ route('admin.users.update-role', $user) }}"
                                  method="POST" class="d-inline-flex align-items-center mr-1">
                                @csrf
                                @method('PATCH')
                                <select name="role"
                                        class="form-control form-control-sm mr-1"
                                        style="width:auto;font-size:0.78rem;"
                                        onchange="this.form.submit()">
                                    <option value="user"        {{ $user->role === 'user'        ? 'selected' : '' }}>User</option>
                                    <option value="brand_owner" {{ $user->role === 'brand_owner' ? 'selected' : '' }}>Brand Owner</option>
                                    <option value="admin"       {{ $user->role === 'admin'       ? 'selected' : '' }}>Admin</option>
                                </select>
                            </form>

                            {{-- Delete --}}
                            @if(auth()->id() !== $user->id)
                                <form action="{{ route('admin.users.destroy', $user) }}"
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn btn-sm btn-outline-danger"
                                            title="Delete User"
                                            onclick="return confirm('Permanently delete {{ addslashes($user->name) }}? This cannot be undone.')">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            @else
                                <button class="btn btn-sm btn-outline-secondary" disabled title="Cannot delete yourself">
                                    <i class="fa fa-trash"></i>
                                </button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-5">
                            <i class="fa fa-users fa-2x mb-2 d-block"></i>
                            No users found matching your criteria.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($users->hasPages())
        <div class="card-footer bg-white border-top py-3">
            {{ $users->appends(request()->query())->links() }}
        </div>
    @endif
</div>

@endsection
