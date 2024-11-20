<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('id','desc')->paginate(10);

        return view('welcome', [
            'posts' => $posts,
        ]);
    }

    public function search(Request $request)
    {
        $query = Post::query();

        if ($request->has('search'))
        { $search = $request->input('search');
            $query->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('content', 'LIKE', "%{$search}%");
        }
        
        $posts = $query->get();
        $posts = $query->paginate(10);
        
        return view('posts.index', compact('posts'));
    }
}