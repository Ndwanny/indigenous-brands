@extends('layouts.brand-owner')

@section('title', 'Create New Post')

@section('content')

    <div class="bo-page-header d-flex align-items-center justify-content-between flex-wrap">
        <div>
            <h1><i class="fa fa-plus-circle mr-2"></i>Create New Post</h1>
            <p>Write and publish a post for your brand.</p>
        </div>
        <div class="mt-2 mt-sm-0">
            <a href="{{ route('brand-owner.posts.index') }}" class="btn btn-outline-secondary">
                <i class="fa fa-arrow-left mr-1"></i>Back to Posts
            </a>
        </div>
    </div>

    <form method="POST"
          action="{{ route('brand-owner.posts.store') }}"
          enctype="multipart/form-data">
        @csrf

        <div class="row">

            {{-- ===== MAIN CONTENT COLUMN ===== --}}
            <div class="col-lg-8 mb-4">

                {{-- Title --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="form-group mb-0">
                            <label for="title">
                                Post Title <span class="text-danger">*</span>
                            </label>
                            <input
                                type="text"
                                id="title"
                                name="title"
                                class="form-control form-control-lg @error('title') is-invalid @enderror"
                                value="{{ old('title') }}"
                                required
                                placeholder="Enter a compelling post title..."
                            >
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Excerpt --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h6 class="mb-0" style="font-weight:700;">Excerpt</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-0">
                            <label for="excerpt" class="sr-only">Excerpt</label>
                            <textarea
                                id="excerpt"
                                name="excerpt"
                                rows="3"
                                class="form-control @error('excerpt') is-invalid @enderror"
                                placeholder="A brief summary of the post (displayed in listings and search results)..."
                            >{{ old('excerpt') }}</textarea>
                            @error('excerpt')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Body --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h6 class="mb-0" style="font-weight:700;">Post Body <span class="text-danger">*</span></h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-0">
                            <label for="body" class="sr-only">Post Body</label>
                            <textarea
                                id="body"
                                name="body"
                                rows="20"
                                class="form-control @error('body') is-invalid @enderror"
                                placeholder="Write your full post content here..."
                            >{{ old('body') }}</textarea>
                            @error('body')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

            </div>

            {{-- ===== SIDEBAR COLUMN ===== --}}
            <div class="col-lg-4 mb-4">

                {{-- Publish Settings --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h6 class="mb-0" style="font-weight:700;">
                            <i class="fa fa-cog mr-2" style="color:#fd7e14;"></i>Publish Settings
                        </h6>
                    </div>
                    <div class="card-body">

                        {{-- Status --}}
                        <div class="form-group">
                            <label for="status">Status <span class="text-danger">*</span></label>
                            <select
                                id="status"
                                name="status"
                                class="form-control @error('status') is-invalid @enderror"
                                required
                            >
                                <option value="draft"     {{ old('status', 'draft') === 'draft'     ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Published</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Category --}}
                        <div class="form-group mb-0">
                            <label for="category_id">Category</label>
                            <select
                                id="category_id"
                                name="category_id"
                                class="form-control @error('category_id') is-invalid @enderror"
                            >
                                <option value="">-- No category --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                </div>

                {{-- Featured Image --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h6 class="mb-0" style="font-weight:700;">
                            <i class="fa fa-image mr-2" style="color:#fd7e14;"></i>Featured Image
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-0">
                            <div class="custom-file">
                                <input
                                    type="file"
                                    id="featured_image"
                                    name="featured_image"
                                    class="custom-file-input @error('featured_image') is-invalid @enderror"
                                    accept="image/*"
                                >
                                <label class="custom-file-label" for="featured_image">Choose image...</label>
                            </div>
                            @error('featured_image')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted mt-1">Recommended: 1200 &times; 630px, max 2MB.</small>

                            {{-- Image preview (populated via JS) --}}
                            <div id="featured-image-preview" class="mt-2" style="display:none;">
                                <img id="featured-image-preview-img" src="" alt="Preview"
                                     class="img-fluid rounded border" style="max-height:160px; object-fit:cover;">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tags --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h6 class="mb-0" style="font-weight:700;">
                            <i class="fa fa-tags mr-2" style="color:#fd7e14;"></i>Tags
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-0">
                            <label for="tags">Tags <small class="text-muted">(comma-separated)</small></label>
                            <input
                                type="text"
                                id="tags"
                                name="tags"
                                class="form-control @error('tags') is-invalid @enderror"
                                value="{{ old('tags') }}"
                                placeholder="e.g. fashion, handmade, zambian"
                            >
                            @error('tags')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted mt-1">
                                Separate multiple tags with commas.
                            </small>

                            {{-- Available Tags Hint --}}
                            @if ($tags->isNotEmpty())
                                <div class="mt-2">
                                    <small class="text-muted d-block mb-1">Available tags:</small>
                                    <div style="display:flex; flex-wrap:wrap; gap:4px;">
                                        @foreach ($tags as $tag)
                                            <span class="badge badge-light border tag-suggestion"
                                                  style="cursor:pointer; font-size:0.775rem;"
                                                  data-tag="{{ $tag->name }}">
                                                {{ $tag->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Form Actions --}}
                <div class="card border-0 shadow-sm">
                    <div class="card-body d-flex flex-column" style="gap:0.5rem;">
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fa fa-save mr-2"></i>Save Post
                        </button>
                        <a href="{{ route('brand-owner.posts.index') }}"
                           class="btn btn-outline-secondary btn-block">
                            <i class="fa fa-times mr-1"></i>Discard
                        </a>
                    </div>
                </div>

            </div>
        </div>

    </form>

@endsection

@push('scripts')
<script>
    // Custom file input label
    document.querySelectorAll('.custom-file-input').forEach(function(input) {
        input.addEventListener('change', function () {
            var label = this.nextElementSibling;
            if (this.files && this.files.length > 0) {
                label.textContent = this.files[0].name;
            }
        });
    });

    // Featured image live preview
    var featuredInput = document.getElementById('featured_image');
    if (featuredInput) {
        featuredInput.addEventListener('change', function () {
            var preview    = document.getElementById('featured-image-preview');
            var previewImg = document.getElementById('featured-image-preview-img');
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    previewImg.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(this.files[0]);
            } else {
                preview.style.display = 'none';
            }
        });
    }

    // Tag suggestion click — append to tags input
    document.querySelectorAll('.tag-suggestion').forEach(function(badge) {
        badge.addEventListener('click', function () {
            var tagsInput = document.getElementById('tags');
            var tag       = this.getAttribute('data-tag');
            var current   = tagsInput.value.trim();
            var existing  = current ? current.split(',').map(function(t){ return t.trim().toLowerCase(); }) : [];
            if (!existing.includes(tag.toLowerCase())) {
                tagsInput.value = current ? current + ', ' + tag : tag;
            }
        });
    });
</script>
@endpush
