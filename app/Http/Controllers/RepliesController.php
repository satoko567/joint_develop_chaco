<?php

namespace App\Http\Controllers;

use App\Post;

class RepliesController extends Controller
{
    public function index(Post $post)
    {
        $replies = $post->replies()->with('user')->latest()->get();
        return view('replies.replies_for_post', compact('post', 'replies'));
    }
}
