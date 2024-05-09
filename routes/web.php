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
        Route::get('admin/users', [UserController::class, 'showUsers'])->name('administrator.showUsers');
        Route::get('admin/users/add',  [UserController::class, 'addUserForm'])->name('administrator.addUserForm');
        Route::post('admin/users/add',  [UserController::class, 'addUser'])->name('administrator.addUser');
        Route::get('admin/users/edit/{userId}', [UserController::class, 'showEditUsersForm'])->name('administrator.editUser');
        Route::put('admin/update-users', [UserController::class, 'updateUsers'])->name('administrator.updateUser');
        Route::post('admin/save-users', [UserController::class, 'saveUsers'])->name('administrator.saveUser');
        Route::delete('admin/users/delete/{userId}', [UserController::class, 'deleteUser'])->name('administrator.deleteUser');

    // Rutas para la gestión de perfiles
        Route::get('admin/profiles', [ProfileController::class, 'showProfiles'])->name('administrator.showProfiles');
        Route::get('admin/profiles/add',  [ProfileController::class, 'addProfileForm'])->name('administrator.addProfileForm');
        Route::post('admin/profiles/add',  [ProfileController::class, 'addProfile'])->name('administrator.addProfile');
        Route::get('admin/profiles/edit/{profileId}', [ProfileController::class, 'showEditProfileForm'])->name('administrator.editProfile');
        Route::put('admin/update-profile', [ProfileController::class, 'updateProfile'])->name('administrator.updateProfile');    
        Route::delete('admin/profiles/delete/{profileId}', [ProfileController::class, 'deleteProfile'])->name('administrator.deleteProfile');    


    // Rutas para la gestión de cursos
        Route::get('admin/courses', [CourseController::class, 'showCourses'])->name('administrator.showCourses');
        Route::get('admin/courses/add', [CourseController::class, 'addCourseForm'])->name('administrator.addCourseForm');
        Route::post('admin/courses/add', [CourseController::class, 'addCourse'])->name('administrator.addCourse');
        Route::get('admin/courses/edit/{courseId}', [CourseController::class, 'showEditCourseForm'])->name('administrator.editCourse');
        Route::put('admin/update-course', [CourseController::class, 'updateCourse'])->name('administrator.updateCourse');
        Route::delete('admin/courses/delete/{courseId}', [CourseController::class, 'deleteCourse'])->name('administrator.deleteCourse');
    
    // Rutas para la gestión de asignaturas
        Route::get('admin/subjects', [SubjectController::class, 'showSubjects'])->name('administrator.showSubjects');
        Route::get('admin/subjects/add', [SubjectController::class, 'addSubjectForm'])->name('administrator.addSubjectForm');
        Route::post('admin/subjects/add', [SubjectController::class, 'addSubject'])->name('administrator.addSubject');
        Route::get('admin/subjects/edit/{subjectId}', [SubjectController::class, 'showEditSubjectForm'])->name('administrator.editSubject');
        Route::put('admin/update-subjects', [SubjectController::class, 'updateSubject'])->name('administrator.updateSubject');
        Route::delete('admin/subjects/delete/{subjectId}', [SubjectController::class, 'deleteSubject'])->name('administrator.deleteSubject');

    });


    // TEACHER
    Route::middleware('can:teacherAccess')->group(function () {
    // Rutas para la gestión de cursos y asignaturas del profesor
        Route::get('teacher/courses', [CourseController::class, 'showCoursesByTeacher'])->name('teacher.showCoursesByTeacher');
        Route::get('teacher/courses/{courseId}/subjects', [CourseController::class, 'showSubjectsInCourse'])->name('teacher.showSubjectsInCourse');
        Route::get('teacher/users-in-subject/{subjectId}', [SubjectController::class, 'showUsersInSubject'])->name('teacher.showUsersInSubject');

    // Rutas para la gestión de notas
        Route::get('teacher/add-notes/{subjectId}', [NoteController::class, 'showAddNotesForm'])->name('teacher.addNotes');
        Route::post('teacher/save-notes', [NoteController::class, 'saveNotes'])->name('teacher.saveNotes');
        Route::get('teacher/edit-notes/{userId}/{subjectId}', [NoteController::class, 'showEditNotesForm'])->name('teacher.editNotes');
        Route::post('teacher/update-notes', [NoteController::class, 'updateNotes'])->name('teacher.updateNotes');
        Route::delete('teacher/delete-note', [NoteController::class, 'deleteNote'])->name('teacher.deleteNote');
    
    // Rutas para la gestión de exámenes
        Route::get('teacher/exams', [ExamController::class, 'showExams'])->name('teacher.showExams');
        Route::get('teacher/exams/create', [ExamController::class, 'createExam'])->name('teacher.createExam');
        Route::post('teacher/exams', [ExamController::class, 'storeExam'])->name('teacher.storeExam');
        Route::get('teacher/exams/edit/{idExam}', [ExamController::class, 'editExam'])->name('teacher.editExam');
        Route::put('teacher/exams/{exam}', [ExamController::class, 'updateExam'])->name('teacher.updateExam');
        Route::delete('teacher/exams/{exam}', [ExamController::class, 'deleteExam'])->name('teacher.deleteExam');
        Route::post('teacher/exams', [ExamController::class, 'saveExam'])->name('teacher.saveNewExam');


    // Recuperar asignaturas por curso
        Route::get('teacher/courses/{courseId}/get-subjects-json', [CourseController::class, 'getSubjectJson']);

    });
    

    // STUDENT
    Route::middleware('can:studentAccess')->group(function () {
        // Asignaturas del Alumno
        Route::get('student/subjects', [SubjectController::class, 'showSubjectsByStudent'])->name('student.showSubjectsByStudent');

        // Notas del Alumno para la asignatura
        Route::get('student/notes/{subjectId}', [NoteController::class, 'showNotesBySubject'])->name('student.showNotesBySubject');
    });
});