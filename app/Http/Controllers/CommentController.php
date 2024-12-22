<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'body' => 'required|string|max:140',
        ]);

        $comment = new Comment();
        $comment->body = $request->body;
        $comment->user_id = auth()->id();
        $comment->post_id = $post->id;
        $comment->save();

        return redirect()->route('post.show', $post->id);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'body' => 'required|string|max:140',
        ]);

        $comment = Comment::findOrFail($id);
        $comment->body = $request->body;
        $comment->save();
        session()->flash('flash-message', 'コメントを編集しました。');
        return back();
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        if (\Auth::id() === $comment->user_id) {
            $comment->delete();
        }
        session()->flash('flash-message', 'コメント削除しました。');
        return back();
    }
}
