<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Post; 

class PostController extends Controller
{
    public function index()
    {
        //投稿を新規順に取得
        $posts = Post::with('user')->latest()->paginate(10);
        return view('welcome', ['posts' => $posts,]);
    }


}
