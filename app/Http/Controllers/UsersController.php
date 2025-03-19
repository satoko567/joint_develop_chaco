<?php

namespace App\Http\Controllers;

use App\User;
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

    // ユーザ情報編集フォームを表示
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    // ユーザ情報を更新
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // バリデーション → パスワード必須
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed', 
        ]);

        // 入力値を保存
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));

        $user->save();

        // 更新後、ユーザ詳細ページへリダイレクト
        return redirect()->route('user.show', ['id' => $user->id]);
    }

    // ユーザを削除（退会処理）
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect('/')->with('success', '退会処理が完了しました。');
    }
}

