<?php

namespace App\Http\Controllers\BrandOwner;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = auth()->user()->brand->posts()->with('category')->latest()->paginate(10);
        return view('brand-owner.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::forBlog()->get();
        $tags = Tag::all();
        return view('brand-owner.posts.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'           => 'required|string|max:255',
            'excerpt'         => 'nullable|string',
            'body'            => 'required|string',
            'category_id'     => 'nullable|exists:categories,id',
            'status'          => 'required|in:draft,published',
            'featured_image'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'tags'            => 'nullable|array',
            'tags.*'          => 'string',
        ]);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('post-images', 'public');
        }

        $validated['slug'] = Str::slug($validated['title']);
        $validated['published_at'] = $validated['status'] === 'published' ? now() : null;
        $validated['brand_id'] = auth()->user()->brand->id;

        $post = auth()->user()->posts()->create($validated);

        if (!empty($validated['tags'])) {
            $tagIds = collect($validated['tags'])->map(function ($tagName) {
                return Tag::firstOrCreate(
                    ['slug' => Str::slug($tagName)],
                    ['name' => $tagName]
                )->id;
            });
            $post->tags()->sync($tagIds);
        }

        return redirect()->route('brand-owner.posts.index')
            ->with('success', 'Post ' . ($validated['status'] === 'published' ? 'published' : 'saved as draft') . ' successfully.');
    }

    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        $categories = Category::forBlog()->get();
        $tags = Tag::all();
        $selectedTags = $post->tags->pluck('name')->toArray();
        return view('brand-owner.posts.edit', compact('post', 'categories', 'tags', 'selectedTags'));
    }

    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $validated = $request->validate([
            'title'           => 'required|string|max:255',
            'excerpt'         => 'nullable|string',
            'body'            => 'required|string',
            'category_id'     => 'nullable|exists:categories,id',
            'status'          => 'required|in:draft,published,archived',
            'featured_image'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'tags'            => 'nullable|array',
            'tags.*'          => 'string',
        ]);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('post-images', 'public');
        }

        if ($post->status !== 'published' && $validated['status'] === 'published') {
            $validated['published_at'] = now();
        }

        $post->update($validated);

        if (isset($validated['tags'])) {
            $tagIds = collect($validated['tags'])->map(function ($tagName) {
                return Tag::firstOrCreate(
                    ['slug' => Str::slug($tagName)],
                    ['name' => $tagName]
                )->id;
            });
            $post->tags()->sync($tagIds);
        }

        return redirect()->route('brand-owner.posts.index')
            ->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        return back()->with('success', 'Post deleted successfully.');
    }
}
