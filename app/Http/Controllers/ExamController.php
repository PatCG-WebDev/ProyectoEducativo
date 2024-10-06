<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Exam;
use App\Models\Course;
use App\Models\Subject;

use function PHPUnit\Framework\isNull;

class ExamController extends Controller
{

    ///////////////  TEACHER  //////////////////////////////////////
    public function showExams()
    {
        $userId = Auth::id();
        
        // Obtiene las asignaturas asociadas al usuario
        $user = User::findOrFail($userId);
        $subjects = $user->subjects()->pluck('subjects.id');
        
        //Obtiene los exámenes asociados a las asignaturas del usuario
        $exams = Exam::whereIn('subject_id', $subjects)->get();
        
        // Obtiene los cursos asociados a los exámenes
        $courses = Course::whereIn('id', $exams->pluck('course_id'))->get();
    
        $examsByCourse = [];
        foreach ($courses as $course) {
            $examsByCourse[$course->id] = $exams->where('course_id', $course->id);
        }
       
        return view('teacher.exam.teacher_show_exams', compact('examsByCourse', 'courses'));
    }

   public function createExam() {
        $user = Auth::user();
        $courses = $user->courses()->get();
        $subjects = $courses->isNotEmpty() ? $user->subjects()->where('course_id', $courses[0]->id)->get() : collect();

        return view('teacher.exam.teacher_create_exam', compact('courses', 'subjects'));     
    }

    public function editExam($idExam) {
        $user = Auth::user();
        $exam = Exam::findOrFail($idExam);
        $course = Course::findOrFail($exam->course_id);
        $subjects = $user->subjects()->where('course_id', $course->id)->get();
        $courses = $user->courses()->get(); 

        return view('teacher.exam.teacher_edit_exam', compact('exam', 'course', 'subjects', 'courses'));
    }


    public function updateExam(Request $request, $id){

        $request->validate([
            'name' => 'required|string|max:255',
            'course_id' => 'required',
            'subject_id' => 'required',
        ]);

        $exam = Exam::findOrFail($id);

        $exam->name = $request->name;
        $exam->course_id = $request->course_id;
        $exam->subject_id = $request->subject_id;

        $exam->save();

        return redirect()->route('teacher.show_exams')->with('success', 'Examen actualizado correctamente.');
    }


    public function saveExam(Request $request){

        $request->validate([
            'name' => 'required|string|max:255',
            'course_id' => 'required',
            'subject_id' => 'required',
        ]);

        Exam::create([
            'name' => $request->name,
            'course_id' => $request->course_id,
            'subject_id' => $request->subject_id,
        ]);

        return redirect()->route('teacher.show_exams')->with('success', 'Examen creado correctamente.');
    }


    public function deleteExam(Request $request){

        $request->validate([
            'exam_id' => 'required|exists:exams,id',
        ]);

        $exam = Exam::find($request->exam_id);

        if($exam){

            $exam->delete();
            return redirect()->back()->with('success', 'Examen eliminado exitosamente.');

        }else{
            return redirect()->back()->with('error', 'No se pudo encontrar el examen para eliminar.');
        }
    }

}