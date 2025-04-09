<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function store(Request $request, $postId)
    {
        $user = $request->user();
        $user->follow($postId);
        return back();
    }

    public function delete(Request $request, $postId)
    {
        $user = $request->user();
        $user->unfollow($postId);
        return back();
    }
}
