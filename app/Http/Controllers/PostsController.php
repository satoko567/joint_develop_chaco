<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Http\Requests\PostRequest;

class PostsController extends Controller
{
    public function index()
    { 
        $posts = Post::orderBy('id','desc')->paginate(10);
        
        return view ('welcome', [
            'posts' => $posts,
        ]);
    }

    public function store(PostRequest $request)
    {
         $post = new Post;
         $post->content = $request->content;
         $post->user_id = $request->user()->id;
         $post->save();

         return back();
    }

    
    public function show($id)
    {
        $user = User::findOrFail($id);

        // 投稿をユーザー情報込みで取得（ページネーション付き）
        $posts = $user->posts()->with('user')->orderBy('created_at', 'desc')->paginate(10);

        return view('users.show', compact('user', 'posts'));
    }

}
