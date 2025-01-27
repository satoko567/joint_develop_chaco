<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function follow(User $user)
    {
        $currentUser = Auth::user();
        if (!$currentUser->following->contains($user->id)) {
            $currentUser->following()->attach($user->id);

        }
        return back();
    }

    public function unfollow(User $user)
    {
        $currentUser = Auth::user();
        if ($currentUser->following->contains($user->id)) {
            $currentUser->following()->detach($user->id);
        }
        return back();
    }

    public function following(User $user)
    {
        $following = $user->following;
        $totalCount = totalCount($user);

        return view('follow.following', compact('user', 'following', 'totalCount'));
    }

    public function followers(User $user)
    {
        $followers = $user->followers;
        $totalCount = totalCount($user);

        return view('follow.followers', compact('user', 'followers', 'totalCount'));
    }
    
}
