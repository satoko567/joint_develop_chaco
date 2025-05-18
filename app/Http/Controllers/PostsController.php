<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Http\Requests\PostRequest;


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

    public function store(PostRequest $request)
    {
        $post = new Post;       
        $post->title = $request->title;
        $post->user_id = $request->user()->id;
        $post->save();
        return back();
    }

}