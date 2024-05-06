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
        Route::get('/users', [UserController::class, 'showUsers'])->name('administrator.showUsers');
        Route::get('users/add',  [UserController::class, 'addUserForm'])->name('administrator.addUserForm');
        Route::post('users/add',  [UserController::class, 'addUser'])->name('administrator.addUser');
        Route::get('users/edit/{userId}', [UserController::class, 'showEditUsersForm'])->name('administrator.editUser');
        Route::put('/update-users', [UserController::class, 'updateUsers'])->name('administrator.updateUser');
        Route::post('/save-users', [UserController::class, 'saveUsers'])->name('administrator.saveUser');
        Route::delete('/users/delete/{userId}', [UserController::class, 'deleteUser'])->name('administrator.deleteUser');

    // Rutas para la gestión de perfiles
        Route::get('/profiles', [ProfileController::class, 'showProfiles'])->name('administrator.showProfiles');
        Route::get('profiles/add',  [ProfileController::class, 'addProfileForm'])->name('administrator.addProfileForm');
        Route::post('profiles/add',  [ProfileController::class, 'addProfile'])->name('administrator.addProfile');
        Route::get('/profiles/edit/{profileId}', [ProfileController::class, 'showEditProfileForm'])->name('administrator.editProfile');
        Route::put('/update-profile', [ProfileController::class, 'updateProfile'])->name('administrator.updateProfile');    
        Route::delete('/profiles/delete/{profileId}', [ProfileController::class, 'deleteProfile'])->name('administrator.deleteProfile');    


    // Rutas para la gestión de cursos
        Route::get('/admi-courses', [CourseController::class, 'adminCourses'])->name('administrator.showCourses');

    // Rutas para la gestión de asignaturas
        Route::get('/admin-subjects', [SubjectController::class, 'adminSubjects'])->name('administrator.showSubjects');
    });


    // TEACHER
    Route::middleware('can:teacherAccess')->group(function () {
    // Rutas para la gestión de cursos y asignaturas del profesor
        Route::get('courses', [CourseController::class, 'showCoursesByTeacher'])->name('teacher.showCoursesByTeacher');
        Route::get('courses/{courseId}/subjects', [CourseController::class, 'showSubjectsInCourse'])->name('teacher.showSubjectsInCourse');
        Route::get('users-in-subject/{subjectId}', [SubjectController::class, 'showUsersInSubject'])->name('teacher.showUsersInSubject');

    // Rutas para la gestión de notas
        Route::get('/add-notes/{subjectId}', [NoteController::class, 'showAddNotesForm'])->name('teacher.addNotes');
        Route::post('/save-notes', [NoteController::class, 'saveNotes'])->name('teacher.saveNotes');
        Route::get('/edit-notes/{userId}/{subjectId}', [NoteController::class, 'showEditNotesForm'])->name('teacher.editNotes');
        Route::post('/update-notes', [NoteController::class, 'updateNotes'])->name('teacher.updateNotes');
        Route::delete('/delete-note', [NoteController::class, 'deleteNote'])->name('teacher.deleteNote');
    
    // Rutas para la gestión de exámenes
        Route::get('exams', [ExamController::class, 'showExams'])->name('teacher.showExams');
        Route::get('exams/create', [ExamController::class, 'createExam'])->name('teacher.createExam');
        Route::post('exams', [ExamController::class, 'storeExam'])->name('teacher.storeExam');
        Route::get('exams/edit/{idExam}', [ExamController::class, 'editExam'])->name('teacher.editExam');
        Route::put('exams/{exam}', [ExamController::class, 'updateExam'])->name('teacher.updateExam');
        Route::delete('exams/{exam}', [ExamController::class, 'deleteExam'])->name('teacher.deleteExam');
        Route::post('/exams', [ExamController::class, 'saveExam'])->name('teacher.saveNewExam');


    // Recuperar asignaturas por curso
        Route::get('courses/{courseId}/get-subjects-json', [CourseController::class, 'getSubjectJson']);

    });
    

    // STUDENT
    Route::middleware('can:studentAccess')->group(function () {
        // Asignaturas del Alumno
        Route::get('subjects', [SubjectController::class, 'showSubjectsByStudent'])
            ->name('student.showSubjectsByStudent');

        // Notas del Alumno para la asignatura
        Route::get('notes/{subjectId}', [NoteController::class, 'showNotesBySubject'])
            ->name('student.showNotesBySubject');
    });
});