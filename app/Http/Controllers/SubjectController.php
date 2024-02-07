<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function showSubjectsByStudent()
    {
        // Obtener las asignaturas del alumno logueado
        $user = Auth::user();
        $subjects = $user->subjects;


        // Retornar la vista con las asignaturas
        return view('showSubjectsByStudent', compact('subjects'));
    }


    public function showUsersInSubject($subjectId)
    {  
        $subject = Subject::find($subjectId);
        
        if($subject){

            $users = $subject->users()->where('profile_id', 3)->get();

            return view('showUsersInSubject', compact('subject','users'));

        }else{

            return 'No hay estudiantes para esta asignatura';
        }

    }
    
}

