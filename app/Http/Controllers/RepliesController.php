<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReplyRequest;
use Illuminate\Support\Facades\Auth;
use App\Reply;
use App\Post;

class RepliesController extends Controller
{
    // リプライ作成
    public function store(ReplyRequest $request, $postId)
    {
        $post = Post::findOrFail($postId);
        $reply = new Reply();
        $reply->content = $request->reply_body;
        $reply->user_id = Auth::id();
        $reply->post_id = $post->id;
        $reply->save();
        return redirect()->route('posts.show', $post);
    }

    // 編集画面
    public function edit($postId, $replyId)
    {
        $post = Post::findOrFail($postId);
        $reply = Reply::findOrFail($replyId);
        if (Auth::id() !== $reply->user_id) {
            abort(403);
        }
        $data = [
            'reply' => $reply,
            'post' => $post,
        ];
        return view('replies.edit', $data);
    }

    // 更新処理
    public function update(ReplyRequest $request, $postId, $replyId)
    {
        $post = Post::findOrFail($postId);
        $reply = Reply::findOrFail($replyId);
        if (Auth::id() !== $reply->user_id) {
            abort(403);
        }
        $reply->content = $request->reply_body;
        $reply->save();
        return redirect()->route('posts.show', $post);
    }

    // 削除処理
    public function destroy($replyId)
    {
        $reply = Reply::findOrFail($replyId);
        if (Auth::id() !== $reply->user_id) {
            abort(403);
        }
        $reply->delete();
        return back();
    }
}