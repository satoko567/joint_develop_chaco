<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Reply;
use App\Post;

class RepliesController extends Controller
{
    public function store(Request $request, $postId)
    {
        $request->validate([
            'content' => 'required|max:140',
        ]);

        $post = Post::findOrFail($postId);

        // 自分の投稿にはリプライできないようにする
        if ($post->user_id === Auth::id()) {
            return redirect()->route('post.show', $postId)
                ->with('error', '自分の投稿にはリプライできません。');
        }

        $reply = new Reply();
        $reply->post_id = $postId;
        $reply->user_id = Auth::id();
        $reply->content = $request->content;
        $reply->save();

        return redirect()->route('post.show', $postId)
            ->with('success', 'リプライを投稿しました！');
    }

    public function edit($postId, Reply $reply)
    {
        return view('replies.edit', compact('reply', 'postId'));
    }
    
    public function update(Request $request, $postId, Reply $reply)
    {       
        $request->validate([
            'content' => 'required|max:140',
        ]);

        $reply->content = $request->content;
        $reply->save();

        return redirect()->route('post.show', $postId)->with('success', 'リプライを更新しました！');
    }

    public function destroy($postId, Reply $reply)
    {
        $reply->delete();

        return redirect()->route('post.show', $postId)->with('success', 'リプライを削除しました。');
    }

}
