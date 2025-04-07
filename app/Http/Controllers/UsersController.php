<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    // ユーザ詳細表示
    public function show($id)
    {
        $user = User::findOrFail($id);
        $posts = $user->posts()->orderBy('id', 'desc')->paginate(6);
        // いいねした投稿をページネーション
        $likedPosts = $user->likes()->orderBy('id', 'desc')->paginate(6);
        return view('users.detail', compact('user', 'posts', 'likedPosts')); // いいね投稿追記
    }

    // 編集フォーム表示
    public function edit($id)
    {
        if (Auth::id() != $id) {
            abort(403, 'このページへのアクセス権限がありません');
        }

        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    // 更新
    public function update(UserUpdateRequest $request, $id) 
    {
        $user = User::findOrFail($id);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));

        $user->save();

        return redirect()->route('user.show', ['id' => $user->id]);
    }

    // 退会
    public function destroy($id, Request $request)
    {
        $user = User::findOrFail($id);
        if(Auth::id() !== $user->id){
            abort(403,'権限がありません。');
        }
        $user->delete();

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
} 
