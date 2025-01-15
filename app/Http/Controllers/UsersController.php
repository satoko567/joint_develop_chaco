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

<<<<<<< HEAD
        //$user = Auth::user();　//Parameter is not needed.
        $user = User::find(6); //後日入れ替え
=======
        $user = Auth::user();
>>>>>>> feature/jin/user_edit_update
        $user->nickname = $request->nickname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save(); 

        return back()->with('status', '編集に成功しました');
    }

    public function destroy(){

        //$user = Auth::user();
        $user = user::find(6); 
        $user->delete();
        
        return redirect()->route('home')->with('status', '後悔すんなよ👀');
    }
    
}
