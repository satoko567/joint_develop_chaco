<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\UserUpdateRequest;//ユーザ情報更新の際の、バリデーションファイルを使用するために追加

class UsersController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id','desc')->paginate(9);
        return view('welcome', [
            'users' => $users,
        ]);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        $data = [
            'user' => $user,
        ];
        return view('show', $data);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $data = [
            'user_name' => $user->name,
            'user_email' => $user->email,
            'id' => $user->id,
        ];
        return view('edit', $data);
    }

    public function update(UserUpdateRequest $request , $id) 
    {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return header('users/'.$id);
    }

}