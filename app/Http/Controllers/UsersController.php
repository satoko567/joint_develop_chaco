<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function index()
    {
        $newUsers = User::orderBy('created_at', 'desc')->take(3)->get();
        $users = User::orderBy('created_at', 'desc')->paginate(5);
        return view('welcome', compact('newUsers', 'users'));
    }
}