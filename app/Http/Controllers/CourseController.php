<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;


class CourseController extends Controller
{
    public function showCourses()
    {
        
        // Obtener las asignaturas del alumno logueado
        $user = Auth::user();
        $courses = $user->courses;
        

       /*  if($courses == null){
            $courses = array();
        }
         */

        // Retornar la vista con las asignaturas
        return view('showCourses', compact('courses'));
}
}
