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
        $orderBy = $request->input('order_by', 'id');
        $orderDirection = $request->input('order_direction', 'asc');
        /* // Verificar si se está ordenando en orden descendente
        if (substr($orderBy, 0, 1) === '-') {
            $orderDirection = 'desc';
            $orderBy = substr($orderBy, 1); // Eliminar el '-' para obtener el nombre de la columna
        }

        // Validar la dirección del orden
        if (!in_array($orderDirection, ['asc', 'desc'])) {
            abort(400, 'Order direction must be "asc" or "desc".');
        } */

        // Ordenar los cursos según el parámetro 'order_by'
        if ($orderBy === 'name') {
            $courses = Course::orderBy('name', $orderDirection)->get();
        } else {
            $courses = Course::orderBy('id', $orderDirection)->get(); // Ordenar por defecto por 'id' si no se especifica otro campo
        }
        
        return view('administrator.course.admin_show_courses', compact('courses'));
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
