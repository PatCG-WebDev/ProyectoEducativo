<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showReports()
    {
        $users = User::all();

        return view('reports', compact('users'));
    }
}
