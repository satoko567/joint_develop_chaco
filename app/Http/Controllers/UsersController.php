<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    public function show($id, Request $request)
    {
        $user = User::findOrFail($id);
        $posts = $user->posts()->withCount('comments')->orderBy('id', 'desc')->paginate(10);
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
        if ($request->has('profile')) {
            $user->profile = $request->profile;
        } else {
            $user->profile = 'プロフィール文が設定されていません';
        }
        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::delete($user->avatar);
            }
            $path = $request->file('avatar')->store('public/avatars');
            $user->avatar = $path;
        }
        $user->save();
        session()->flash('flash-message', 'ユーザ情報が更新されました。');
        return redirect()->route('user.show', [
            'id' => $user->id
        ]);
    }

    public function deleteAvatar()
    {
        $user = auth()->user();
        if ($user->avatar) {
            Storage::delete($user->avatar);
            $user->avatar = null;
            $user->save();
            session()->flash('flash-message', 'プロフィール画像が削除されました。');
        }
        return back();
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

    public function getFollowings($id)
    {
        $user = User::findOrFail($id);
        $followings = $user->following()->paginate(5);

        return view('users.show', [
            'user' => $user,
            'users' => $followings,
            'message' => $user->name."は他のユーザをフォローしていません。",
        ]);
    }

    public function getFollowers($id)
    {
        $user = User::findOrFail($id);
        $followers = $user->followers()->paginate(5);

        return view('users.show', [
            'user' => $user,
            'users' => $followers,
            'message' => $user->name."は他のユーザからフォローされていません。",
        ]);
    }
}