<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Like;
use Illuminate\Support\Facades\Storage;
use App\Reply;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(10);
        $latestReplies = Reply::with('user', 'post')->latest()->take(20)->get();

        return view('welcome', [
            'posts' => $posts,
            'latestReplies' => $latestReplies,
        ]);
    }

    // 投稿新規処理
    public function store(PostRequest $request)
    {
        $imagePath = null;

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        Post::create([
            'user_id' => auth()->id(),
            'content' => $request->validated()['content'],
            'image_path' => $imagePath,
        ]);

        return redirect('/');
    }

    // 投稿削除処理
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if (auth()->id() === $post->user_id) {
            if ($post->image_path) {
                Storage::delete('public/' . $post->image_path);
            }

            $post->delete();
        }

        return back();
    }

    // 投稿編集画面
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        if (Auth::id() != $post->user_id) {
            abort(403, 'このページへのアクセス権限がありません');
        }

        return view('posts.edit', compact('post'));
    }

    // 投稿編集処理
    public function update(PostRequest $request, $id)
    {
        $post = Post::findOrFail($id);

        if (auth()->id() !== $post->user_id) {
            abort(403, 'Unauthorized');
        }

        $post->content = $request->content;

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            if ($post->image_path) {
                Storage::delete('public/' . $post->image_path);
            }

            $post->image_path = $request->file('image')->store('images', 'public');
        }

        $post->save();

        return redirect('/')->with('status', '投稿を更新しました。');
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

    // いいね
    public function like($id)
    {
        $post = Post::findOrFail($id);
        $user = Auth::user();

        // すでにいいねしていたら削除（トグル処理）
        $existingLike = Like::where('post_id', $post->id)->where('user_id', $user->id)->first();
        if ($existingLike) {
            $existingLike->delete();
        } else {
            Like::create([
                'post_id' => $post->id,
                'user_id' => $user->id,
            ]);
        }
    }
}
