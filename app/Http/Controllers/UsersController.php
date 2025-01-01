<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;


class UsersController extends Controller
{
    public function edit($id)
    {
        $user = \Auth::user();
        if ($user->id !== (int) $id) {
            abort(403);
        }
        $data = [
            'user' => $user,
        ];
        return view('users.edit', $data);
    }

    public function update(UserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        return back();
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        $posts = $user->posts()->orderBy('id', 'desc')->paginate(10);
        // フォローのタブ切り替え
        $followIf = 0;
        $data = [
            'user' => $user,
            'posts' => $posts,
            'followIf' => $followIf,
        ];
        $data += $this->followCounts($user);
        return view('users.show', $data);
    }

    // フォロー中の画面
    public function following($id)
    {
        $user = User::findOrFail($id);
        // ユーザ一覧取得
        $users = $user->following()->orderBy('id', 'desc')->paginate(10);
        // フォローのタブ切り替え
        $followIf = 1;
        $data = [
            'user' => $user,
            'users' => $users,
            'followIf' => $followIf,
        ];
        $data += $this->followCounts($user);
        return view('users.show', $data);
    }

    //フォロワーの画面
    public function followed($id)
    {
        $user = User::findOrFail($id);
        // ユーザ一覧取得
        $users = $user->followed()->orderBy('id', 'desc')->paginate(10);
        // フォローのタブ切り替え
        $followIf = 1;
        $data = [
            'user' => $user,
            'users' => $users,
            'followIf' => $followIf,
        ];
        $data += $this->followCounts($user);
        return view('users.show', $data);
    }

    public function favorites($id)
    {
        $user = User::findOrFail($id);
        $posts = $user->favorites()->paginate(9);
        $data=[
            'user' => $user,
            'posts' => $posts,
        ];
        $data += $this->userCounts($user);
        return view('users.show', $data);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if (\Auth::id() === $user->id) {
            $user->delete();
            Auth::logout();
            return redirect()->route('post.index');
        }
    }
}