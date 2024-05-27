<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Subject;
use App\Models\Note;
use App\Models\Exam;
use App\Models\User;
use App\Models\Course;
use Illuminate\Http\Request;

class SubjectController extends Controller
{

    /////////////////   ADMINISTRATOR  ///////////////////////////////////////

    //Muestra la lista de usuarios
    public function showSubjects(Request $request)
    {
        $orderBy = $request->input('order_by', 'subjects.id');
        $orderDirection = $request->input('order_direction', 'asc');

        $query = Subject::with('course');// carga los datos relacionados con course (course es el nombre de la función que relaciona el modelo subject con el modelo course)

        if ($orderBy === 'course.name') {
            $query->join('courses', 'subjects.course_id', '=', 'courses.id')
                ->orderBy('courses.name', $orderDirection)
                ->select('subjects.*', 'courses.name AS course_name');
        } else {
            $query->orderBy($orderBy, $orderDirection);
        }

        $subjects = $query->get();

        return view('administrator.subject.admin_show_subjects', compact('subjects'));
    }

    

    public function showEditSubjectForm($subjectId)
    {
        $subject = Subject::find($subjectId);
        $courses = Course::all();

        if (!$subject) {
            return redirect()->route('home')->with('error', 'Asignatura no encontrada.');
        }

        return view('administrator.subject.admin_edit_subject', compact('subject', 'courses'));
    }

    
    public function updateSubject(Request $request)
    {
        $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'name' => 'required|string|max:255',
            'course_id' => 'required|exists:courses,id',
        ]);

        $subject = Subject::findOrFail($request->subject_id);

        $subject->name = $request->name;
        $subject->course_id = $request->course_id;

        $subject->save();

        return redirect()->route('administrator.show_subjects')->with('success', 'Asignatura actualizada correctamente.');
    }

    
    public function addSubjectForm()
    {
        $courses = Course::all();
        return view('administrator.subject.admin_add_subject', compact('courses'));
    }


    public function addSubject(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'course_id' => 'required|exists:courses,id',
        ]);

        $subject = Subject::create([
            'name' => $request->name,
            'course_id' => $request->course_id,
        ]);

        return redirect()->route('administrator.show_subjects')->with('success', 'Asignatura agregada correctamente.');
    }

    
    public function deleteSubject($subjectId)
    {
        $subject = Subject::find($subjectId);

        if (!$subject) {
            return redirect()->route('administrator.show_subjects')->with('error', 'Asignatura no encontrada.');
        }

        $subject->delete();

        return redirect()->route('administrator.show_subjects')->with('success', 'Asignatura eliminada correctamente.');
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
    
            return view('teacher.note.teacher_show_users_in_subject', compact('subject', 'users', 'exams'));
    
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
        return view('student.student_show_subjects', compact('subjects'));
    }
   
    
}

