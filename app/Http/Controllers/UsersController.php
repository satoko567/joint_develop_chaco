<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\User;

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
        $data += $this->userCounts($user);

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

        return view('users.show', [
            'user' => $user,
            'posts' => $posts,
        ]);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        if ($user->id === \Auth::id()) {
            return view('users.edit', [
                'user' => $user,
            ]);
        }
        abort(404);
    }

    public function update(UserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();
        return redirect()->route('user.show', $user->id)->with('success', '「ユーザ情報の更新」が完了しました！');
    }

    public function withdrawal($id, Request $request)
    {
        $user = User::findOrFail($id);
        if(Auth::id() !== $user->id){
            abort(403);
        }
        $user->delete();

        Auth::logout();
        
        return redirect()->route('posts.index')->with('success', '退会が完了しました！');
    }

    public function follows($id)
    {
        $user = User::with('follows')->findOrFail($id);
        $followers = $user->follows()->get();
        $data=[
            'user' => $user,
            'followers' => $followers,  
        ];
        $data += $this->userCounts($user);
        
        return view('users.show', $data);   
    }

    public function followers($id)
    {
        $user = User::with('followers')->findOrFail($id);
        $followers = $user->followers()->get();
        $data=[
            'user' => $user,
            'followers' => $followers,  
        ];
        $data += $this->userCounts($user);
        
        return view('users.show', $data);   
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect('/users/'. $user->id);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if (\Auth::id() === $user->id) {
            $user->delete();
        }

        return redirect('/');
    }
}
