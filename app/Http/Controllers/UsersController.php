<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserEditRequest;
use Illuminate\Support\Facades\Hash;
use App\User;

class UsersController extends Controller
{
    public function edit(User $user)
    {       
        if (Auth::id() !== $user->id) {
            return redirect()->route('home')->with('status', '権限がありません🙅');
        }
    
        return view('users.edit', compact('user'));
    }

    public function update(UserEditRequest $request)
    {        
        $user = Auth::user();
        $user->nickname = $request->nickname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('status', '編集に成功しました✅');
    }

    public function destroy()
    {       
        $user = Auth::user();
        Auth::logout();
        $user->delete();
        $user->posts()->delete(); //外部キー制約が無効の場合実施？
        
        return redirect()->route('home')->with('status', 'ご利用ありがとうございました😢');
    }
    
    public function show($id)
    {
        $user = User::findOrFail($id);
        $posts = $user->posts()->orderBy('id', 'desc')->paginate(10);
        $data=[
            'user' => $user,
            'posts' => $posts,
        ];
        $data += $this->userCounts($user);
        return view('users.show',$data);
    }

    public function index()
    {
    // ユーザー一覧を取得
    $users = User::paginate(10);  // 1ページに10ユーザーを表示

    // ユーザー一覧をビューに渡す
    return view('users.index', compact('users'));
    }

}
