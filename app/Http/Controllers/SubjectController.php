<?php

namespace App\Http\Controllers;


use App\Models\Subject;
use App\Models\Note;
use App\Models\Exam;
use App\Models\User;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SubjectController extends Controller
{

    /////////////////   ADMINISTRATOR  ///////////////////////////////////////

    //Muestra la lista de asignaturas
    public function showSubjects(Request $request)
    {
        $query = Subject::with('course'); //obtener subjects y su relación con courses

         //Obtiene los parámetros de ordenación de la solicitud HTTP, si no los tiene utiliza los siguientes parámetros predeterminados:
        $orderBy = $request->input('order_by', 'subjects.id');
        $orderDirection = $request->input('order_direction', 'asc');

        $validOrderFields = ['subjects.id', 'subjects.name', 'courses.name']; //Definir los campos por los que se puede ordenar.
        $orderBy = in_array($orderBy, $validOrderFields) ? $orderBy : 'subjects.id'; //Definir si el campo de ordenamiento es válido, si no lo es ordenar por id

        if ($orderBy === 'courses.name') { //Cuando el campo de ordenación es courses, hacemos la unión entre las 2 tablas.
            $query->join('courses', 'subjects.course_id', '=', 'courses.id')
                ->orderBy('courses.name', $orderDirection)
                ->select('subjects.*', 'courses.name AS course_name');
        } else {
            $query->orderBy($orderBy, $orderDirection);
        }

        $subjects = $query->paginate(10);

        return view('administrator.subject.admin_show_subjects', compact('subjects', 'orderBy', 'orderDirection'));
    }


    //Formulario añadir asignatura
    public function addSubjectForm()
    {
        $courses = Course::all();
        return view('administrator.subject.admin_add_subject', compact('courses'));
    }

    //Añade asignatura
    public function addSubject(Request $request)
    {
        $this->validateSubject($request);

        $subject = new Subject();
        $subject->name = $request->name;
        $subject->course_id = $request->course_id;
        $subject->save();

        // Obtener la posición de la NUEVA asignatura en la lista ordenada por ID ascendente
        $subjectPosition = Subject::where('id', '<=', $subject->id)->count();

        // Calcular la página en la que se encuentra la asignatura recién creada
        $itemsPerPage = 10; // Número de elementos por página
        $subjectPage = ceil($subjectPosition / $itemsPerPage);

        return Redirect::route('administrator.show_subjects', ['page' => $subjectPage])->with('success', 'Asignatura agregada correctamente.');
    }

    //Formulario Editar Asignatura
    public function showEditSubjectForm($subjectId)
    {
        $subject = Subject::find($subjectId);
        $courses = Course::all();

        if (!$subject) {
            return redirect()->route('home')->with('error', 'Asignatura no encontrada.');
        }

        return view('administrator.subject.admin_edit_subject', compact('subject', 'courses'));
    }

    //Actualiza Asignatura
    public function updateSubject(Request $request)
    {
        $this->validateSubject($request, $request->subject_id);

        $subject = Subject::findOrFail($request->subject_id);
        $subject->name = $request->name;
        $subject->course_id = $request->course_id;
        $subject->save();

        // Obtener la posición de la asignatura en la lista ordenada por ID ascendente
        $subjectPosition = Subject::where('id', '<=', $subject->id)->count();

        // Calcular la página en la que se encuentra la asignatura actualizada
        $itemsPerPage = 10; // Número de elementos por página
        $subjectPage = ceil($subjectPosition / $itemsPerPage);

        // Redirigir al usuario a la página donde se encuentra la asignatura actualizada
        return Redirect::route('administrator.show_subjects', ['page' => $subjectPage])->with('success', 'Asignatura actualizada correctamente.');
    }

    //Elimina Asignatura
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


    //Muesta alumnos por asignatura
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
    
    //Muestra Asignaturas del profesor
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

    //Muestra asignaturas del estudiante
    public function showSubjectsByStudent()
    {
        // Obtener las asignaturas del alumno logueado
        $user = Auth::user();
        $subjects = $user->subjects;


        // Retornar la vista con las asignaturas
        return view('student.student_show_subjects', compact('subjects'));
    }
   
    
}

