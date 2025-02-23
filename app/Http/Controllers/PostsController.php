<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostEditRequest;
use Illuminate\Http\Request;
use App\Post;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(10);
        return view('welcome', compact('posts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'nullable|string|max:140', // テキストは任意、140文字以内
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 画像アップロード制限
        ]);
    
        $post = new Post();
        $post->content = $request->input('content');
        $post->user_id = $request->user()->id;
        // 画像がアップロードされた場合
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads', 'public'); // storage/app/public/uploads に保存
            $post->image = $imagePath;
        }
        $post->save();
    
        return redirect('/')->with('status', '投稿が完了しました！');
    }
    
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        if (\Auth::id() === $post->user_id) {
            return view('posts.edit', compact('post'));
        }

        return back()->with('status', '権限がありません🙅');
    }

    public function update(PostEditRequest $request, $id)
    {
        $post = Post::findOrFail($id);

        if (\Auth::id() === $post->user_id) {
            $post->content = $request->content;
            $post->save();
            return redirect()->route('home')->with('status', '更新に成功しました✅');
        }

        return back()->with('status', '権限がありません🙅');
    }

    // 投稿削除
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        if ($post->user_id !== auth()->id()) {
            // 権限がない場合はエラーメッセージを返す
            return redirect()->route('home')->with('error', 'この投稿を削除する権限がありません');
        }

        // 投稿削除
        $post->delete();
        $post->allComments()->delete();

        // 削除後、投稿一覧ページへリダイレクト
        return redirect()->route('home')->with('status', '投稿が削除されました');
    }
}
