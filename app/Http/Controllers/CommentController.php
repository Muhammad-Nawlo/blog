<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate(['body' => 'required|min:3|max:255']);
        Comment::query()->create([
            'body' => $request->input('body'),
            'post_id' => $post->id,
            'user_id' => $request->user()->id
        ]);
        return back()->with('success', 'Your comment was added successfully');
    }
}
