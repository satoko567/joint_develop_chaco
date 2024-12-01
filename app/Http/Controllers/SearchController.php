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
          $tab = $request->input('tab', 'posts');

          $users = null;
          $posts = null;
          if ($tab === 'posts'){
            $posts = Post::where('content', 'LIKE', '%' .$search . '%')->paginate(10);
            } else {
            $users = User::Where('name', 'LIKE', '%' .$search . '%')->paginate(10);
            }
        
                $data = [
                    'posts' => $posts,
                    'users' => $users,
                    'search' => $search,
                    'tab' => $tab,
                ];

        
        return view('posts.index', $data);
    }
}