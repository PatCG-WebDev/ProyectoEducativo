<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Exam;
use App\Models\Course;
use App\Models\Subject;

use function PHPUnit\Framework\isNull;

class ExamController extends Controller
{
    public function showExams(){

       
       $user = Auth::user();
       
       $courses = $user->courses()->with('exams')->get();

       return view('teacher.showExams', compact('courses'));
   }


   public function createOrEditExam($idExam = null) {

        $user = Auth::user();
        $courses = $user->courses()->get();//cursos del profesor

        if ($idExam == null) {

            $subjects = $courses->isNotEmpty() ? $user->subjects()->where('course_id', $courses[0]->id)->get() : collect();

            return view('teacher.createOrEditExam', compact('courses', 'subjects'));     
                   
        } else {
            $exam = Exam::findOrFail($idExam); //examen
            $course = Course::findOrFail($exam->course_id); //curso del examen
            $subjects = $user->subjects()->where('course_id', $course->id)->get(); //asignaturas del curso y profesor

            return view('teacher.createOrEditExam', compact('exam', 'course', 'subjects', 'courses'));
            
        }
    }

    public function saveExam(Request $request){
        
        $request->validate([
                'name' => 'required|string|max:255',
                'course_id' => 'required',
                'subject_id' => 'required',
        ]);

        if ($request->has('exam_id')) {
            $exam = Exam::findOrFail($request->exam_id);
            $exam->fill([
                'name' => $request->name,
                'course_id' => $request->course_id,
                'subject_id' => $request->subject_id,
            ]);
            $exam->save();

            return redirect()->route('teacher.showExams')->with('success', 'Examen actualizado correctamente.');

        }else{

            Exam::create([
                'name' => $request->name ,
                'course_id' => $request->course_id,
                'subject_id' => $request->subject_id,
        ]);

            return redirect()->route('teacher.showExams')->with('success', 'Examen creado correctamente.');

        }
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