<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function show($id)
    {
        $user = User::findOrFail($id);
        $posts = $user->post()->orderBy('id', 'desc')->paginate(10);
        $data=[
            'user' => $user,
            'posts' => $postss,
        ];
        return view('users.show',$data);
    }
}
