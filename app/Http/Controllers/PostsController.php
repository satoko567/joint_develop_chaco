<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostEditRequest;
use App\Post;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(10);
        return view('welcome', compact('posts'));
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);

        if(\Auth::id() === $post->user_id){
            return view('posts.edit', compact('post'));
        }
        
        return back()->with('権限がありません🙅');
    }

    public function update(PostEditRequest $request, $id)
    {
        $post = Post::findOrFail($id);

        if(\Auth::id() === $post->user_id){
            $post->content = $request->content;
            $post->save();
            return redirect()->route('home')->with('更新に成功しました✅');
        }

        return back()->with('権限がありません🙅');
    }

    // 投稿削除
    public function destroy(Post $post)
    {
        // 投稿が存在し、ユーザーがその投稿を所有しているかを確認
        if ($post->user_id !== auth()->id()) {
            // 権限がない場合はエラーメッセージを返す
            return redirect()->route('posts.post')->with('error', 'この投稿を削除する権限がありません');
        }

        // 投稿削除
        $post->delete();

        // 削除後、投稿一覧ページへリダイレクト
        return redirect()->route('posts.post')->with('success', '投稿が削除されました');
    }
}