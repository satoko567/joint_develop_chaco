<?php

namespace App\Http\Controllers;

use App\Post;
use App\Reply;
use Illuminate\Http\Request;

class RepliesController extends Controller
{
    public function index(Post $post)
    {
        $replies = $post->replies()->with('user')->latest()->paginate(10);
        return view('replies.replies_for_post', compact('post', 'replies'));
    }

    public function store(Request $request, Post $post)
    {
        // バリデーション
        $request->validate([
            'content' => 'required|string|max:255',
        ]);

        // リプライ作成
        Reply::create([
            'post_id' => $post->id,
            'user_id' => auth()->id(),
            'content' => $request->input('content'),
        ]);

        // 元のページにリダイレクト
        return redirect()->route('replies.index', $post->id);
    }
}
