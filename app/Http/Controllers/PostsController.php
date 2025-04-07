<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Post;
use App\PostImage;
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
        $post = Post::create([
            'user_id' => auth()->id(),
            'content' => $request->validated()['content'],
        ]);

        if($request->hasFile('images')){
            foreach($request->file('images') as $image){
                $path = $image->store('images', 'public');

                PostImage::create([
                    'post_id' => $post->id,
                    'image_path' => $path,
                ]);
            }
        }

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

    // 投稿検索処理
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
    
        $query = Post::with('user');
    
        if (!empty($keyword)) {
            $query->where(function ($q) use ($keyword) {
                $q->where('content', 'like', '%' . $keyword . '%')
                  ->orWhereHas('user', function ($q2) use ($keyword) {
                      $q2->where('name', 'like', '%' . $keyword . '%');
                  });
            });
        }
    
        $posts = $query->orderBy('created_at', 'desc')->paginate(10)->appends(['keyword' => $keyword]);

    
        return view('posts.search', compact('posts', 'keyword'));
    }
}