@extends('layouts.brand-owner')

@section('title', 'Create Brand Profile')

@section('content')

    <div class="bo-page-header">
        <h1><i class="fa fa-plus-circle mr-2"></i>Create Brand Profile</h1>
        <p>Fill in your brand details below. Your profile will be reviewed before going live.</p>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">

            <form method="POST"
                  action="{{ route('brand-owner.brand.store') }}"
                  enctype="multipart/form-data">
                @csrf

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
                                value="{{ old('name') }}"
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
                                value="{{ old('tagline') }}"
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

                    {{-- Location --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="location">Location</label>
                            <input
                                type="text"
                                id="location"
                                name="location"
                                class="form-control @error('location') is-invalid @enderror"
                                value="{{ old('location') }}"
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
                        placeholder="Tell customers about your brand, what you offer and what makes you unique..."
                    >{{ old('description') }}</textarea>
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
                                value="{{ old('website') }}"
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
                                value="{{ old('email') }}"
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
                                value="{{ old('phone') }}"
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
                                value="{{ old('facebook_url') }}"
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
                                value="{{ old('twitter_url') }}"
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
                                value="{{ old('instagram_url') }}"
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
                                <small class="text-muted">(image, max 2MB)</small>
                            </label>
                            <div class="custom-file">
                                <input
                                    type="file"
                                    id="logo"
                                    name="logo"
                                    class="custom-file-input @error('logo') is-invalid @enderror"
                                    accept="image/*"
                                >
                                <label class="custom-file-label" for="logo">Choose logo file...</label>
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
                                <small class="text-muted">(image, max 2MB)</small>
                            </label>
                            <div class="custom-file">
                                <input
                                    type="file"
                                    id="cover_image"
                                    name="cover_image"
                                    class="custom-file-input @error('cover_image') is-invalid @enderror"
                                    accept="image/*"
                                >
                                <label class="custom-file-label" for="cover_image">Choose cover file...</label>
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
                        <i class="fa fa-save mr-2"></i>Submit Brand Profile
                    </button>
                </div>

            </form>

        </div>
    </div>

@endsection

@push('scripts')
<script>
    // Update custom-file-input labels with selected filename
    document.querySelectorAll('.custom-file-input').forEach(function(input) {
        input.addEventListener('change', function () {
            var label = this.nextElementSibling;
            if (this.files && this.files.length > 0) {
                label.textContent = this.files[0].name;
            } else {
                label.textContent = 'Choose file...';
            }
        });
    });
</script>
@endpush
