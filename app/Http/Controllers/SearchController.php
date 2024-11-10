<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        if ($keyword) {
            $posts = Post::where('content', 'like', '%' . $keyword . '%')
                    ->orderBy('id', 'desc')
                    ->paginate(10);
            $users = User::where('name', 'like', '%' . $keyword . '%')
                    ->with('posts')
                    ->with(['posts' => function ($query) {
                        $query->latest();
                    }])
                    ->paginate(10);
        } else {
            $posts = Post::orderBy('id', 'desc')->paginate(10);
            $users = collect();
        }

        return view('welcome', [
            'posts' => $posts,
            'users' => $users,
            'keyword' => $keyword,
        ]);
    }
}