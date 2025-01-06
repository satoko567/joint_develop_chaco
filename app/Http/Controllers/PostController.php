<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post; 

class PostController extends Controller
{
    public function index()
    {
        //投稿を新規順に取得
        $posts = Post::with('user')->latest()->paginate(10);
        return view('posts.post', compact('posts'));
    }

     // 投稿の削除
    public function destroy(Post $post)
    {
        // 投稿者本人かどうか確認
        if (auth()->user()->id !== $post->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $post->delete();

        return redirect()->route('posts.index')->with('success', '投稿を削除しました。');
    }

    // 投稿の編集ページ表示
    public function edit(Post $post)
    {
        
    }
}
