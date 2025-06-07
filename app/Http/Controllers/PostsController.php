<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;
use App\Post;
use App\User;

class PostsController extends Controller
{   
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $posts = Post::query(); 

        if ($keyword) {
            $posts->where('content', 'LIKE', "%{$keyword}%");
        }

        $posts = $posts->paginate(10);

        return view('welcome', compact('posts', 'keyword'));
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
        return redirect()->route('posts.index')->with('success', '更新が完了しました！');
    }

    public function store(PostRequest $request)
    {
        $post = new Post;
        $post->content = $request->content;
        $post->user_id = $request->user()->id;
        $post->save();
        return redirect()->route('posts.index')->with('success', '投稿が完了しました！');
    }
}