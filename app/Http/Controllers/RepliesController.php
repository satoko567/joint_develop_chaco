<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReplyRequest;
use Illuminate\Http\Request;
use App\Post;
use App\Reply;

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

    // リプライ投稿
    public function store(ReplyRequest $request, $post_id)
    {
         // リプライを保存
         $reply = new Reply();
         $reply->user_id = auth()->id();
         $reply->post_id = $post_id;
         $reply->content = $request->content;
         $reply->save();
 
         // リプライ数をカウント
         $replyCount = $reply->post->replies->count();
 
         // JSONで返信数を返す
         return response()->json([
             'status' => true,
             'reply_count' => $replyCount,
         ], 200);
    }
}
