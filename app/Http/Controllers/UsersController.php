<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function show($id)
    {
        $user = User::findOrFail($id);
        // $posts = $user->posts()->orderBy('id', 'desc')->paginate(10);
        $data = [
            'user' => $user,
            // 'posts' => $posts,
        ];

        return view('users.show',$data);
    }
    
    public function edit($id)
    {
        $user = \Auth::user();
        $user = User::findOrFail($id);

        if (\Auth::id() != $id) {
            abort(403);
        }

        $data=[
            'user' => $user,
        ];

        return view('users.edit', $data);
    }

    public function update(UserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();
        return redirect()->route('user.show', $user->id)->with('success', '「ユーザ情報の更新」が完了しました！
        ');
    }

    public function withdrawal($id, Request $request)
    {
        $user = User::findOrFail($id);
        if(Auth::id() !== $user->id){
            abort(403);
        }
        $user->delete();

        Auth::logout();
        
        return redirect("/");
    }
}
