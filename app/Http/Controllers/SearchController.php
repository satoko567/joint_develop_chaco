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

        $posts = Post::withCount('comments')->orderBy('id', 'desc');
        $users = User::withCount('comments')->orderBy('id', 'desc');

        if ($keyword !== null) {
            $posts->where('content', 'like', '%' . $keyword . '%');
            $users->where('name', 'like', '%' . $keyword . '%');
        }

        $posts = $posts->paginate(10)->appends(['keyword' => $keyword]);
        $users = $users->paginate(10)->appends(['keyword' => $keyword]);

        return view('welcome', [
            'posts' => $posts,
            'users' => $users,
            'keyword' => $keyword,
        ]);
    }
}