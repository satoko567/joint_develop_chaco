<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    // 対象のユーザ情報とそのユーザが所有している投稿情報を取得し、
    // ユーザ詳細画面を表示
    public function show($id)
    {
        $user = User::findOrFail($id);
        $posts = $user->posts()->latest()->paginate(10);

        $data = [
            'user' => $user,
            'posts' => $posts,
        ];

        return view('users.show', $data);
    }
}
