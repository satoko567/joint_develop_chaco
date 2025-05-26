<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UsersController extends Controller
{
    public function show($id)
    {
        $user = User::findOrFail($id);
        // $posts = $user->posts()->orderBy('id', 'desc')->paginate(10);
        $data = [
            'user' => $user,
            // 'posts' => $posts,
        ];

        return view('users.show',$data);
    }
    
    public function edit($id)
    {
        $user = \Auth::user();
        $user = User::findOrFail($id);

        if (\Auth::id() != $id) {
            abort(403);
        }

        $data=[
            'user' => $user,
        ];

        return view('users.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();
        return redirect()->route('user.show', $user->id);
    }
}
