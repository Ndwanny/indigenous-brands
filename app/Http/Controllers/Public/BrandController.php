<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::forBrands()->withCount(['brands' => fn($q) => $q->approved()])->get();

        $query = Brand::approved()->with('category');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $brands = $query->latest()->paginate(9)->withQueryString();

        return view('public.brands.index', compact('brands', 'categories'));
    }

    public function show($slug)
    {
        $brand = Brand::approved()
            ->where('slug', $slug)
            ->with(['category', 'user', 'posts' => fn($q) => $q->published()->latest('published_at')->take(6)])
            ->firstOrFail();

        return view('public.brands.show', compact('brand'));
    }
}
