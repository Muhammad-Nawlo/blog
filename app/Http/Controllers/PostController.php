<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        return view('posts.index', data: [
            'posts' => Post::query()->latest()
                ->with('category', 'author','comments')
                ->filter(request()->only(['author', 'category', 'search']))
                ->paginate(10)->withQueryString(),
        ]);

    }

    public function show(Post $post)
    {
        return view('posts.show', data: [
            'post' => $post,
        ]);

    }
}
