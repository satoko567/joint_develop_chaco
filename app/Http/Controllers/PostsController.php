<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Gravatar;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(10);
        dd($posts);
        return view('welcome', compact('posts'));
    }

}