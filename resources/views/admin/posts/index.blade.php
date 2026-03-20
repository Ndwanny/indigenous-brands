@extends('layouts.admin')

@section('title', 'Manage Posts')
@section('page-title', 'Manage Posts')

@section('content')

<div class="admin-page-header">
    <h1>Posts</h1>
    <p>Manage all blog and brand posts across the platform.</p>
</div>

{{-- ===================== FILTER FORM ===================== --}}
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body py-3">
        <form method="GET" action="{{ route('admin.posts.index') }}" class="form-inline flex-wrap" style="gap:0.5rem;">
            <div class="input-group mr-2 mb-2 mb-md-0" style="max-width:320px;">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-white border-right-0">
                        <i class="fa fa-search text-muted" style="font-size:0.85rem;"></i>
                    </span>
                </div>
                <input type="text"
                       name="search"
                       class="form-control border-left-0"
                       placeholder="Search title or author..."
                       value="{{ request('search') }}">
            </div>

            <select name="status" class="form-control mr-2 mb-2 mb-md-0" style="width:auto;">
                <option value="">All Statuses</option>
                <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Published</option>
                <option value="draft"     {{ request('status') === 'draft'     ? 'selected' : '' }}>Draft</option>
                <option value="pending"   {{ request('status') === 'pending'   ? 'selected' : '' }}>Pending</option>
                <option value="rejected"  {{ request('status') === 'rejected'  ? 'selected' : '' }}>Rejected</option>
            </select>

            <button type="submit" class="btn btn-primary mr-2 mb-2 mb-md-0">
                <i class="fa fa-filter mr-1"></i>Filter
            </button>
            @if(request()->hasAny(['search','status']))
                <a href="{{ route('admin.posts.index') }}" class="btn btn-outline-secondary mb-2 mb-md-0">
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
            All Posts
            <span class="badge badge-secondary ml-2" style="font-size:0.75rem;">
                {{ $posts->total() }}
            </span>
        </h6>
    </div>

    <div class="table-responsive">
        <table class="table table-hover mb-0" style="font-size:0.855rem;">
            <thead class="thead-light">
                <tr>
                    <th>Title</th>
                    <th>Author / Brand</th>
                    <th>Category</th>
                    <th class="text-center">Status</th>
                    <th>Published At</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($posts as $post)
                    <tr>
                        <td>
                            <div style="font-weight:600;color:#0f172a;max-width:260px;">
                                {{ Str::limit($post->title, 60) }}
                            </div>
                        </td>
                        <td>
                            <div style="font-weight:500;">{{ $post->user->name ?? '—' }}</div>
                            @if($post->brand)
                                <div class="text-muted" style="font-size:0.78rem;">
                                    <i class="fa fa-building mr-1"></i>{{ $post->brand->name }}
                                </div>
                            @endif
                        </td>
                        <td>{{ $post->category->name ?? '—' }}</td>
                        <td class="text-center">
                            @if($post->status === 'published')
                                <span class="badge badge-success px-2 py-1">Published</span>
                            @elseif($post->status === 'draft')
                                <span class="badge badge-secondary px-2 py-1">Draft</span>
                            @elseif($post->status === 'pending')
                                <span class="badge badge-warning px-2 py-1">Pending</span>
                            @elseif($post->status === 'rejected')
                                <span class="badge badge-danger px-2 py-1">Rejected</span>
                            @else
                                <span class="badge badge-light px-2 py-1">{{ ucfirst($post->status) }}</span>
                            @endif
                        </td>
                        <td class="text-muted">
                            {{ $post->published_at ? $post->published_at->format('d M Y') : '—' }}
                        </td>
                        <td class="text-center" style="white-space:nowrap;">
                            {{-- Status Change --}}
                            <form action="{{ route('admin.posts.status', $post) }}"
                                  method="POST" class="d-inline-flex align-items-center mr-1">
                                @csrf
                                @method('PATCH')
                                <select name="status"
                                        class="form-control form-control-sm mr-1"
                                        style="width:auto;font-size:0.78rem;"
                                        onchange="this.form.submit()">
                                    <option value="published" {{ $post->status === 'published' ? 'selected' : '' }}>Published</option>
                                    <option value="draft"     {{ $post->status === 'draft'     ? 'selected' : '' }}>Draft</option>
                                    <option value="pending"   {{ $post->status === 'pending'   ? 'selected' : '' }}>Pending</option>
                                    <option value="rejected"  {{ $post->status === 'rejected'  ? 'selected' : '' }}>Rejected</option>
                                </select>
                            </form>

                            {{-- Delete --}}
                            <form action="{{ route('admin.posts.destroy', $post) }}"
                                  method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="btn btn-sm btn-outline-danger"
                                        title="Delete Post"
                                        onclick="return confirm('Delete \'{{ addslashes(Str::limit($post->title, 40)) }}\'? This cannot be undone.')">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-5">
                            <i class="fa fa-file-text fa-2x mb-2 d-block"></i>
                            No posts found matching your criteria.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($posts->hasPages())
        <div class="card-footer bg-white border-top py-3">
            {{ $posts->appends(request()->query())->links() }}
        </div>
    @endif
</div>

@endsection
