<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Reply;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use \Illuminate\Foundation\Auth\AuthenticatesUsers;

    protected $redirectTo = '/admin';

    // 管理者ログイン画面
    public function showLoginForm()
    {
        return view('admin.login');
    }

    protected function authenticated(Request $request, $user)
    {
        if (!$user->is_admin) {
            Auth::logout();
            return redirect('/login')->with('error', '管理者アカウントではありません');
        }
    }

    // 管理者画面
    public function showDashboard()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(10);
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        $replies = Reply::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.dashboard', compact('users', 'posts', 'replies'));
    }

    // 管理者ログイン処理
    public function login(AdminLoginRequest $request)
    {
        $authority = $request->only('email', 'password');

        if (Auth::attempt($authority)) {
            $user = Auth::user();

            if ($user->is_admin) {
                return redirect()->route('admin.show.dashboard');
            }

            Auth::logout();
            abort(403, '認証情報が正しくありません');
        }
    }
}
