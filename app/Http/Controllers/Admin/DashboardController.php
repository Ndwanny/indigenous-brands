<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Comment;
use App\Models\ContactMessage;
use App\Models\Post;
use App\Models\User;
use App\Models\VolunteerApplication;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users'        => User::count(),
            'brand_owners'       => User::brandOwners()->count(),
            'pending_brands'     => Brand::where('status', 'pending')->count(),
            'approved_brands'    => Brand::where('status', 'approved')->count(),
            'total_posts'        => Post::count(),
            'published_posts'    => Post::where('status', 'published')->count(),
            'pending_comments'   => Comment::where('is_approved', false)->count(),
            'unread_messages'    => ContactMessage::where('is_read', false)->count(),
            'pending_volunteers' => VolunteerApplication::where('status', 'pending')->count(),
        ];

        $recentBrands = Brand::where('status', 'pending')->with('user')->latest()->take(5)->get();
        $recentMessages = ContactMessage::where('is_read', false)->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentBrands', 'recentMessages'));
    }
}
