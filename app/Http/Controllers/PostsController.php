<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Http\Requests\PostRequest;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(10);

        return view('welcome', [
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

    // 投稿編集画面
    public function edit($id)
    {
        $user = \Auth::user();
        $post = Post::findOrFail($id);
        // 投稿者以外であればエラーを出す
        if($user->id !== $post->user_id){
            abort(403);
        }
        $data = [
            'post' => $post,
        ];
        return view('posts.edit', $data);
    }

    // 投稿更新
    public function update(PostRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->content = $request->content;
        $post->save();
        return redirect("/");
    }
}
