@extends('layouts.admin')

@section('title', 'Manage Categories')
@section('page-title', 'Manage Categories')

@section('content')

<div class="admin-page-header">
    <h1>Categories</h1>
    <p>Manage brand, blog post, and event categories.</p>
</div>

@php
    $types = [
        'brand' => [
            'label'     => 'Brand Categories',
            'icon'      => 'fa-building',
            'color'     => 'primary',
            'countKey'  => 'brands_count',
            'countLabel'=> 'Brands',
        ],
        'blog' => [
            'label'     => 'Blog / Post Categories',
            'icon'      => 'fa-file-text',
            'color'     => 'success',
            'countKey'  => 'posts_count',
            'countLabel'=> 'Posts',
        ],
        'event' => [
            'label'     => 'Event Categories',
            'icon'      => 'fa-calendar',
            'color'     => 'info',
            'countKey'  => 'events_count',
            'countLabel'=> 'Events',
        ],
    ];
@endphp

@foreach($types as $typeKey => $typeMeta)

<div class="card border-0 shadow-sm mb-5">

    {{-- Section Header --}}
    <div class="card-header bg-white border-bottom py-3 d-flex align-items-center">
        <div class="rounded mr-3 d-flex align-items-center justify-content-center"
             style="width:38px;height:38px;background:var(--{{ $typeMeta['color'] }}-light, #e8f4fd);flex-shrink:0;">
            <i class="fa {{ $typeMeta['icon'] }} text-{{ $typeMeta['color'] }}"></i>
        </div>
        <div>
            <h6 class="mb-0" style="font-weight:700;color:#0f172a;">{{ $typeMeta['label'] }}</h6>
            <small class="text-muted">
                {{ isset($categories[$typeKey]) ? $categories[$typeKey]->count() : 0 }} categor{{ isset($categories[$typeKey]) && $categories[$typeKey]->count() === 1 ? 'y' : 'ies' }}
            </small>
        </div>
    </div>

    {{-- Table --}}
    <div class="table-responsive">
        <table class="table table-hover mb-0" style="font-size:0.855rem;">
            <thead class="thead-light">
                <tr>
                    <th>Name</th>
                    <th>Slug</th>
                    <th class="text-center">{{ $typeMeta['countLabel'] }}</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse(isset($categories[$typeKey]) ? $categories[$typeKey] : [] as $category)
                    <tr>
                        <td style="font-weight:600;color:#0f172a;">{{ $category->name }}</td>
                        <td>
                            <code style="background:#f1f5f9;padding:2px 6px;border-radius:4px;font-size:0.8rem;">
                                {{ $category->slug }}
                            </code>
                        </td>
                        <td class="text-center">
                            <span class="badge badge-{{ $typeMeta['color'] }} px-2 py-1">
                                {{ $category->{ $typeMeta['countKey'] } ?? 0 }}
                            </span>
                        </td>
                        <td class="text-center">
                            <form action="{{ route('admin.categories.destroy', $category) }}"
                                  method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="btn btn-sm btn-outline-danger"
                                        title="Delete Category"
                                        onclick="return confirm('Delete \'{{ addslashes($category->name) }}\'? Any {{ strtolower($typeMeta['countLabel']) }} using this category will be unassigned.')">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted py-3" style="font-size:0.855rem;">
                            No {{ strtolower($typeMeta['label']) }} yet. Add one below.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Add Category Inline Form --}}
    <div class="card-footer bg-white border-top py-3">
        <form action="{{ route('admin.categories.store') }}"
              method="POST"
              class="form-inline flex-wrap"
              style="gap:0.5rem;">
            @csrf
            <input type="hidden" name="type" value="{{ $typeKey }}">

            <div class="input-group mr-2 mb-2 mb-md-0" style="max-width:280px;">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-white border-right-0">
                        <i class="fa fa-tag text-muted" style="font-size:0.85rem;"></i>
                    </span>
                </div>
                <input type="text"
                       name="name"
                       class="form-control border-left-0 @error('name') is-invalid @enderror"
                       placeholder="New {{ strtolower(rtrim($typeMeta['label'], 's')) }} name..."
                       autocomplete="off">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-{{ $typeMeta['color'] }} mb-2 mb-md-0">
                <i class="fa fa-plus mr-1"></i>Add Category
            </button>
        </form>
    </div>

</div>

@endforeach

@endsection
