<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
/*     private $user;

    public function __construct(){

        $this->user = Auth::user();

        var_dump($this->user);
        die();
    } */
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
        
        if($subject && $this->isTeacherFromSubject($subject)){

            $users = $subject->users()->where('profile_id', 3)->get();

            return view('showUsersInSubject', compact('subject','users'));

        }else{

            return 'No tienes permisos para esta asignatura.';
        }

    }

    private function isTeacherFromSubject($subject){

        $user = Auth::user();
        
        $teachers = $subject->users()->where('profile_id', 2)->get();

        foreach ($teachers as $teacher){

            if($teacher->id == $user->id){
                return true;
            }
        }
        
        return false;
    }

        
    
    
}

