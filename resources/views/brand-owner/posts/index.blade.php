@extends('layouts.brand-owner')

@section('title', 'My Posts')

@section('content')

    <div class="bo-page-header d-flex align-items-center justify-content-between flex-wrap">
        <div>
            <h1><i class="fa fa-file-text-o mr-2"></i>My Posts</h1>
            <p>Manage all the posts you have created for your brand.</p>
        </div>
        <div class="mt-2 mt-sm-0">
            <a href="{{ route('brand-owner.posts.create') }}" class="btn btn-primary">
                <i class="fa fa-plus-circle mr-2"></i>Create New Post
            </a>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">

            @if ($posts->isEmpty())
                <div class="text-center text-muted py-5">
                    <i class="fa fa-file-text-o fa-3x mb-3 d-block" style="color:#dee2e6;"></i>
                    <h5 class="mb-1">No posts yet</h5>
                    <p class="mb-3">You haven't created any posts. Get started by creating your first post.</p>
                    <a href="{{ route('brand-owner.posts.create') }}" class="btn btn-primary">
                        <i class="fa fa-plus-circle mr-2"></i>Create Your First Post
                    </a>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th style="width:45%;">Title</th>
                                <th>Status</th>
                                <th>Created</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <td class="align-middle">
                                        <span class="font-weight-500" style="font-weight:500;">
                                            {{ Str::limit($post->title, 60) }}
                                        </span>
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
                                    <td class="align-middle text-muted" style="font-size:0.825rem; white-space:nowrap;">
                                        {{ $post->created_at->format('d M Y') }}
                                    </td>
                                    <td class="align-middle text-right">
                                        <a href="{{ route('brand-owner.posts.edit', $post) }}"
                                           class="btn btn-sm btn-outline-primary mr-1"
                                           title="Edit post">
                                            <i class="fa fa-pencil"></i>
                                            <span class="d-none d-md-inline ml-1">Edit</span>
                                        </a>

                                        <form method="POST"
                                              action="{{ route('brand-owner.posts.destroy', $post) }}"
                                              class="d-inline"
                                              onsubmit="return confirm('Are you sure you want to delete &quot;{{ addslashes(Str::limit($post->title, 40)) }}&quot;? This action cannot be undone.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-sm btn-outline-danger"
                                                    title="Delete post">
                                                <i class="fa fa-trash"></i>
                                                <span class="d-none d-md-inline ml-1">Delete</span>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                @if ($posts->hasPages())
                    <div class="card-footer bg-white border-top-0 d-flex justify-content-center py-3">
                        {{ $posts->links() }}
                    </div>
                @endif

            @endif

        </div>
    </div>

@endsection
