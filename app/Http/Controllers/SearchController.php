<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;

class SearchController extends Controller
{
    public function search(Request $request)
    {
          $search = $request->input('search', '');

            $posts = Post::where('content', 'LIKE', '%' .$search . '%')->orderBy('id', 'desc')->paginate(10);
        
                $data = [
                    'posts' => $posts,
                    'search' => $search,
                ];

        return view('welcome', $data);
    }
}