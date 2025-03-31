<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\User;
use App\Post;

class PostsController extends Controller
{
    // ユーザとその投稿一覧を表示するメソッド
    public function index()
    {
        return view('posts.index');
    }
}