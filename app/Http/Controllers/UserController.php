<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function follow(User $user)
    {
        auth()->user()->follow($user);
        return back();
    }

    public function unfollow(User $user)
    {
        auth()->user()->unfollow($user);
        return back();
    }

}
