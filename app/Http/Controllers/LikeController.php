<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Like;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
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

        // 自分の投稿にはいいねできない
        if (Auth::id() === $post->user_id) {
            return back()->with('error', '自分の投稿にはいいねできません。');
        }

        return back();
    }
}