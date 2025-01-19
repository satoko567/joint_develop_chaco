<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostRequest;

use Illuminate\Http\Request;
use App\Post; 

class PostController extends Controller
{
    public function index()
    {
        //投稿を新規順に取得
        $posts = Post::with('user')->latest()->paginate(10);
        return view('welcome', ['posts' => $posts,]);
    }

    public function edit($id)
    {
        //現在の認証済みユーザーの取得
        $user = Auth::user();
        $post = Post::findOrFail($id);

        return view('posts.edit',compact('post'));
    }

    public function update(PostRequest $request, $id)
    {
            $post = Post::findOrFail($id);
            $post->content = $request->content;
            $post->user_id = $request->user()->id;
            $post->save();
    
            return redirect()->route('post.list');
        
    }


}
