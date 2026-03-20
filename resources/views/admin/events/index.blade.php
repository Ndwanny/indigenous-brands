@extends('layouts.admin')

@section('title', 'Manage Events')
@section('page-title', 'Manage Events')

@section('content')

<div class="admin-page-header d-flex align-items-center justify-content-between flex-wrap">
    <div>
        <h1>Events</h1>
        <p>Create and manage all platform events.</p>
    </div>
    <a href="{{ route('admin.events.create') }}" class="btn btn-primary">
        <i class="fa fa-plus mr-1"></i>Add Event
    </a>
</div>

{{-- ===================== FILTER FORM ===================== --}}
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body py-3">
        <form method="GET" action="{{ route('admin.events.index') }}" class="form-inline flex-wrap" style="gap:0.5rem;">
            <div class="input-group mr-2 mb-2 mb-md-0" style="max-width:300px;">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-white border-right-0">
                        <i class="fa fa-search text-muted" style="font-size:0.85rem;"></i>
                    </span>
                </div>
                <input type="text"
                       name="search"
                       class="form-control border-left-0"
                       placeholder="Search event title..."
                       value="{{ request('search') }}">
            </div>

            <select name="status" class="form-control mr-2 mb-2 mb-md-0" style="width:auto;">
                <option value="">All Statuses</option>
                <option value="upcoming"  {{ request('status') === 'upcoming'  ? 'selected' : '' }}>Upcoming</option>
                <option value="ongoing"   {{ request('status') === 'ongoing'   ? 'selected' : '' }}>Ongoing</option>
                <option value="past"      {{ request('status') === 'past'      ? 'selected' : '' }}>Past</option>
                <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>

            <button type="submit" class="btn btn-primary mr-2 mb-2 mb-md-0">
                <i class="fa fa-filter mr-1"></i>Filter
            </button>
            @if(request()->hasAny(['search','status']))
                <a href="{{ route('admin.events.index') }}" class="btn btn-outline-secondary mb-2 mb-md-0">
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
            All Events
            <span class="badge badge-secondary ml-2" style="font-size:0.75rem;">
                {{ $events->total() }}
            </span>
        </h6>
    </div>

    <div class="table-responsive">
        <table class="table table-hover mb-0" style="font-size:0.855rem;">
            <thead class="thead-light">
                <tr>
                    <th style="width:60px;">Image</th>
                    <th>Title</th>
                    <th class="text-center">Type</th>
                    <th>Date</th>
                    <th>Location</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($events as $event)
                    <tr>
                        <td>
                            @if($event->featured_image)
                                <img src="{{ asset('storage/' . $event->featured_image) }}"
                                     alt="{{ $event->title }}"
                                     class="rounded"
                                     style="width:50px;height:40px;object-fit:cover;">
                            @else
                                <div class="rounded d-flex align-items-center justify-content-center"
                                     style="width:50px;height:40px;background:#e2e8f0;">
                                    <i class="fa fa-calendar text-muted" style="font-size:0.9rem;"></i>
                                </div>
                            @endif
                        </td>
                        <td>
                            <div style="font-weight:600;color:#0f172a;max-width:220px;">
                                {{ Str::limit($event->title, 50) }}
                            </div>
                            @if($event->category)
                                <div class="text-muted" style="font-size:0.78rem;">
                                    <i class="fa fa-tag mr-1"></i>{{ $event->category->name }}
                                </div>
                            @endif
                        </td>
                        <td class="text-center">
                            @php
                                $typeBadges = [
                                    'coffee_date'      => ['label' => 'Coffee Date',      'class' => 'badge-info'],
                                    'bootcamp'         => ['label' => 'Bootcamp',         'class' => 'badge-warning'],
                                    'workshop'         => ['label' => 'Workshop',         'class' => 'badge-primary'],
                                    'showcase'         => ['label' => 'Showcase',         'class' => 'badge-success'],
                                    'networking_event' => ['label' => 'Networking Event', 'class' => 'badge-secondary'],
                                ];
                                $tb = $typeBadges[$event->event_type] ?? ['label' => ucfirst($event->event_type ?? ''), 'class' => 'badge-light'];
                            @endphp
                            <span class="badge {{ $tb['class'] }} px-2 py-1" style="font-size:0.72rem;">
                                {{ $tb['label'] }}
                            </span>
                        </td>
                        <td class="text-muted" style="white-space:nowrap;">
                            {{ $event->event_date ? \Carbon\Carbon::parse($event->event_date)->format('d M Y') : '—' }}
                            @if($event->start_time)
                                <div style="font-size:0.78rem;">{{ $event->start_time }}</div>
                            @endif
                        </td>
                        <td>
                            <div style="max-width:150px;" class="text-muted">
                                {{ Str::limit($event->location ?? '—', 30) }}
                            </div>
                        </td>
                        <td class="text-center">
                            @if($event->status === 'upcoming')
                                <span class="badge badge-primary px-2 py-1">Upcoming</span>
                            @elseif($event->status === 'ongoing')
                                <span class="badge badge-success px-2 py-1">Ongoing</span>
                            @elseif($event->status === 'past')
                                <span class="badge badge-secondary px-2 py-1">Past</span>
                            @elseif($event->status === 'cancelled')
                                <span class="badge badge-danger px-2 py-1">Cancelled</span>
                            @else
                                <span class="badge badge-light px-2 py-1">{{ ucfirst($event->status ?? '') }}</span>
                            @endif
                        </td>
                        <td class="text-center" style="white-space:nowrap;">
                            <a href="{{ route('admin.events.edit', $event) }}"
                               class="btn btn-sm btn-outline-primary mr-1" title="Edit">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <form action="{{ route('admin.events.destroy', $event) }}"
                                  method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="btn btn-sm btn-outline-danger"
                                        title="Delete Event"
                                        onclick="return confirm('Delete \'{{ addslashes(Str::limit($event->title, 40)) }}\'? This cannot be undone.')">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-5">
                            <i class="fa fa-calendar fa-2x mb-2 d-block"></i>
                            No events found.
                            <a href="{{ route('admin.events.create') }}" class="d-block mt-2">
                                Create your first event
                            </a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($events->hasPages())
        <div class="card-footer bg-white border-top py-3">
            {{ $events->appends(request()->query())->links() }}
        </div>
    @endif
</div>

@endsection
