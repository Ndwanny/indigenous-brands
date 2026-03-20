<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VolunteerApplication;
use Illuminate\Http\Request;

class VolunteerApplicationController extends Controller
{
    public function index(Request $request)
    {
        $query = VolunteerApplication::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $applications = $query->latest()->paginate(20)->withQueryString();
        return view('admin.volunteers.index', compact('applications'));
    }

    public function updateStatus(Request $request, VolunteerApplication $application)
    {
        $request->validate(['status' => 'required|in:pending,approved,rejected']);
        $application->update(['status' => $request->status]);
        return back()->with('success', 'Application status updated.');
    }
}
