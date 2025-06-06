<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    //ユーザ詳細(なりさんご担当)
       public function show($id)
    {
        $keyword = '';
        $user = User::findOrFail($id); // ユーザーが見つからなければ404エラー
        return view('users.show', compact('user', 'keyword')); // ビューにデータを渡す
    }


    // 編集画面
    public function edit($id)
    {
        $user = User::findOrFail($id);
        if (Auth::id() != $id) {
            abort(403);
        }
        return view('users.edit', ['user' => $user]);
    }

    // 更新処理
    public function update(UserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect('/');
        // ユーザ詳細がマージされ次第、return redirect('/');の部分を下記コードに変更
        // return redirect()->route('user.show', $user->id);
    }

    // 退会処理
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if (Auth::id() != $id) {
            abort(403);
        }
        $user->posts()->delete();
        $user->delete();
        return redirect('/');
    }

    //自分がフォローしているユーザー一覧
    public function followings($id)
    {
        $user = User::findOrFail($id);
        $followings = $user->followings()->paginate(9);
        $data = [
            'user' => $user,
            'users' => $followings,
        ]; 
        $data += $this->userCounts($user);
        
        return view('users.followings', $data);
    }

    //自分をフォローしているユーザー一覧
    public function followers($id)
    {
        $user = User::findOrFail($id);
        $followers = $user->followers()->paginate(9);
        $data = [
            'user' => $user,
            'users' => $followers,
        ];
        $data += $this->userCounts($user);
        
        return view('users.followers', $data);
    }

}
