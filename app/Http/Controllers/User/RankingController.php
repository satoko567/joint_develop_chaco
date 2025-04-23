<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;

use App\Post;

class RankingController extends Controller
{
    public function index()
    {
        $rankingPosts = Post::with(['user', 'likes', 'replies']) // 必要な関連も読み込み
            ->withCount('likes')
            ->having('likes_count', '>', 0)
            ->orderBy('likes_count', 'desc')
            ->get();
    
        return view('posts.ranking', compact('rankingPosts'));
    }
}
