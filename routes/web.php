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
        Route::get('admin/users', [UserController::class, 'showUsers'])->name('administrator.show_users');
        Route::get('admin/users/add',  [UserController::class, 'addUserForm'])->name('administrator.add_user_form');
        Route::post('admin/users/add',  [UserController::class, 'addUser'])->name('administrator.add_user');
        Route::get('admin/users/edit/{userId}', [UserController::class, 'showEditUsersForm'])->name('administrator.edit_user');
        Route::put('admin/update-users', [UserController::class, 'updateUsers'])->name('administrator.update_user');
        Route::post('admin/save-users', [UserController::class, 'saveUsers'])->name('administrator.save_user');
        Route::delete('admin/users/delete/{userId}', [UserController::class, 'deleteUser'])->name('administrator.delete_user');

    // Rutas para la gestión de perfiles
        Route::get('admin/profiles', [ProfileController::class, 'showProfiles'])->name('administrator.show_profiles');
        Route::get('admin/profiles/add',  [ProfileController::class, 'addProfileForm'])->name('administrator.add_profile_form');
        Route::post('admin/profiles/add',  [ProfileController::class, 'addProfile'])->name('administrator.add_profile');
        Route::get('admin/profiles/edit/{profileId}', [ProfileController::class, 'showEditProfileForm'])->name('administrator.edit_profile');
        Route::put('admin/update-profile', [ProfileController::class, 'updateProfile'])->name('administrator.update_profile');    
        Route::delete('admin/profiles/delete/{profileId}', [ProfileController::class, 'deleteProfile'])->name('administrator.delete_profile');    


    // Rutas para la gestión de cursos
        Route::get('admin/courses', [CourseController::class, 'showCourses'])->name('administrator.show_courses');
        Route::get('admin/courses/add', [CourseController::class, 'addCourseForm'])->name('administrator.add_course_form');
        Route::post('admin/courses/add', [CourseController::class, 'addCourse'])->name('administrator.add_course');
        Route::get('admin/courses/edit/{courseId}', [CourseController::class, 'showEditCourseForm'])->name('administrator.edit_course');
        Route::put('admin/update-course', [CourseController::class, 'updateCourse'])->name('administrator.update_course');
        Route::delete('admin/courses/delete/{courseId}', [CourseController::class, 'deleteCourse'])->name('administrator.delete_course');
    
    // Rutas para la gestión de asignaturas
        Route::get('admin/subjects', [SubjectController::class, 'showSubjects'])->name('administrator.show_subjects');
        Route::get('admin/subjects/add', [SubjectController::class, 'addSubjectForm'])->name('administrator.add_subject_form');
        Route::post('admin/subjects/add', [SubjectController::class, 'addSubject'])->name('administrator.add_subject');
        Route::get('admin/subjects/edit/{subjectId}', [SubjectController::class, 'showEditSubjectForm'])->name('administrator.edit_subject');
        Route::put('admin/update-subjects', [SubjectController::class, 'updateSubject'])->name('administrator.update_subject');
        Route::delete('admin/subjects/delete/{subjectId}', [SubjectController::class, 'deleteSubject'])->name('administrator.delete_subject');

    });


    // TEACHER
    Route::middleware('can:teacherAccess')->group(function () {
    // Rutas para la gestión de cursos y asignaturas del profesor
        Route::get('teacher/courses', [CourseController::class, 'showCoursesByTeacher'])->name('teacher.show_courses_by_teacher');
        Route::get('teacher/courses/{courseId}/subjects', [CourseController::class, 'showSubjectsInCourse'])->name('teacher.show_subjects_in_course');
        Route::get('teacher/users-in-subject/{subjectId}', [SubjectController::class, 'showUsersInSubject'])->name('teacher.show_users_in_subject');

    // Rutas para la gestión de notas
        Route::get('teacher/add-notes/{subjectId}', [NoteController::class, 'showAddNotesForm'])->name('teacher.add_notes');
        Route::post('teacher/save-notes', [NoteController::class, 'saveNotes'])->name('teacher.save_notes');
        Route::get('teacher/edit-notes/{userId}/{subjectId}', [NoteController::class, 'showEditNotesForm'])->name('teacher.edit_notes');
        Route::post('teacher/update-notes', [NoteController::class, 'updateNotes'])->name('teacher.update_notes');
        Route::delete('teacher/delete-note', [NoteController::class, 'deleteNote'])->name('teacher.delete_note');
    
    // Rutas para la gestión de exámenes
        Route::get('teacher/exams', [ExamController::class, 'showExams'])->name('teacher.show_exams');
        Route::get('teacher/exams/create', [ExamController::class, 'createExam'])->name('teacher.create_exam');
        Route::post('teacher/exams', [ExamController::class, 'storeExam'])->name('teacher.store_exam');
        Route::get('teacher/exams/edit/{idExam}', [ExamController::class, 'editExam'])->name('teacher.edit_exam');
        Route::put('teacher/exams/{exam}', [ExamController::class, 'updateExam'])->name('teacher.update_exam');
        Route::delete('teacher/exams/{exam}', [ExamController::class, 'deleteExam'])->name('teacher.delete_exam');
        Route::post('teacher/exams', [ExamController::class, 'saveExam'])->name('teacher.save_exam');


    // Recuperar asignaturas por curso
        Route::get('teacher/courses/{courseId}/get-subjects-json', [CourseController::class, 'getSubjectJson']);

    });
    

    // STUDENT
    Route::middleware('can:studentAccess')->group(function () {
        // Asignaturas del Alumno
        Route::get('student/subjects', [SubjectController::class, 'showSubjectsByStudent'])->name('student.show_subjects_by_student');

        // Notas del Alumno para la asignatura
        Route::get('student/notes/{subjectId}', [NoteController::class, 'showNotesBySubject'])->name('student.show_notes_by_subject');
    });
});