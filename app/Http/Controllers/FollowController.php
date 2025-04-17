<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function store(Request $request, $id)
    {
        $user = $request->user();
        $user->follow($id);
        return back();
    }

    public function delete(Request $request, $id)
    {
        $user = $request->user();
        $user->unfollow($id);
        return back();
    }
}
