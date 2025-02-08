<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class RepliesController extends Controller
{
    // リプライ一覧画面表示
    public function index($id)
    {
        $post = Post::findOrFail($id);
        $replies = $post->replies()->orderBy('created_at', 'asc')->paginate(10);
        $data = [
            'post' => $post,
            'replies' => $replies,
        ];

        return view('replies.replies', $data);
    }
}
