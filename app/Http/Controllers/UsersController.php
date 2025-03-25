<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function topPage()
    {
        return view('users.top_page');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        $data = [
            'user' => $user,
        ];
        return view('users.show', $data);
    }
}