<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function Userindex()
    {
        //featch the user data from the database and display it on the user index page of role user
        $users = User::where('role', 'user')->get();
        return view('user.index', compact('users'));
    }
}
