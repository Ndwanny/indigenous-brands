<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::with(['user', 'brand', 'category']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $posts = $query->latest()->paginate(15)->withQueryString();
        return view('admin.posts.index', compact('posts'));
    }

    public function updateStatus(Request $request, Post $post)
    {
        $request->validate(['status' => 'required|in:draft,published,archived']);
        $data = ['status' => $request->status];
        if ($request->status === 'published' && !$post->published_at) {
            $data['published_at'] = now();
        }
        $post->update($data);
        return back()->with('success', 'Post status updated.');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return back()->with('success', 'Post deleted.');
    }
}
