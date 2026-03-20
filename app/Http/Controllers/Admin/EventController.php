<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::with('category');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $events = $query->orderBy('event_date', 'desc')->paginate(15)->withQueryString();
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        $categories = Category::forEvents()->get();
        $eventTypes = ['Coffee Date', 'Bootcamp', 'Workshop', 'Showcase', 'Networking Event'];
        return view('admin.events.create', compact('categories', 'eventTypes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'          => 'required|string|max:255',
            'description'    => 'nullable|string',
            'category_id'    => 'nullable|exists:categories,id',
            'location'       => 'nullable|string|max:255',
            'venue'          => 'nullable|string|max:255',
            'event_date'     => 'required|date',
            'start_time'     => 'nullable|date_format:H:i',
            'end_time'       => 'nullable|date_format:H:i',
            'is_free'        => 'boolean',
            'price'          => 'nullable|numeric|min:0',
            'event_type'     => 'nullable|in:Coffee Date,Bootcamp,Workshop,Showcase,Networking Event',
            'status'         => 'required|in:upcoming,ongoing,past,cancelled',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('event-images', 'public');
        }

        $validated['slug'] = Str::slug($validated['title']);
        $validated['is_free'] = $request->boolean('is_free');

        Event::create($validated);
        return redirect()->route('admin.events.index')->with('success', 'Event created successfully.');
    }

    public function edit(Event $event)
    {
        $categories = Category::forEvents()->get();
        $eventTypes = ['Coffee Date', 'Bootcamp', 'Workshop', 'Showcase', 'Networking Event'];
        return view('admin.events.edit', compact('event', 'categories', 'eventTypes'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title'          => 'required|string|max:255',
            'description'    => 'nullable|string',
            'category_id'    => 'nullable|exists:categories,id',
            'location'       => 'nullable|string|max:255',
            'venue'          => 'nullable|string|max:255',
            'event_date'     => 'required|date',
            'start_time'     => 'nullable|date_format:H:i',
            'end_time'       => 'nullable|date_format:H:i',
            'is_free'        => 'boolean',
            'price'          => 'nullable|numeric|min:0',
            'event_type'     => 'nullable|in:Coffee Date,Bootcamp,Workshop,Showcase,Networking Event',
            'status'         => 'required|in:upcoming,ongoing,past,cancelled',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('event-images', 'public');
        }

        $validated['is_free'] = $request->boolean('is_free');
        $event->update($validated);
        return redirect()->route('admin.events.index')->with('success', 'Event updated successfully.');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return back()->with('success', 'Event deleted.');
    }
}
