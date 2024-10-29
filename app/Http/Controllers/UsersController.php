<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\User;

class UsersController extends Controller
{
    public function edit($id)
    {
        $user = \Auth::user();
        $user = User::findOrFail($id);
        $data = ['user' => $user,];

        return view('user.edit', $data);
    }
    
    public function update(UserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->Hash::make($request->password);
        $user->save();
        
        return back
    }
}