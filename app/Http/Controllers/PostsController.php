<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    // 投稿画面表示
    public function create()
    {
        return view('welcome');
    }

    // 投稿新規処理
    public function store(StorePostRequest $request)
    {
        Post::create([
            'user_id' => auth()->id(),
            'content' => $request->validated()['content'],
        ]);

        return redirect('/posts');
    }
}