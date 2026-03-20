<?php

namespace App\Http\Controllers\BrandOwner;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $brand = $user->brand()->with('category')->first();
        $postCount = $brand ? $brand->posts()->count() : 0;
        $publishedCount = $brand ? $brand->posts()->where('status', 'published')->count() : 0;
        $recentPosts = $brand ? $brand->posts()->latest()->take(5)->get() : collect();

        return view('brand-owner.dashboard', compact('brand', 'postCount', 'publishedCount', 'recentPosts'));
    }
}
