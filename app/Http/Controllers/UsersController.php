<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
<<<<<<< HEAD

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

	    return view('users.show', $data);
    } 
}
=======
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    //ユーザ詳細(なりさんご担当)


    // 編集画面
    public function edit($id)
    {
        $user = User::findOrFail($id);
        if (Auth::id() != $id) {
            abort(403);
        }
        return view('users.edit', ['user' => $user]);
    }

    // 更新処理
    public function update(UserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect('/');
        // ユーザ詳細がマージされ次第、return redirect('/');の部分を下記コードに変更
        // return redirect()->route('user.show', $user->id);
    }

    // 退会処理
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if (Auth::id() != $id) {
            abort(403);
        }
        $user->posts()->delete();
        $user->delete();
        return redirect('/');
    }
}
>>>>>>> 033ef9969393d5da162235cb35fb20816f4d2ad3
