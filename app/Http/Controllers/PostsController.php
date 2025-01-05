<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        return view('welcome', compact('posts'));
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
    
        if (\Auth::id() === $post->user_id) {
            $post->delete();
            return back()->with('status', '削除成功👏');
        }
    
        return back()->with('status', '削除権限がありません🙅‍♂️');
    }

}