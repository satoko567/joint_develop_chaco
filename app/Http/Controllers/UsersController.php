<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserEditRequest;
use Illuminate\Support\Facades\Hash;
use App\User;

class UsersController extends Controller
{
    public function edit()
    {

        //$user = Auth::user();
        $user = user::find(6); 
        return view('users.edit', ['user' => $user]);
    }

    public function update(UserEditRequest $request)
    {

        //$user = Auth::user();
        $user = user::find(6); 
        $user->nickname = $request->nickname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('status', '編集に成功しました');
    }

    public function destroy()
    {

        //$user = Auth::user();
        $user = user::find(6); 
        Auth::logout();
        $user->delete();
        // 必要に応じてイベントを発行
        event(new UserDeleted($user));
        return redirect()->route('home')->with('status', 'ご利用ありがとうございました😢');
    }
}

