<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::orderBy(‘id’,‘desc’)->paginate(9);
        return view(‘welcome’, [
            ‘users’ => $users,
        ]);
    }

    public function show()
    {
        return view('show');
    }

    public function edit()
    {
        return view('edit');
    }

}