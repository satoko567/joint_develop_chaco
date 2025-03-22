<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\UserUpdateRequest; //修正
use Illuminate\Support\Facades\Auth; // エラーの為追加
use Illuminate\Http\Request;

class UsersController extends Controller
{
    // ユーザ詳細表示
    public function show($id)
    {
        $user = User::findOrFail($id);
        $posts = $user->posts()->orderBy('id', 'desc')->paginate(6);
        return view('users.detail', compact('user', 'posts'));
    }

    // 編集フォーム表示
    public function edit($id)
{
    // 自分以外エラー
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

        // 入力値を保存
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));

        $user->save();

        // 更新後詳細ページ
        return redirect()->route('user.show', ['id' => $user->id]);
    }
}
