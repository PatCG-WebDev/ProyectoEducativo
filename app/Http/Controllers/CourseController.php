<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\Subject;


class CourseController extends Controller
{

    ////////////////  ADMINISTRATOR  ////////////////////////////////////////

    public function showCourses(Request $request)
    {
        $orderBy = $request->input('order_by', 'id');

        // Ordenar los cursos según el parámetro 'order_by'
        if ($orderBy === 'name') {
            $courses = Course::orderBy('name')->get();
        } else {
            $courses = Course::orderBy('id')->get(); // Ordenar por defecto por 'id' si no se especifica otro campo
        }
        
        return view('administrator.adminShowCourses', compact('courses'));
    }

    public function showEditCourseForm($courseId)
    {
        $course = Course::find($courseId);

        if (!$course) {
            return redirect()->route('administrator.showCourses')->with('error', 'Curso no encontrado.');
        }

        return view('administrator.adminEditCourse', compact('course'));
    }

    public function updateCourse(Request $request)
    {
        $request->validate([
            'course_id' => 'required',
            'name' => 'required|string|max:255',
        ]);
    
        $course = Course::find($request->course_id);
    
        if (!$course) {
            return redirect()->route('administrator.showCourses')->with('error', 'Curso no encontrado.');
        }
    
        $course->update([
            'name' => $request->name,
        ]);
    
        return redirect()->route('administrator.showCourses')->with('success', 'Curso actualizado correctamente.');
    }

    public function addCourseForm()
    {
        return view('administrator.adminAddCourse');
    }

    public function addCourse(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
    
        Course::create([
            'name' => $request->name,
        ]);
    
        return redirect()->route('administrator.showCourses')->with('success', 'Curso agregado correctamente.');
    }

    public function deleteCourse($courseId)
    {
        $course = Course::find($courseId);

        if (!$course) {
            return redirect()->route('administrator.showCourses')->with('error', 'Curso no encontrado.');
        }

        $course->delete();

        return redirect()->route('administrator.showCourses')->with('success', 'Curso eliminado correctamente.');
    }



    ////////////////  TEACHER  ////////////////////////////////////////
    public function showCoursesByTeacher()
    {
        $courses = [];
        // Obtener las asignaturas del alumno logueado
        $user = Auth::user();
        $courses = $user->courses;
 
        // Retornar la vista con los cursos
        return view('teacher.showCoursesByTeacher', compact('courses'));
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
                       
            return view('teacher.showSubjectsInCourse', compact('course', 'subjects'));
        } else {
            // Si el usuario no está asociado con el curso, redirigir o mostrar un mensaje de error
            return redirect()->route('teacher.showCoursesByTeacher')->with('error', 'No tiene permisos para ver las asignaturas de este curso.');
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
