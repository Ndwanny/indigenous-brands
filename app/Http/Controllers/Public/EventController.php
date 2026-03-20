<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::with('category')->orderBy('event_date');

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('location', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('type')) {
            $query->where('event_type', $request->type);
        }

        $events = $query->paginate(9)->withQueryString();
        $eventTypes = ['Coffee Date', 'Bootcamp', 'Workshop', 'Showcase', 'Networking Event'];

        return view('public.events.index', compact('events', 'eventTypes'));
    }
}
