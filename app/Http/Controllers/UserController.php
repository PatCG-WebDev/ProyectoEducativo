<?php

namespace App\Http\Controllers;

use App\Models\Subject;
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


    public function mySubjects()
    {
        // Obtener las asignaturas del alumno logueado
        $user = Auth::user();
        $subjects = $user->subjects;


        // Retornar la vista con las asignaturas
        return view('subjects', compact('subjects'));
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