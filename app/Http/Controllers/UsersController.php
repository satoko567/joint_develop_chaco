<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function show($id)
    {
        $user = User::findOrFail($id);
        $posts = $user->posts()->orderBy('id','desc')->paginate(6);

        return view('users.detail',compact('user','posts'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect('/');
    }
}
