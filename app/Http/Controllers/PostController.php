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
    }

    // 投稿の編集ページ表示
    public function edit(Post $post)
    {
        
    }
}
