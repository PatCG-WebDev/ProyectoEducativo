<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class UserController extends Controller
{

///////////////////  ADMINISTRATOR  //////////////////////////////////
    public function adminUsers()
    {
        $users = User::all();
        return view('administrator.adminUsers', compact('users'));
    }

    public function showReports()
    {
        $users = User::all();

        return view('seeReports', compact('users'));
    }

}