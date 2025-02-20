<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function index($id)
    {
        $post = Post::findOrFail($id);
        $comments = $post->comments()->orderBy('created_at', 'desc')->paginate(10);

        return view('posts.comment', compact('post', 'comments'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string|max:140',
            'parent_id' => 'nullable|exists:comments,id',
        ]);

        $comment = new Comment();
        $comment->post_id = $id;
        $comment->user_id = auth()->id();
        $comment->content = $request->content;
        $comment->parent_id = $request->parent_id; // parent_id を設定
        $comment->save();

        return redirect()->route('posts.comment', $id)->with('status', 'コメントを投稿しました！');
    }

    public function edit($commentId)
    {
        $comment = Comment::findOrFail($commentId);
        return view('posts.commentEdit', compact('comment'));
    }

    public function update(Request $request, $commentId)
    {
        $request->validate([
            'content' => 'required|string|max:140',
            'parent_id' => 'nullable|exists:comments,id',
        ]);

        $comment = Comment::findOrFail($commentId);

        if ($comment->user_id === \Auth::id()) {
            $comment->content = $request->content;
            $comment->save();
            return redirect()->route('posts.comment', $comment->post_id)->with('status', '更新に成功しました✅');
        }

        return back()->with('status', '権限がありません🙅');
    }

    public function destroy($commentId)
    {
        $comment = Comment::findOrFail($commentId);
    
        if ($comment->user_id === \Auth::id() || $comment->post->user_id === \Auth::id()) {
            // 再帰的に返信を削除
            $this->deleteReplies($comment);
            return back()->with('status', 'コメントを削除しました！');
        }
        return back()->with('error', '権限がありません');
    }
    
    private function deleteReplies($comment)//コメントとすべての子コメントを削除
    {
        foreach ($comment->replies as $reply) {
            $this->deleteReplies($reply);
        }
        $comment->delete(); 
    }

    public function notice()//ユーザー自身に対するコメントや返信を表示
    {
        $user = \Auth::user();

        $comments = Comment::where(function ($query) use ($user) {
            // 自分の投稿に対するコメント
            $query->whereHas('post', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            });
        
            // または、自分のコメントに対する返信
            $query->orWhereHas('parent', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            });
        })
        ->where('user_id', '!=', $user->id) // 自分のコメントは除外
        ->latest()
        ->paginate(10);
        
        return view('users.notice', compact('user', 'comments'));
    }

}
