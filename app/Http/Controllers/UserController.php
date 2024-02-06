<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class UserController extends Controller
{

    /* public function __construct()
    {
        $this->middleware(['auth']);
    }
 */

    public function showReports()
    {
        $users = User::all();

        return view('reports', compact('users'));
    }


    //añadir notas
/*     public function addNotes($id) 
    {
        $subject = Subject::find($id);
        $user = Subject::find($id)->user;
        $notes = Subject::find($id)->notes;

        return view('add-notes')->with('user',$user)->with('subject',$subsect)->with('notes',$notes);
    } */


}