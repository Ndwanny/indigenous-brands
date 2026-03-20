<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        $query = Brand::with(['user', 'category']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $brands = $query->latest()->paginate(15)->withQueryString();

        return view('admin.brands.index', compact('brands'));
    }

    public function show(Brand $brand)
    {
        $brand->load(['user', 'category', 'posts']);
        return view('admin.brands.show', compact('brand'));
    }

    public function approve(Brand $brand)
    {
        $brand->update(['status' => 'approved', 'rejection_reason' => null]);
        return back()->with('success', "Brand \"{$brand->name}\" has been approved.");
    }

    public function reject(Request $request, Brand $brand)
    {
        $request->validate(['rejection_reason' => 'required|string']);
        $brand->update(['status' => 'rejected', 'rejection_reason' => $request->rejection_reason]);
        return back()->with('success', "Brand \"{$brand->name}\" has been rejected.");
    }

    public function toggleFeatured(Brand $brand)
    {
        $brand->update(['is_featured' => !$brand->is_featured]);
        $status = $brand->is_featured ? 'featured' : 'unfeatured';
        return back()->with('success', "Brand \"{$brand->name}\" has been {$status}.");
    }
}
