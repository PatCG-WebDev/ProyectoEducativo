<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\Subject;


class CourseController extends Controller
{

    ////////////////  ADMINISTRATOR  ////////////////////////////////////////

    //Muestra la lista de cursos
    public function showCourses(Request $request)
    {

        //Obtiene los parámetros de ordenación de la solicitud HTTP, si no los tiene utiliza los siguientes parámetros predeterminados:
        $orderBy = $request->input('order_by', 'courses.id');
        $orderDirection = $request->input('order_direction', 'asc');

        $validOrderFields = ['courses.id', 'courses.name']; //Definir los campos por los que se puede ordenar.
        $orderBy = in_array($orderBy, $validOrderFields) ? $orderBy : 'courses.id'; //Definir si el campo de ordenamiento es válido, si no lo es ordenar por id

        $courses = Course::orderBy($orderBy, $orderDirection)->paginate(10);

        return view('administrator.course.admin_show_courses', compact('courses', 'orderBy', 'orderDirection'));
    }

    //Formulario para añadir nuevo curso
    public function addCourseForm()
    {
        return view('administrator.course.admin_add_course');
    }

    //Añade un nuevo curso
    public function addCourse(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
    
        Course::create([
            'name' => $request->name,
        ]);
    
        return redirect()->route('administrator.show_courses')->with('success', 'Curso agregado correctamente.');
    }

    //Formulario para editar un curso
    public function showEditCourseForm($courseId)
    {
        $course = Course::find($courseId);

        if (!$course) {
            return redirect()->route('administrator.showCourses')->with('error', 'Curso no encontrado.');
        }

        return view('administrator.course.admin_edit_course', compact('course'));
    }

    //Actualiza un curso
    public function updateCourse(Request $request)
    {
        $this->validateProfile($request, $request->course_id);

        $course = Course::findOrFail($request->course_id);
        $course->name = $request->name;
        $course->save();
    
        return redirect()->route('administrator.show_courses')->with('success', 'Curso actualizado correctamente.');
    }

    
    //Elimina un curso
    public function deleteCourse($courseId)
    {
        $course = Course::find($courseId);

        if (!$course) {
            return redirect()->route('administrator.show_courses')->with('error', 'Curso no encontrado.');
        }

        $course->delete();

        return redirect()->route('administrator.show_courses')->with('success', 'Curso eliminado correctamente.');
    }

    //Valida datos del curso
    private function validateProfile(Request $request, $profileId = null)
    {
        $rules = [
            'name' => 'required|string|max:255|unique:profiles,name' . ($profileId ? ',' . $profileId : ''),
        ];

        $messages = [
            'name.required' => 'El nombre es obligatorio.',
            'name.unique' => 'El nombre del perfil ya está en uso.',
        ];

        $request->validate($rules, $messages);
    }



    ////////////////  TEACHER  ////////////////////////////////////////
    public function showCoursesByTeacher()
    {
        $courses = [];
        // Obtener las asignaturas del alumno logueado
        $user = Auth::user();
        $courses = $user->courses;
 
        // Retornar la vista con los cursos
        return view('teacher.note.teacher_show_courses', compact('courses'));
    }

    public function showSubjectsInCourse($courseId)
    {
        // Obtener el usuario autenticado
        $user = Auth::user();
    
        // Obtener el curso especificado
        $course = Course::find($courseId);
    
        // Verificar si el usuario está autenticado y tiene el perfil de profesor (perfil 2)
        if ($user && $user->profile_id == 2) {
            // Obtener las asignaturas del usuario para el curso seleccionado
            $subjects = $user->subjects()->where('course_id', $courseId)->get();
                       
            return view('teacher.note.teacher_show_subjects', compact('course', 'subjects'));
        } else {
            // Si el usuario no está asociado con el curso, redirigir o mostrar un mensaje de error
            return redirect()->route('teacher.note.teacher_show_courses')->with('error', 'No tiene permisos para ver las asignaturas de este curso.');
        }
    }

    public function getSubjectJson($courseId)
    {
        $user = Auth::user();

        // Obtener las asignaturas del usuario para el curso seleccionado
        $subjects = $user->subjects()
                        ->where('course_id', $courseId)
                        ->get(['id', 'name']);

        return response()->json(['subjects' => $subjects]);
    }
}
