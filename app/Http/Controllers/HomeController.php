<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class HomeController extends Controller
{
    public function index()
    {
        return view('user.user_master');
    }

    public function authUser()
    {
        return response()->json([
            'user' => \Auth::user()
        ],200);
    }

    public function userList()
    {
        $user_list = User::paginate(10);
        return response()->json([
            'user_list' => $user_list
        ]);
    }
}