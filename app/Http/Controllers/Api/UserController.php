<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function getMe()
    {
        return response(User::with('stupenki')->find(auth()->user()->id));
    }

   public function getUser(User $user)
   {
       return response($user->with('stupenki'));
   }
}
