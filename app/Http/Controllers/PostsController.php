<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('id','desc')->paginate(10);
        return view('welcome' , [
            'posts' => $posts,
        ]);
    }

    // 投稿新規処理
    public function store(PostRequest $request)
    {
        $imagePath = null;
        if($request->hasFile('image')){
            $imagePath = $request->file('image')->store('images', 'public');
        }

        Post::create([
            'user_id' => auth()->id(),
            'content' => $request->validated()['content'],
            'image_path' => $imagePath,
        ]);

        return redirect('/');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if (auth()->id() === $post->user_id) {
            $post->delete();
        }

        return back();
    }
}