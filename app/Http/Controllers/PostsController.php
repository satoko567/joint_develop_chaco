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
        $posts = Post::orderBy('id','desc')->paginate(10);

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
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $data=[
            'post' => $post,
        ];
        return view('posts.edit', $data);
    }
    public function update(PostRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->content = $request->content;
        $post->user_id = $request->user()->id;
        $post->save();
        return redirect("/");
    }
}