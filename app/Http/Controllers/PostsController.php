<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;
use App\User;
use App\Post;


class PostsController extends Controller
{   
    public function index()
    {       
        return view('welcome');
    }

    public function show($id)
    {
    
        $user = User::findOrFail($id);
        // $posts = $user->posts()->orderBy('id', 'desc')->paginate(10);
        $data = [
            'user' => $user,
            // 'posts' => $posts,
        ];

        return view('users.show',$data);
    }    
   
    public function edit($id)
    {  
        $user = Auth::user();
        $post = Post::findOrFail($id); 

        if (Auth::id() != $post->user_id) {
            abort(403);
        }

        $data = [            
            'post' => $post,
        ];
        return view('posts.edit', $data);
    }

    public function update(PostRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->content = $request->content;
        $post->user_id = $request->user()->id;
        $post->save();
        return redirect("/");
    }
}
