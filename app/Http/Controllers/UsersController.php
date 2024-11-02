<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function show($id)
    {
        $user = User::findOrFail($id);
        $posts = $user->posts()->orderBy('id', 'desc')->paginate(10);
        $data = [
            'user' => $user,
            'posts' => $posts,
        ];
        return view('users.show',$data);
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->posts()->delete();
        $user->delete();
        Auth::logout();
        return redirect()->route('post.index');
    }
}
