@extends('layouts.admin')

@section('title', 'Manage Comments')
@section('page-title', 'Manage Comments')

@section('content')

<div class="admin-page-header">
    <h1>Comments</h1>
    <p>Review, approve and moderate user comments across all posts.</p>
</div>

{{-- ===================== FILTER FORM ===================== --}}
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body py-3">
        <form method="GET" action="{{ route('admin.comments.index') }}" class="form-inline flex-wrap" style="gap:0.5rem;">
            <div class="input-group mr-2 mb-2 mb-md-0" style="max-width:300px;">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-white border-right-0">
                        <i class="fa fa-search text-muted" style="font-size:0.85rem;"></i>
                    </span>
                </div>
                <input type="text"
                       name="search"
                       class="form-control border-left-0"
                       placeholder="Search comment or author..."
                       value="{{ request('search') }}">
            </div>

            <select name="status" class="form-control mr-2 mb-2 mb-md-0" style="width:auto;">
                <option value="">All Comments</option>
                <option value="pending"  {{ request('status') === 'pending'  ? 'selected' : '' }}>Pending</option>
                <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Approved</option>
            </select>

            <button type="submit" class="btn btn-primary mr-2 mb-2 mb-md-0">
                <i class="fa fa-filter mr-1"></i>Filter
            </button>
            @if(request()->hasAny(['search','status']))
                <a href="{{ route('admin.comments.index') }}" class="btn btn-outline-secondary mb-2 mb-md-0">
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
            All Comments
            <span class="badge badge-secondary ml-2" style="font-size:0.75rem;">
                {{ $comments->total() }}
            </span>
        </h6>
    </div>

    <div class="table-responsive">
        <table class="table table-hover mb-0" style="font-size:0.855rem;">
            <thead class="thead-light">
                <tr>
                    <th>Post</th>
                    <th>Author</th>
                    <th>Comment</th>
                    <th class="text-center">Status</th>
                    <th>Date</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($comments as $comment)
                    <tr class="{{ !$comment->approved ? 'table-warning' : '' }}">
                        <td style="max-width:180px;">
                            @if($comment->post)
                                <a href="{{ route('blog.show', $comment->post->slug ?? $comment->post->id) }}"
                                   target="_blank"
                                   class="text-decoration-none"
                                   style="font-weight:600;color:#0f172a;">
                                    {{ Str::limit($comment->post->title, 45) }}
                                    <i class="fa fa-external-link ml-1" style="font-size:0.7rem;color:#94a3b8;"></i>
                                </a>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                        <td>
                            <div style="font-weight:500;">{{ $comment->user->name ?? 'Guest' }}</div>
                            <div class="text-muted" style="font-size:0.78rem;">{{ $comment->user->email ?? '' }}</div>
                        </td>
                        <td style="max-width:260px;">
                            <span title="{{ $comment->body }}">
                                {{ Str::limit($comment->body, 100) }}
                            </span>
                        </td>
                        <td class="text-center">
                            @if($comment->approved)
                                <span class="badge badge-success px-2 py-1">Approved</span>
                            @else
                                <span class="badge badge-warning px-2 py-1">Pending</span>
                            @endif
                        </td>
                        <td class="text-muted" style="white-space:nowrap;">
                            {{ $comment->created_at->format('d M Y') }}
                            <div style="font-size:0.75rem;">{{ $comment->created_at->format('H:i') }}</div>
                        </td>
                        <td class="text-center" style="white-space:nowrap;">
                            {{-- Approve --}}
                            @if(!$comment->approved)
                                <form action="{{ route('admin.comments.approve', $comment) }}"
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                            class="btn btn-sm btn-success mr-1"
                                            title="Approve Comment">
                                        <i class="fa fa-check"></i>
                                    </button>
                                </form>
                            @endif

                            {{-- Delete --}}
                            <form action="{{ route('admin.comments.destroy', $comment) }}"
                                  method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="btn btn-sm btn-outline-danger"
                                        title="Delete Comment"
                                        onclick="return confirm('Permanently delete this comment?')">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-5">
                            <i class="fa fa-comments fa-2x mb-2 d-block"></i>
                            No comments found matching your criteria.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($comments->hasPages())
        <div class="card-footer bg-white border-top py-3">
            {{ $comments->appends(request()->query())->links() }}
        </div>
    @endif
</div>

@endsection
