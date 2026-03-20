<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::published()->with(['brand', 'category', 'tags'])->latest('published_at');

        if ($request->filled('category')) {
            $query->byCategory($request->category);
        }

        if ($request->filled('tag')) {
            $query->byTag($request->tag);
        }

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $posts = $query->paginate(6)->withQueryString();
        $categories = Category::forBlog()->withCount(['posts' => fn($q) => $q->published()])->get();
        $recentPosts = Post::published()->latest('published_at')->take(3)->get();
        $tags = Tag::has('posts')->get();

        return view('public.blog.index', compact('posts', 'categories', 'recentPosts', 'tags'));
    }

    public function show($slug)
    {
        $post = Post::published()
            ->where('slug', $slug)
            ->with(['brand', 'category', 'tags', 'user'])
            ->firstOrFail();

        $comments = $post->approvedComments()->get();
        $categories = Category::forBlog()->withCount(['posts' => fn($q) => $q->published()])->get();
        $recentPosts = Post::published()->where('id', '!=', $post->id)->latest('published_at')->take(3)->get();
        $tags = Tag::has('posts')->get();

        return view('public.blog.show', compact('post', 'comments', 'categories', 'recentPosts', 'tags'));
    }

    public function storeComment(Request $request, $slug)
    {
        $post = Post::published()->where('slug', $slug)->firstOrFail();

        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|max:255',
            'website'   => 'nullable|url|max:255',
            'body'      => 'required|string',
            'parent_id' => 'nullable|exists:comments,id',
        ]);

        $post->comments()->create([
            ...$validated,
            'user_id'     => auth()->id(),
            'is_approved' => false,
        ]);

        return back()->with('success', 'Your comment has been submitted and is pending moderation.');
    }
}
