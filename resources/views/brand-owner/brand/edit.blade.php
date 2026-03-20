@extends('layouts.brand-owner')

@section('title', 'Edit Brand Profile')

@section('content')

    <div class="bo-page-header">
        <h1><i class="fa fa-pencil-square-o mr-2"></i>Edit Brand Profile</h1>
        <p>Update your brand details below. Changes will be reviewed if your brand is re-submitted.</p>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">

            <form method="POST"
                  action="{{ route('brand-owner.brand.update', $brand) }}"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- ===== BASIC INFORMATION ===== --}}
                <h5 class="mb-3 pb-2 border-bottom" style="color:#1a1a2e; font-weight:700;">
                    <i class="fa fa-info-circle mr-2" style="color:#fd7e14;"></i>Basic Information
                </h5>

                <div class="row">
                    {{-- Brand Name --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Brand Name <span class="text-danger">*</span></label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $brand->name) }}"
                                required
                                placeholder="e.g. Zambian Crafts Co."
                            >
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Tagline --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tagline">
                                Tagline
                                <small class="text-muted">(optional, max 255 characters)</small>
                            </label>
                            <input
                                type="text"
                                id="tagline"
                                name="tagline"
                                class="form-control @error('tagline') is-invalid @enderror"
                                value="{{ old('tagline', $brand->tagline) }}"
                                maxlength="255"
                                placeholder="A short, catchy brand motto"
                            >
                            @error('tagline')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    {{-- Category --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="category_id">Category <span class="text-danger">*</span></label>
                            <select
                                id="category_id"
                                name="category_id"
                                class="form-control @error('category_id') is-invalid @enderror"
                                required
                            >
                                <option value="">-- Select a category --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                            {{ old('category_id', $brand->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Location --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="location">Location</label>
                            <input
                                type="text"
                                id="location"
                                name="location"
                                class="form-control @error('location') is-invalid @enderror"
                                value="{{ old('location', $brand->location) }}"
                                placeholder="e.g. Lusaka, Zambia"
                            >
                            @error('location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Description --}}
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea
                        id="description"
                        name="description"
                        rows="5"
                        class="form-control @error('description') is-invalid @enderror"
                        placeholder="Tell customers about your brand..."
                    >{{ old('description', $brand->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- ===== CONTACT & ONLINE PRESENCE ===== --}}
                <h5 class="mb-3 pb-2 border-bottom mt-4" style="color:#1a1a2e; font-weight:700;">
                    <i class="fa fa-globe mr-2" style="color:#fd7e14;"></i>Contact &amp; Online Presence
                </h5>

                <div class="row">
                    {{-- Website URL --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="website">Website URL</label>
                            <input
                                type="url"
                                id="website"
                                name="website"
                                class="form-control @error('website') is-invalid @enderror"
                                value="{{ old('website', $brand->website) }}"
                                placeholder="https://www.yourbrand.com"
                            >
                            @error('website')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email', $brand->email) }}"
                                placeholder="contact@yourbrand.com"
                            >
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    {{-- Phone --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input
                                type="tel"
                                id="phone"
                                name="phone"
                                class="form-control @error('phone') is-invalid @enderror"
                                value="{{ old('phone', $brand->phone) }}"
                                placeholder="+260 97X XXX XXX"
                            >
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- ===== SOCIAL MEDIA ===== --}}
                <h5 class="mb-3 pb-2 border-bottom mt-4" style="color:#1a1a2e; font-weight:700;">
                    <i class="fa fa-share-alt mr-2" style="color:#fd7e14;"></i>Social Media
                </h5>

                <div class="row">
                    {{-- Facebook --}}
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="facebook_url">
                                <i class="fa fa-facebook-square mr-1" style="color:#3b5998;"></i>Facebook URL
                            </label>
                            <input
                                type="url"
                                id="facebook_url"
                                name="facebook_url"
                                class="form-control @error('facebook_url') is-invalid @enderror"
                                value="{{ old('facebook_url', $brand->facebook_url) }}"
                                placeholder="https://facebook.com/yourbrand"
                            >
                            @error('facebook_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Twitter --}}
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="twitter_url">
                                <i class="fa fa-twitter-square mr-1" style="color:#1da1f2;"></i>Twitter URL
                            </label>
                            <input
                                type="url"
                                id="twitter_url"
                                name="twitter_url"
                                class="form-control @error('twitter_url') is-invalid @enderror"
                                value="{{ old('twitter_url', $brand->twitter_url) }}"
                                placeholder="https://twitter.com/yourbrand"
                            >
                            @error('twitter_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Instagram --}}
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="instagram_url">
                                <i class="fa fa-instagram mr-1" style="color:#c13584;"></i>Instagram URL
                            </label>
                            <input
                                type="url"
                                id="instagram_url"
                                name="instagram_url"
                                class="form-control @error('instagram_url') is-invalid @enderror"
                                value="{{ old('instagram_url', $brand->instagram_url) }}"
                                placeholder="https://instagram.com/yourbrand"
                            >
                            @error('instagram_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- ===== IMAGES ===== --}}
                <h5 class="mb-3 pb-2 border-bottom mt-4" style="color:#1a1a2e; font-weight:700;">
                    <i class="fa fa-image mr-2" style="color:#fd7e14;"></i>Brand Images
                </h5>

                <div class="row">
                    {{-- Logo --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="logo">
                                Logo
                                <small class="text-muted">(image, max 2MB — leave blank to keep current)</small>
                            </label>

                            {{-- Current Logo Preview --}}
                            @if ($brand->logo)
                                <div class="mb-2">
                                    <img
                                        src="{{ asset('storage/' . $brand->logo) }}"
                                        alt="Current Logo"
                                        class="rounded border"
                                        style="max-height:90px; max-width:180px; object-fit:contain;"
                                    >
                                    <div class="mt-1">
                                        <small class="text-muted">Current logo</small>
                                    </div>
                                </div>
                            @endif

                            <div class="custom-file">
                                <input
                                    type="file"
                                    id="logo"
                                    name="logo"
                                    class="custom-file-input @error('logo') is-invalid @enderror"
                                    accept="image/*"
                                >
                                <label class="custom-file-label" for="logo">
                                    {{ $brand->logo ? 'Replace logo...' : 'Choose logo file...' }}
                                </label>
                            </div>
                            @error('logo')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Cover Image --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cover_image">
                                Cover Image
                                <small class="text-muted">(image, max 2MB — leave blank to keep current)</small>
                            </label>

                            {{-- Current Cover Preview --}}
                            @if ($brand->cover_image)
                                <div class="mb-2">
                                    <img
                                        src="{{ asset('storage/' . $brand->cover_image) }}"
                                        alt="Current Cover"
                                        class="rounded border"
                                        style="max-height:90px; max-width:100%; object-fit:cover;"
                                    >
                                    <div class="mt-1">
                                        <small class="text-muted">Current cover image</small>
                                    </div>
                                </div>
                            @endif

                            <div class="custom-file">
                                <input
                                    type="file"
                                    id="cover_image"
                                    name="cover_image"
                                    class="custom-file-input @error('cover_image') is-invalid @enderror"
                                    accept="image/*"
                                >
                                <label class="custom-file-label" for="cover_image">
                                    {{ $brand->cover_image ? 'Replace cover image...' : 'Choose cover file...' }}
                                </label>
                            </div>
                            @error('cover_image')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- ===== FORM ACTIONS ===== --}}
                <div class="d-flex align-items-center justify-content-end mt-4 pt-3 border-top">
                    <a href="{{ route('brand-owner.dashboard') }}" class="btn btn-outline-secondary mr-3">
                        <i class="fa fa-times mr-1"></i>Cancel
                    </a>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fa fa-save mr-2"></i>Save Changes
                    </button>
                </div>

            </form>

        </div>
    </div>

@endsection

@push('scripts')
<script>
    document.querySelectorAll('.custom-file-input').forEach(function(input) {
        input.addEventListener('change', function () {
            var label = this.nextElementSibling;
            if (this.files && this.files.length > 0) {
                label.textContent = this.files[0].name;
            }
        });
    });
</script>
@endpush
