@extends('layouts.admin')

@section('title', 'Edit Event — ' . $event->title)
@section('page-title', 'Edit Event')

@section('content')

<div class="admin-page-header d-flex align-items-center justify-content-between flex-wrap">
    <div>
        <h1>Edit Event</h1>
        <p>
            <a href="{{ route('admin.events.index') }}" class="text-muted">
                <i class="fa fa-arrow-left mr-1"></i>Back to Events
            </a>
        </p>
    </div>
</div>

<form action="{{ route('admin.events.update', $event) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row">

        {{-- ============ LEFT COLUMN ============ --}}
        <div class="col-lg-8">

            {{-- Basic Info --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-bottom py-3">
                    <h6 class="mb-0" style="font-weight:700;color:#0f172a;">
                        <i class="fa fa-info-circle mr-2 text-primary"></i>Event Information
                    </h6>
                </div>
                <div class="card-body">

                    {{-- Title --}}
                    <div class="form-group">
                        <label for="title" class="font-weight-600" style="font-weight:600;font-size:0.875rem;">
                            Title <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                               name="title"
                               id="title"
                               class="form-control @error('title') is-invalid @enderror"
                               value="{{ old('title', $event->title) }}"
                               placeholder="Enter event title">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div class="form-group">
                        <label for="description" class="font-weight-600" style="font-weight:600;font-size:0.875rem;">
                            Description
                        </label>
                        <textarea name="description"
                                  id="description"
                                  class="form-control @error('description') is-invalid @enderror"
                                  rows="5"
                                  placeholder="Describe the event...">{{ old('description', $event->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Category + Type --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="category_id" class="font-weight-600" style="font-weight:600;font-size:0.875rem;">
                                    Category
                                </label>
                                <select name="category_id"
                                        id="category_id"
                                        class="form-control @error('category_id') is-invalid @enderror">
                                    <option value="">— Select Category —</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}"
                                                {{ old('category_id', $event->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="event_type" class="font-weight-600" style="font-weight:600;font-size:0.875rem;">
                                    Event Type <span class="text-danger">*</span>
                                </label>
                                <select name="event_type"
                                        id="event_type"
                                        class="form-control @error('event_type') is-invalid @enderror">
                                    <option value="">— Select Type —</option>
                                    <option value="coffee_date"      {{ old('event_type', $event->event_type) === 'coffee_date'      ? 'selected' : '' }}>Coffee Date</option>
                                    <option value="bootcamp"         {{ old('event_type', $event->event_type) === 'bootcamp'         ? 'selected' : '' }}>Bootcamp</option>
                                    <option value="workshop"         {{ old('event_type', $event->event_type) === 'workshop'         ? 'selected' : '' }}>Workshop</option>
                                    <option value="showcase"         {{ old('event_type', $event->event_type) === 'showcase'         ? 'selected' : '' }}>Showcase</option>
                                    <option value="networking_event" {{ old('event_type', $event->event_type) === 'networking_event' ? 'selected' : '' }}>Networking Event</option>
                                </select>
                                @error('event_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            {{-- Date & Location --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-bottom py-3">
                    <h6 class="mb-0" style="font-weight:700;color:#0f172a;">
                        <i class="fa fa-calendar mr-2 text-primary"></i>Date, Time & Location
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="event_date" class="font-weight-600" style="font-weight:600;font-size:0.875rem;">
                                    Event Date <span class="text-danger">*</span>
                                </label>
                                <input type="date"
                                       name="event_date"
                                       id="event_date"
                                       class="form-control @error('event_date') is-invalid @enderror"
                                       value="{{ old('event_date', $event->event_date ? \Carbon\Carbon::parse($event->event_date)->format('Y-m-d') : '') }}">
                                @error('event_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="start_time" class="font-weight-600" style="font-weight:600;font-size:0.875rem;">
                                    Start Time
                                </label>
                                <input type="time"
                                       name="start_time"
                                       id="start_time"
                                       class="form-control @error('start_time') is-invalid @enderror"
                                       value="{{ old('start_time', $event->start_time) }}">
                                @error('start_time')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="end_time" class="font-weight-600" style="font-weight:600;font-size:0.875rem;">
                                    End Time
                                </label>
                                <input type="time"
                                       name="end_time"
                                       id="end_time"
                                       class="form-control @error('end_time') is-invalid @enderror"
                                       value="{{ old('end_time', $event->end_time) }}">
                                @error('end_time')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="location" class="font-weight-600" style="font-weight:600;font-size:0.875rem;">
                                    Location / City
                                </label>
                                <input type="text"
                                       name="location"
                                       id="location"
                                       class="form-control @error('location') is-invalid @enderror"
                                       value="{{ old('location', $event->location) }}"
                                       placeholder="e.g. Cape Town, South Africa">
                                @error('location')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="venue" class="font-weight-600" style="font-weight:600;font-size:0.875rem;">
                                    Venue
                                </label>
                                <input type="text"
                                       name="venue"
                                       id="venue"
                                       class="form-control @error('venue') is-invalid @enderror"
                                       value="{{ old('venue', $event->venue) }}"
                                       placeholder="e.g. The Innovation Hub">
                                @error('venue')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            {{-- Pricing --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-bottom py-3">
                    <h6 class="mb-0" style="font-weight:700;color:#0f172a;">
                        <i class="fa fa-money mr-2 text-primary"></i>Pricing
                    </h6>
                </div>
                <div class="card-body">
                    @php $isFree = old('is_free', $event->is_free ?? false); @endphp
                    <div class="form-group mb-3">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox"
                                   class="custom-control-input"
                                   id="is_free"
                                   name="is_free"
                                   value="1"
                                   {{ $isFree ? 'checked' : '' }}
                                   onchange="togglePrice(this)">
                            <label class="custom-control-label" for="is_free" style="font-weight:600;font-size:0.875rem;">
                                This is a free event
                            </label>
                        </div>
                    </div>
                    <div id="price_field" style="{{ $isFree ? 'display:none;' : '' }}">
                        <div class="form-group mb-0">
                            <label for="price" class="font-weight-600" style="font-weight:600;font-size:0.875rem;">
                                Price (R)
                            </label>
                            <div class="input-group" style="max-width:220px;">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">R</span>
                                </div>
                                <input type="number"
                                       name="price"
                                       id="price"
                                       class="form-control @error('price') is-invalid @enderror"
                                       value="{{ old('price', $event->price) }}"
                                       min="0"
                                       step="0.01"
                                       placeholder="0.00">
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- ============ RIGHT COLUMN ============ --}}
        <div class="col-lg-4">

            {{-- Status --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-bottom py-3">
                    <h6 class="mb-0" style="font-weight:700;color:#0f172a;">
                        <i class="fa fa-toggle-on mr-2 text-primary"></i>Status
                    </h6>
                </div>
                <div class="card-body">
                    <div class="form-group mb-0">
                        <label for="status" class="font-weight-600" style="font-weight:600;font-size:0.875rem;">
                            Event Status <span class="text-danger">*</span>
                        </label>
                        <select name="status"
                                id="status"
                                class="form-control @error('status') is-invalid @enderror">
                            <option value="upcoming"  {{ old('status', $event->status) === 'upcoming'  ? 'selected' : '' }}>Upcoming</option>
                            <option value="ongoing"   {{ old('status', $event->status) === 'ongoing'   ? 'selected' : '' }}>Ongoing</option>
                            <option value="past"      {{ old('status', $event->status) === 'past'      ? 'selected' : '' }}>Past</option>
                            <option value="cancelled" {{ old('status', $event->status) === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Featured Image --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-bottom py-3">
                    <h6 class="mb-0" style="font-weight:700;color:#0f172a;">
                        <i class="fa fa-image mr-2 text-primary"></i>Featured Image
                    </h6>
                </div>
                <div class="card-body">
                    {{-- Current image --}}
                    @if($event->featured_image)
                        <div class="mb-3">
                            <img src="{{ asset('storage/' . $event->featured_image) }}"
                                 alt="Current image"
                                 class="img-fluid rounded"
                                 style="max-height:150px;object-fit:cover;width:100%;">
                            <small class="text-muted d-block mt-1">Current featured image</small>
                        </div>
                    @endif

                    <div class="form-group mb-0">
                        <label for="featured_image" style="font-size:0.875rem;">
                            {{ $event->featured_image ? 'Replace Image' : 'Upload Image' }}
                        </label>
                        <div class="custom-file">
                            <input type="file"
                                   class="custom-file-input @error('featured_image') is-invalid @enderror"
                                   id="featured_image"
                                   name="featured_image"
                                   accept="image/*"
                                   onchange="previewImage(this,'image_preview_wrap')">
                            <label class="custom-file-label" for="featured_image">Choose image...</label>
                        </div>
                        @error('featured_image')
                            <div class="text-danger mt-1" style="font-size:0.8rem;">{{ $message }}</div>
                        @enderror
                        <div id="image_preview_wrap" class="mt-2" style="display:none;">
                            <img id="image_preview" src="" alt="Preview"
                                 class="img-fluid rounded" style="max-height:150px;object-fit:cover;">
                        </div>
                        <small class="form-text text-muted">JPG, PNG or WebP. Max 2MB. Leave blank to keep current.</small>
                    </div>
                </div>
            </div>

            {{-- Submit --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fa fa-save mr-1"></i>Update Event
                    </button>
                    <a href="{{ route('admin.events.index') }}"
                       class="btn btn-outline-secondary btn-block mt-2">
                        Cancel
                    </a>
                </div>
            </div>

            {{-- Danger Zone --}}
            <div class="card border-0 shadow-sm mb-4" style="border-left:4px solid #dc3545 !important;">
                <div class="card-header bg-white border-bottom py-3">
                    <h6 class="mb-0 text-danger" style="font-weight:700;">
                        <i class="fa fa-exclamation-triangle mr-2"></i>Danger Zone
                    </h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.events.destroy', $event) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="btn btn-outline-danger btn-block"
                                onclick="return confirm('Permanently delete this event? This cannot be undone.')">
                            <i class="fa fa-trash mr-1"></i>Delete Event
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</form>

@endsection

@push('scripts')
<script>
    function togglePrice(checkbox) {
        document.getElementById('price_field').style.display = checkbox.checked ? 'none' : '';
    }

    function previewImage(input, wrapId) {
        var wrap = document.getElementById(wrapId);
        var img  = document.getElementById('image_preview');
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                img.src = e.target.result;
                wrap.style.display = '';
            };
            reader.readAsDataURL(input.files[0]);
            input.nextElementSibling.innerText = input.files[0].name;
        }
    }
</script>
@endpush
