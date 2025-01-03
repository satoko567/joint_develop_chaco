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

        //$user = Auth::user(); //
        $user = User::find(6);//後日入れ替え
        return view('users.edit', ['user' => $user]);
    }

    public function update(UserEditRequest $request){

        //$user = Auth::user();　//Parameter is not needed.
        $user = User::find(6); //後日入れ替え
        $user->nickname = $request->nickname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save(); 

        //return redirect()->view('users.edit', ['user' => $user])->with('編集に成功しました');
        return back()->with('hahaha', '編集に成功しました');
    }

    public function destroy(){

        //$user = Auth::user();
        $user = user::find(6); 
        $user->delete();
        
        return back()->with('status', '後悔すんなよ👀');//
        //return redirect()->route('home')->with('status', '後悔すんなよ👀');
    }
    
}
