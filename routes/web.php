<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Gate; 
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\UserController;



Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('no-autorizado', function(){
    return "Acceso denegado";
});



////////////////////////////////////////////////////////////////////////////////////////////////
Route::middleware(['auth', 'verified'])->group(function () {

    // ADMINISTRATOR
    Route::middleware('can:administratorAccess')->group(function () {
    // Rutas para la gestión de usuarios 
        Route::get('/users', [UserController::class, 'showUsers'])->name('administrator.adminUsers');
        Route::get('/add-user', [UserController::class, 'addUserForm'])->name('administrator.addUser');
        Route::get('/admin-users/edit', [UserController::class, 'adminUsers'])->name('administrator.adminUsers');
        Route::get('/update-users', [UserController::class, 'adminUsers'])->name('administrator.adminUsers');
        Route::get('/save-users', [UserController::class, 'adminUsers'])->name('administrator.adminUsers');

    // Rutas para la gestión de perfiles
        Route::get('/admin-profiles', [ProfileController::class, 'adminProfiles'])->name('administrator.adminProfiles');
        
    // Rutas para la gestión de cursos
        Route::get('/admi-courses', [CourseController::class, 'adminCourses'])->name('administrator.adminCourses');

    // Rutas para la gestión de asignaturas
        Route::get('/admin-subjects', [SubjectController::class, 'adminSubjects'])->name('administrator.adminSubjects');
    });


    // TEACHER
    Route::middleware('can:teacherAccess')->group(function () {
    // Rutas para la gestión de cursos y asignaturas del profesor
        Route::get('courses', [CourseController::class, 'showCoursesByTeacher'])->name('teacher.showCoursesByTeacher');
        Route::get('courses/{course_id}/subjects', [CourseController::class, 'showSubjectsInCourse'])->name('teacher.showSubjectsInCourse');
        Route::get('users-in-subject/{subject_id}', [SubjectController::class, 'showUsersInSubject'])->name('teacher.showUsersInSubject');

    // Rutas para la gestión de notas
        Route::get('/add-notes/{subjectId}', [NoteController::class, 'showAddNotesForm'])->name('teacher.addNotes');
        Route::post('/save-notes', [NoteController::class, 'saveNotes'])->name('teacher.saveNotes');
        Route::get('/edit-notes/{userId}/{subjectId}', [NoteController::class, 'showEditNotesForm'])->name('teacher.editNotes');
        Route::post('/update-notes', [NoteController::class, 'updateNotes'])->name('teacher.updateNotes');
        Route::post('/delete-note', [NoteController::class, 'deleteNote'])->name('teacher.deleteNote');
    
    // Rutas para la gestión de exámenes
        Route::get('exams', [ExamController::class, 'showExams'])->name('teacher.showExams');
        Route::get('exams/{idExam}/edit', [ExamController::class, 'createOrEditExam'])->name('teacher.editExam');
        Route::get('exams/edit', [ExamController::class, 'createOrEditExam'])->name('teacher.createExam');
        Route::post('/exams', [ExamController::class, 'saveExam'])->name('teacher.saveNewExam');
        Route::put('/exams/{exam}', [ExamController::class, 'saveExam'])->name('teacher.updateExam');
        Route::delete('exams/delete', [ExamController::class, 'deleteExam'])->name('teacher.deleteExam');

    // Recuperar asignaturas por curso
        Route::get('courses/{course_id}/get-subjects-json', [CourseController::class, 'getSubjectJson']);

    });
    

    // STUDENT
    Route::middleware('can:studentAccess')->group(function () {
        // Asignaturas del Alumno
        Route::get('subjects', [SubjectController::class, 'showSubjectsByStudent'])
            ->name('student.showSubjectsByStudent');

        // Notas del Alumno para la asignatura
        Route::get('notes/{subject_id}', [NoteController::class, 'showNotesBySubject'])
            ->name('student.showNotesBySubject');
    });
});