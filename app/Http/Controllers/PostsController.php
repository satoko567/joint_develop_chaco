<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post; // 追記

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('id','desc')->paginate(10);
        return view('welcome' , [
            'posts' => $posts,
        ]);
    }
}
