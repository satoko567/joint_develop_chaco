<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function show($id, Request $request)
    {
        $user = User::findOrFail($id);
        $posts = $user->posts()->orderBy('id', 'desc')->paginate(10);
        $keyword = $request->input('keyword');
        
        return view('users.show', [
            'user' => $user,
            'posts' => $posts,
            'users' => $users ?? collect(),
            'keyword' => $keyword ?? ''
        ]);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        if (\Auth::user()->id !== $user->id) {
            abort(403, 'このページへのアクセスは許可されていません');
        }
        return view('users.edit',[
            'user' => $user,
        ]);
    }

    public function update(UserRequest $request, $id)
    {
        $user = User::findOrFail($id);

        if ($request->filled('name')) {
            $user->name = $request->name;
        }
        if ($request->filled('email')) {
            $user->email = $request->email;
        }
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();
        
        session()->flash('flash-message', 'ユーザ情報が更新されました。');
        
        return redirect()->route('user.show', ['id' => $user->id ]);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->posts()->delete();
        $user->delete();
        Auth::logout();
        session()->flash('flash-message', 'ユーザが削除されました。');
        return redirect()->route('post.index');
     }
}