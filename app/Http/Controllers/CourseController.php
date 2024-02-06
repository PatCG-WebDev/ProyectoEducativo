<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Course;


class CourseController extends Controller
{
    public function showCoursesByTeacher()
    {
        $courses = [];
        // Obtener las asignaturas del alumno logueado
        $user = Auth::user();
        $courses = $user->courses;
 
        // Retornar la vista con los cursos
        return view('showCoursesByTeacher', compact('courses'));
    }


    public function showSubjectsInCourse($courseId)
    {
        // Obtener el usuario autenticado
        $user = Auth::user();
        // Obtener el curso especificado
        $course = Course::find($courseId);

        
        // Verificar si el usuario está autenticado y tiene el perfil de profesor (perfil 2)
        if ($user && $user->profile_id == 2) {
           
            $subjects = $user->subjects->where('course_id', $courseId);
                   
            return view('showSubjectsInCourse', compact('course', 'subjects'));

        } else {
                // Si el usuario no está asociado con el curso, redirigir o mostrar un mensaje de error
                return redirect()->route('showCoursesByTeacher')->with('error', 'No tiene permisos para ver las asignaturas de este curso.');
        }
      
    }

    /* ¡public function showUsersInCourse($courseId)
    {
        
        $course = Course::find($courseId);
        $users = $course->users;
        
        return view('showUsersInCourse', compact('course', 'users'));
    }
 */

    
}
