<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Post;
use App\PostImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Like;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(10);
        return view('welcome', [
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

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
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

    // 投稿更新処理
    public function update(PostRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->content = $request->content;
        $post->save(); // 投稿を取得して更新

        // 画像削除
        if ($request->filled('delete_images')) {
            $imageIds = $request->delete_images;

            $images = PostImage::where('post_id', $post->id)->whereIn('id', $imageIds)->get();

            foreach ($images as $image) {
                Storage::delete('public/' . $image->image_path);
                $image->delete();
            }
        }

        // 画像変更
        $uploadedImages = $request->file('images', []);

        if (!empty($uploadedImages)) {
            $imageIds = array_keys($uploadedImages);

            $images = PostImage::where('post_id', $post->id)
                ->whereIn('id', $imageIds)
                ->get()
                ->keyBy('id');

            foreach ($uploadedImages as $imageId => $file) {
                if ($file && $file->isValid() && isset($images[$imageId])) {
                    $image = $images[$imageId];

                    Storage::delete('public/' . $image->image_path);
                    $image->image_path = $file->store('images', 'public');
                    $image->save();
                }
            }
        }

        // 画像追加
        $newFiles = $request->file('new_images', []);

        $validNewFiles = array_filter($newFiles, fn($file) => $file && $file->isValid());

        $insertData = [];

        foreach ($validNewFiles as $file) {
            $path = $file->store('images', 'public');
            $insertData[] = [
                'post_id' => $post->id,
                'image_path' => $path,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        if (!empty($insertData)) {
            PostImage::insert($insertData);
        }

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
