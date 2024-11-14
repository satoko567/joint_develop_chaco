<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function store($id)
    {
        \Auth::user()->follow($id);
        return back();
    }
    public function destroy($id)
    {
        \Auth::user()->unfollow($id);
        return back();
    }
}
