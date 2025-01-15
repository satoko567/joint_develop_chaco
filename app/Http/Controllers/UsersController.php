<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserEditRequest;
use Illuminate\Support\Facades\Hash;
use App\User;

class UsersController extends Controller
{
    public function edit(){

        $user = Auth::user(); 
        return view('users.edit', ['user' => $user]);
    }

    public function update(UserEditRequest $request){

        $user = Auth::user();
        $user->nickname = $request->nickname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save(); 

        return back()->with('status', '編集に成功しました');
    }
}
