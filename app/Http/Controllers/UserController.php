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


    public function mySubjects()
    {
        // Obtener las asignaturas del alumno logueado
        $user = Auth::user();
        $subjects = $user->subject;


        // Retornar la vista con las asignaturas
        return view('subjects', compact('subjects'));
}
}