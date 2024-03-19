<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Exam;
use App\Models\Course;
use App\Models\Subject;

class ExamController extends Controller
{
    public function showExams(){

       
       $user = Auth::user();
       
       $courses = $user->courses()->with('exams')->get();

       return view('showExams', compact('courses'));
   }


   public function createOrEditExam($idExam = null) {
    
    if ($idExam) {
        
        $exam = Exam::findOrFail($idExam);
        $course = Course::findOrFail($exam->course_id);
        $subject = Subject::findOrFail($exam->subject_id);
        return view('createOrEditExam', compact('exam', 'course', 'subject'));
    } else {
        
        return view('createOrEditExam');
    }
}
   public function deleteExam(){
    
   }
}