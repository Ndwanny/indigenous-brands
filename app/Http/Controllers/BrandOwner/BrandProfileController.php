<?php

namespace App\Http\Controllers\BrandOwner;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BrandProfileController extends Controller
{
    public function create()
    {
        if (auth()->user()->hasBrand()) {
            return redirect()->route('brand-owner.brand.edit');
        }
        $categories = Category::forBrands()->get();
        return view('brand-owner.brand.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'tagline'      => 'nullable|string|max:255',
            'description'  => 'nullable|string',
            'category_id'  => 'nullable|exists:categories,id',
            'location'     => 'nullable|string|max:255',
            'website_url'  => 'nullable|url|max:255',
            'phone'        => 'nullable|string|max:30',
            'email'        => 'nullable|email|max:255',
            'facebook_url' => 'nullable|url|max:255',
            'twitter_url'  => 'nullable|url|max:255',
            'instagram_url'=> 'nullable|url|max:255',
            'logo'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'cover_image'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('logos', 'public');
        }
        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')->store('brand-covers', 'public');
        }

        $validated['slug'] = Str::slug($validated['name']);

        auth()->user()->brand()->create($validated);

        return redirect()->route('brand-owner.dashboard')
            ->with('success', 'Brand profile created! It is pending admin approval.');
    }

    public function edit()
    {
        $brand = auth()->user()->brand;
        if (!$brand) {
            return redirect()->route('brand-owner.brand.create');
        }
        $categories = Category::forBrands()->get();
        return view('brand-owner.brand.edit', compact('brand', 'categories'));
    }

    public function update(Request $request)
    {
        $brand = auth()->user()->brand;

        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'tagline'      => 'nullable|string|max:255',
            'description'  => 'nullable|string',
            'category_id'  => 'nullable|exists:categories,id',
            'location'     => 'nullable|string|max:255',
            'website_url'  => 'nullable|url|max:255',
            'phone'        => 'nullable|string|max:30',
            'email'        => 'nullable|email|max:255',
            'facebook_url' => 'nullable|url|max:255',
            'twitter_url'  => 'nullable|url|max:255',
            'instagram_url'=> 'nullable|url|max:255',
            'logo'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'cover_image'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('logos', 'public');
        }
        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')->store('brand-covers', 'public');
        }

        // Resubmission resets status to pending
        if ($brand->status === 'rejected') {
            $validated['status'] = 'pending';
            $validated['rejection_reason'] = null;
        }

        $brand->update($validated);

        return redirect()->route('brand-owner.dashboard')
            ->with('success', 'Brand profile updated successfully.');
    }
}
