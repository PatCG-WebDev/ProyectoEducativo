<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Subject;
use App\Models\Note;
use App\Models\Exam;
use App\Models\User;
use Illuminate\Http\Request;

class SubjectController extends Controller
{

    /////////////////   ADMINISTRATOR  ///////////////////////////////////////

    public function adminSubjects()
    {
        $subjects = Subject::all();
        return view('administrator.adminSubjects', compact('subjects'));
    }

    ///////////////////////  TEACHER  ///////////////////////////////////////////

    public function showUsersInSubject($subjectId)
    {  
        $subject = Subject::find($subjectId);
        
        if($subject && $this->isTeacherFromSubject($subject)){
    
            // Obtener los usuarios de la asignatura
            $users = $subject->users()->where('profile_id', 3)->get();
            
            // Obtener los exámenes de la asignatura
            $exams = Exam::where('subject_id', $subjectId)->get();
    
            // Obtener las notas de los usuarios en la asignatura
            foreach ($users as $user) {
                foreach ($exams as $exam) {
                    $note = Note::where('user_id', $user->id)
                                ->where('exam_id', $exam->id)
                                ->first();
                    $user->notes[$exam->id] = $note;
                }
            }
    
            return view('teacher.showUsersInSubject', compact('subject', 'users', 'exams'));
    
        } else {
    
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

    ///////////////////////  STUDENT  ///////////////////////////////////////////
    public function showSubjectsByStudent()
    {
        // Obtener las asignaturas del alumno logueado
        $user = Auth::user();
        $subjects = $user->subjects;


        // Retornar la vista con las asignaturas
        return view('student.showSubjectsByStudent', compact('subjects'));
    }
   
    
}

