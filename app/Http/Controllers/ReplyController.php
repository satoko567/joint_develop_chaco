<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Reply;
use App\Post;

class ReplyController extends Controller
{
    // 返信画面
    public function reply($id)
    {
        $post = Post::findOrFail($id);
        $replies = Reply::orderBy('id', 'desc')->where('post_id', $post->id)->paginate(10);
        $user = \Auth::user();
        $data = [
            'post' => $post,
            'replies' => $replies,
        ];
        return view('replies.reply' , $data);
    }
    
    // 返信機能
    public function store(PostRequest $request, $id)
    {
        $user = \Auth::user();
        $post = Post::findOrFail($id);
        $reply = new Reply();
        $reply->user_id = $request->user()->id;
        $reply->post_id = $post->id;
        $reply->reply = $request->content;
        $reply->save();
        return back();
    }

    // 返信編集画面
    public function edit($id)
    {
        $user = \Auth::user();
        $reply = Reply::findOrFail($id);
        // 投稿者以外であればエラーを出す   
        if($user->id !== $reply->user_id){
            abort(403);
        }
        return view('replies.edit', [
            'reply' => $reply,
        ]);
    }

    // 返信編集更新
    public function update(PostRequest $request, $id)
    {
        $user = \Auth::user();
        $reply = Reply::findOrFail($id);
        $reply->reply = $request->content;
        $reply->save();
        return redirect(route('post.reply', [
            'id' => $reply->post_id,
        ]));
    }

    // 返信削除
    public function destroy($id)
    {
        $reply = Reply::findOrFail($id);
        if (\Auth::id() === $reply->user_id) {
            $reply->delete();
        }
        return back();
    }
}
