<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function allUsers(){
        return view('welcome',
            ['users'=> User::all()]);
    }
}
