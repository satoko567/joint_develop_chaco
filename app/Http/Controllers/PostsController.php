<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Http\Requests\PostRequest;

class PostsController extends Controller
{
<<<<<<< HEAD
     public function index()
    {
        return view('welcome');
=======
    public function index()
    { 
        $posts = Post::orderBy('id','desc')->paginate(10);
        
        return view ('welcome', [
            'posts' => $posts,
        ]);
    }

    public function store(PostRequest $request)
    {
         $post = new Post;
         $post->content = $request->content;
         $post->user_id = $request->user()->id;
         $post->save();

         return back();
>>>>>>> 033ef9969393d5da162235cb35fb20816f4d2ad3
    }
}
