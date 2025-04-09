<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function show($id)
    {
        $user = User::findOrFail($id);
        $data = [
            'user' => $user,
        ];
        return view('users.show', $data);
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->posts()->delete(); // ユーザの投稿を論理削除
        $user->delete(); // ユーザを論理削除
        return redirect()->route('index');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $data = [
            'user' => $user,
        ];
        return view('buttons.user_withdrawal_button', $data);  //ユーザ退会ボタンを表示するために記述した。編集ページがマージされたら、このedit関数は削除。rikoさんの書いたものを使う。
    }
}
