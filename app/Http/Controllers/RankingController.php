<?php

namespace App\Http\Controllers;

use App\Post;

class RankingController extends Controller
{
    public function index()
    {
        $rankingPosts = Post::with(['user', 'likes', 'replies']) // 必要な関連も読み込み
            ->withCount('likes')
            ->orderBy('likes_count', 'desc')
            ->take(5)
            ->get();
    
        return view('posts.ranking', compact('rankingPosts'));
    }
}
