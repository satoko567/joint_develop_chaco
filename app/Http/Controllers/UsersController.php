<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
class UsersController extends Controller
{
    public function show($id)
    {
        $user = User::findOrFail($id);
        $posts = $user->posts()->orderBy('id', 'desc')->paginate(6);

        return view('users.detail', compact('user', 'posts'));
    }

    public function destroy($id, Request $request)
    {
        $user = User::findOrFail($id);
        if(Auth::id() !== $user->id){
            abort(403,'権限がありません。');
        }
        $user->delete();

        Auth::logout();

        $request->session()->invalidate(); // session無効化
        $request->session()->regenerateToken(); // CSRFトークンをリセット

        return redirect('/'); // 退会後トップページへ
    }
}
