<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

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

    // 投稿編集画面
    public function edit($id)
    {
        $post = Post::findOrFail($id); //投稿を取得（見つからなければ404エラー）
        
        if (Auth::id() != $post->user_id) {
            abort(403, 'このページへのアクセス権限がありません');
        }

        return view('posts.edit', compact('post'));
    }

    //投稿更新処理
    public function update(PostRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->content = $request->content;
        $post->save(); // 投稿を取得して更新

        return redirect('/'); //トップページにリダイレクト
    }
}