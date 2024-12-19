<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

    // Password
    public function showChangePass()
    {
        return view('users.password_change');
    }

    public function updatePass(Request $request)
    {
        $errors = collect();

        if (!Hash::check($request->current_password, Auth::user()->password)) {
            $errors->put('current_password', ['現在のパスワードが正しくありません。']);
        }

        $validator = validator($request->all(), [
            'current_password' => ['required'],
            'new_password' => ['required', 'string', 'min:4', 'confirmed'],
        ], [
            'new_password.confirmed' => '新しいパスワードが一致しません。',
        ]);

        if ($validator->fails()) {
            $errors = $errors->merge($validator->errors()->messages());
        }

        if ($errors->isNotEmpty()) {
            return back()->withErrors($errors->toArray())->withInput();
        }

        $user = Auth::user();
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('password.change');
    }

    //　設定画面の表示
    public function settings()
    {
        return view('settings.index');
    }
}