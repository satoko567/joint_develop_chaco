<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\UserRequest;

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
        if (\Auth::id() != $id) {
            abort(403);
        }
        $user = User::findOrFail($id);
        $data = [
            'user' => $user,
        ];
        return view('users.edit_user_form', $data);
    }

    public function update(UserRequest $request, $id)
    {
        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        $user->save();

        return redirect()->route('users.show', $user->id);
    }
}
