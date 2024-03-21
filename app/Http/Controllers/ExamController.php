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

       return view('showExams', compact('courses'));
   }


   public function createOrEditExam($idExam = null) {

        $user = Auth::user();
        $courses = $user->courses()->get();//cursos del profesor

        if ($idExam == null) {

            $subjects = $courses->isNotEmpty() ? $user->subjects()->where('course_id', $courses[0]->id)->get() : collect();

            return view('createOrEditExam', compact('courses', 'subjects'));     
                   
        } else {
            $exam = Exam::findOrFail($idExam);
            $course = Course::findOrFail($exam->course_id);
            $subjects = $user->subjects()->where('course_id', $course->id)->get(); //asignaturas del curso y profesor

            return view('createOrEditExam', compact('exam', 'course', 'subjects', 'courses'));
            
        }
    }

    public function saveExam(Request $request){
        
        $request->validate([
                'name' => 'required|string|max:255',
                'course_id' => 'required',
                'subject_id' => 'required',
        ]);

        Exam::create([
            'name' => $request->name ,
            'course_id' => $request->course_id,
            'subject_id' => $request->subject_id,
        ]);

        return redirect()->route('showExams');
    }


   public function deleteExam(){

        
   }
}