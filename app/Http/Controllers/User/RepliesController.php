<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Post;
use App\Reply;
use Illuminate\Http\Request;
use App\Http\Requests\ReplyRequest;

class RepliesController extends Controller
{
    public function index(Post $post)
    {
        $replies = $post->replies()->with('user')->latest()->paginate(10);
        return view('replies.replies_for_post', compact('post', 'replies'));
    }

    public function store(ReplyRequest $request, Post $post)
    {
        Reply::create([
            'post_id' => $post->id,
            'user_id' => auth()->id(),
            'content' => $request->input('content'),
        ]);

        return redirect()->route('replies.index', $post->id);
    }
    
    public function edit(Reply $reply)
    {
        if ($reply->user_id !== auth()->id()) {
            abort(403, '許可されていない操作です。');
        }
        return view('replies.edit', compact('reply'));
    }

    public function update(ReplyRequest $request, Reply $reply)
    {
        // 本人以外のリクエストを拒否
        if ($reply->user_id !== auth()->id()) {
            abort(403, '許可されていない操作です。');
        }

        // 更新処理
        $reply->update([
            'content' => $request->input('content'),
        ]);

        // 一覧ページにリダイレクト
        return redirect()->route('replies.index', $reply->post_id);
    }


}
