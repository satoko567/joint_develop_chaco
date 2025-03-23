<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\FuncCall;

class FollowController extends Controller
{
    // フォロー処理
    public function follow($userId)
    {
        //
    }

    // フォロー解除処理
    public function unFollow($userId)
    {
        //
    }

    // フォローリスト表示
    public function followingList($id)
    {
        $user = User::findOrFail($id);
        $following = $user->following()->paginate(10);

        return view('users.follows.following', compact('user', 'following'));
    }

    // フォロワーリスト表示
    public function followerList($id)
    {
        $user = User::findOrFail($id);
        $followers = $user->follower()->paginate(10);

        return view('users.follows.followers', compact('user', 'followers'));
    }
}
