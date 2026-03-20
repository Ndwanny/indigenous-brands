<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\VolunteerApplication;
use Illuminate\Http\Request;

class GetInvolvedController extends Controller
{
    public function index()
    {
        return view('public.get-involved');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'nullable|string|max:30',
            'role'    => 'required|in:volunteer,ambassador',
            'message' => 'nullable|string',
        ]);

        VolunteerApplication::create($validated);

        return back()->with('success', 'Thank you for your interest! We\'ll be in touch soon.');
    }
}
