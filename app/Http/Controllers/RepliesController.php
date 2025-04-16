<?php

namespace App\Http\Controllers;

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

    public function destroy(Reply $reply)
    {
        // 本人チェック
        if ($reply->user_id !== auth()->id()) {
            abort(403, 'このリプライを削除する権限がありません。');
        }

        // 削除実行（SoftDeletes）
        $reply->delete();

        // 一覧ページにリダイレクト + 成功メッセージ
        return redirect()->route('replies.index', $reply->post_id)
                     ->with('success', 'リプライを削除しました。');
    }

}
