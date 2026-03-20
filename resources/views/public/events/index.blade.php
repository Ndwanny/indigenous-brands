@extends('layouts.app')

@section('title', 'Events - Indigenous Brands | Zambian Entrepreneur Events')

@section('content')

    {{-- ===================== HERO BANNER ===================== --}}
    @include('partials.hero-banner', ['title' => 'Events'])

    {{-- ===================== FILTER / SEARCH BAR ===================== --}}
    <section class="ftco-section ftco-no-pb">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="search-wrap-1 ftco-animate">
                        <form action="{{ route('events.index') }}" method="GET" class="search-property-1">
                            <div class="row no-gutters">
                                <div class="col-lg d-flex">
                                    <div class="form-group p-4 border-0">
                                        <label for="event_search">Event Name</label>
                                        <div class="form-field">
                                            <div class="icon"><span class="fa fa-search"></span></div>
                                            <input style="z-index: 999; position: relative;" type="text" name="search" id="event_search" class="form-control" placeholder="Search event" value="{{ request('search') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg d-flex">
                                    <div class="form-group p-4">
                                        <label for="event_type_filter">Event Type</label>
                                        <div class="form-field">
                                            <div class="select-wrap">
                                                <div class="icon"><span class="fa fa-chevron-down"></span></div>
                                                <select style="z-index: 999; position: relative;" name="type" id="event_type_filter" class="form-control">
                                                    <option value="">All Types</option>
                                                    @if(isset($eventTypes) && !empty($eventTypes))
                                                        @foreach($eventTypes as $type)
                                                            <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>
                                                                {{ ucfirst($type) }}
                                                            </option>
                                                        @endforeach
                                                    @else
                                                        <option value="networking" {{ request('type') == 'networking' ? 'selected' : '' }}>Networking Event</option>
                                                        <option value="bootcamp" {{ request('type') == 'bootcamp' ? 'selected' : '' }}>Bootcamp</option>
                                                        <option value="workshop" {{ request('type') == 'workshop' ? 'selected' : '' }}>Workshop</option>
                                                        <option value="showcase" {{ request('type') == 'showcase' ? 'selected' : '' }}>Showcase</option>
                                                        <option value="coffee-date" {{ request('type') == 'coffee-date' ? 'selected' : '' }}>Coffee Date</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg d-flex">
                                    <div class="form-group p-4">
                                        <label for="event_location">Location</label>
                                        <div class="form-field">
                                            <div class="icon"><span class="fa fa-map-marker"></span></div>
                                            <input style="z-index: 999; position: relative;" type="text" name="location" id="event_location" class="form-control" placeholder="Location" value="{{ request('location') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg d-flex">
                                    <div class="form-group d-flex w-100 border-0">
                                        <div class="form-field w-100 align-items-center d-flex">
                                            <input type="submit" value="Search" class="align-self-stretch form-control btn btn-primary">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===================== EVENTS GRID ===================== --}}
    <section class="ftco-section">
        <div class="container">

            {{-- Active filters --}}
            @if(request('search') || request('type') || request('location'))
                <div class="row mb-3">
                    <div class="col-md-12 ftco-animate">
                        <p class="text-muted">
                            Showing results
                            @if(request('search')) for "<strong>{{ request('search') }}</strong>"@endif
                            @if(request('type')) of type "<strong>{{ request('type') }}</strong>"@endif
                            @if(request('location')) in "<strong>{{ request('location') }}</strong>"@endif
                            &mdash; <a href="{{ route('events.index') }}">Clear filters</a>
                        </p>
                    </div>
                </div>
            @endif

            <div class="row">
                @if($events->isEmpty())
                    <div class="col-md-12 text-center py-5 ftco-animate">
                        <div class="p-5">
                            <span class="fa fa-calendar fa-3x text-muted mb-3 d-block"></span>
                            <h4 class="text-muted">No events found</h4>
                            <p class="text-muted">There are no upcoming events matching your search. Check back soon for new events!</p>
                            <a href="{{ route('events.index') }}" class="btn btn-primary mt-3">View All Events</a>
                        </div>
                    </div>
                @else
                    @foreach($events as $event)
                        <div class="col-md-4 ftco-animate">
                            <div class="project-wrap">
                                <a href="{{ route('events.index') }}" class="img"
                                    style="background-image: url('{{ $event->featured_image_url ?? 'https://i.ibb.co/dRLr6zG/1-12.jpg' }}');">
                                    <span class="price">{{ $event->formatted_price ?? 'Free' }}</span>
                                </a>
                                <div class="text p-4">
                                    <span class="days">{{ $event->event_type ?? 'Event' }}</span>
                                    <h3><a href="{{ route('events.index') }}">{{ $event->title }}</a></h3>
                                    <p class="location"><span class="fa fa-map-marker"></span> {{ $event->location ?? 'Lusaka, Zambia' }}</p>
                                    <ul>
                                        <li><span class="flaticon-shower"></span>
                                            @if($event->event_type)
                                                {{ ucfirst($event->event_type) }}
                                            @else
                                                Community Event
                                            @endif
                                        </li>
                                        <li><span class="flaticon-king-size"></span>
                                            @if($event->event_date)
                                                {{ $event->event_date instanceof \Carbon\Carbon
                                                    ? $event->event_date->format('F j, Y')
                                                    : \Carbon\Carbon::parse($event->event_date)->format('F j, Y') }}
                                            @else
                                                Coming Soon
                                            @endif
                                        </li>
                                        <li><span class="flaticon-mountains"></span>{{ $event->venue ?? $event->location ?? 'Zambia' }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            {{-- Pagination --}}
            @if($events->hasPages())
                <div class="row mt-5">
                    <div class="col text-center ftco-animate">
                        {{ $events->appends(request()->query())->links() }}
                    </div>
                </div>
            @endif

        </div>
    </section>

    {{-- ===================== CTA SECTION ===================== --}}
    @include('partials.cta-section')

@endsection
