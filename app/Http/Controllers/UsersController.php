<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;

class UsersController extends Controller
{
    public function show($id)
    {
        $user = User::findOrFail($id);
        $posts = $user->posts()->orderBy('id', 'desc')->paginate(10);
        $data = [
            'user' => $user,
            'posts' => $posts,
        ];
        return view('users.show',$data);
    }

    public function edit($id)
    {
        $user = \Auth::user();
        $user = User::findOrFail($id);
        $date = [
            'user' => $user,
        ];

        return view('users.edit', $date);
    }

    public function update(UserRequest $request, $id)
    {
        $user = User::findOrFail($id);

        if ($request->filled('name')) {
            $user->name = $request->name;
        }
        if ($request->filled('email')) {
            $user->email = $request->email;
        }
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('user.show', ['id' => $user->id ]);
    }
}
