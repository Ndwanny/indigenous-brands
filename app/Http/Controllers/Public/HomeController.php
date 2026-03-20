<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Event;
use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        $featuredBrands = Brand::approved()->featured()->with('category')->latest()->take(6)->get();
        $latestBrands = Brand::approved()->with('category')->latest()->take(6)->get();
        $upcomingEvents = Event::upcoming()->latest('event_date')->take(6)->get();
        $recentPosts = Post::published()->with(['brand', 'category'])->latest('published_at')->take(3)->get();

        return view('public.home', compact('featuredBrands', 'latestBrands', 'upcomingEvents', 'recentPosts'));
    }
}
