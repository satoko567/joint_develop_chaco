<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Post;

class PostsController extends Controller
{
    //投稿編集画面表示 + 検索機能
    public function showPosts(Request $request)
    {
        $keyword = $request->input('keyword');
        $query = Post::with('user');

        if (!empty($keyword)) {
            $query->where(function ($q) use ($keyword) {
                $q->where('content', 'like', '%' . $keyword . '%')
                    ->orWhereHas('user', function ($q2) use ($keyword) {
                        $q2->where('name', 'like', '%' . $keyword . '%');
                    });
            });
        }

        $posts = $query->orderBy('created_at', 'desc')->paginate(10);
        $users = User::all();

        return view('admin.posts', compact('posts', 'users', 'keyword'));
    }

    //投稿削除
    public function destroyPost($id)
    {
        $post = Post::with('replies')->findOrFail($id);

        $post->replies()->delete();
        $post->delete();

        return back();
    }
}
