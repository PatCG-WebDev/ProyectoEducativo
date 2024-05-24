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


Route::middleware(['auth', 'verified'])->group(function () {

    // Rutas para el administrador
    Route::middleware('can:administratorAccess')->group(function () {
        // Rutas para la gestión de usuarios
        Route::prefix('admin/users')->group(function () {
            Route::get('/', [UserController::class, 'showUsers'])->name('administrator.show_users');
            Route::get('add', [UserController::class, 'addUserForm'])->name('administrator.add_user_form');
            Route::post('add', [UserController::class, 'addUser'])->name('administrator.add_user');
            Route::get('edit/{userId}', [UserController::class, 'showEditUsersForm'])->name('administrator.edit_user');
            Route::put('update', [UserController::class, 'updateUsers'])->name('administrator.update_user');
            Route::delete('delete/{userId}', [UserController::class, 'deleteUser'])->name('administrator.delete_user');
        });

        // Rutas para la gestión de perfiles
        Route::prefix('admin/profiles')->group(function () {
            Route::get('/', [ProfileController::class, 'showProfiles'])->name('administrator.show_profiles');
            Route::get('add', [ProfileController::class, 'addProfileForm'])->name('administrator.add_profile_form');
            Route::post('add', [ProfileController::class, 'addProfile'])->name('administrator.add_profile');
            Route::get('edit/{profileId}', [ProfileController::class, 'showEditProfileForm'])->name('administrator.edit_profile');
            Route::put('update', [ProfileController::class, 'updateProfile'])->name('administrator.update_profile');
            Route::delete('delete/{profileId}', [ProfileController::class, 'deleteProfile'])->name('administrator.delete_profile');
        });

        // Rutas para la gestión de cursos
        Route::prefix('admin/courses')->group(function () {
            Route::get('/', [CourseController::class, 'showCourses'])->name('administrator.show_courses');
            Route::get('add', [CourseController::class, 'addCourseForm'])->name('administrator.add_course_form');
            Route::post('add', [CourseController::class, 'addCourse'])->name('administrator.add_course');
            Route::get('edit/{courseId}', [CourseController::class, 'showEditCourseForm'])->name('administrator.edit_course');
            Route::put('update', [CourseController::class, 'updateCourse'])->name('administrator.update_course');
            Route::delete('delete/{courseId}', [CourseController::class, 'deleteCourse'])->name('administrator.delete_course');
        });

        // Rutas para la gestión de asignaturas
        Route::prefix('admin/subjects')->group(function () {
            Route::get('/', [SubjectController::class, 'showSubjects'])->name('administrator.show_subjects');
            Route::get('add', [SubjectController::class, 'addSubjectForm'])->name('administrator.add_subject_form');
            Route::post('add', [SubjectController::class, 'addSubject'])->name('administrator.add_subject');
            Route::get('edit/{subjectId}', [SubjectController::class, 'showEditSubjectForm'])->name('administrator.edit_subject');
            Route::put('update', [SubjectController::class, 'updateSubject'])->name('administrator.update_subject');
            Route::delete('delete/{subjectId}', [SubjectController::class, 'deleteSubject'])->name('administrator.delete_subject');
        });
    });

    // Rutas para el profesor
    Route::middleware('can:teacherAccess')->group(function () {
        // Rutas para la gestión de cursos y asignaturas del profesor
        Route::prefix('teacher')->group(function () {
            Route::get('courses', [CourseController::class, 'showCoursesByTeacher'])->name('teacher.show_courses_by_teacher');
            Route::get('courses/{courseId}/subjects', [CourseController::class, 'showSubjectsInCourse'])->name('teacher.show_subjects_in_course');
            Route::get('users-in-subject/{subjectId}', [SubjectController::class, 'showUsersInSubject'])->name('teacher.show_users_in_subject');

            // Rutas para la gestión de notas
            Route::prefix('notes')->group(function () {
                Route::get('add/{subjectId}', [NoteController::class, 'showAddNotesForm'])->name('teacher.add_notes');
                Route::post('save', [NoteController::class, 'saveNotes'])->name('teacher.save_notes');
                Route::get('edit/{userId}/{subjectId}', [NoteController::class, 'showEditNotesForm'])->name('teacher.edit_notes');
                Route::post('update', [NoteController::class, 'updateNotes'])->name('teacher.update_notes');
                Route::delete('delete', [NoteController::class, 'deleteNote'])->name('teacher.delete_note');
            });

            // Rutas para la gestión de exámenes
            Route::prefix('exams')->group(function () {
                Route::get('/', [ExamController::class, 'showExams'])->name('teacher.show_exams');
                Route::get('create', [ExamController::class, 'createExam'])->name('teacher.create_exam');
                Route::post('store', [ExamController::class, 'storeExam'])->name('teacher.store_exam');
                Route::get('edit/{idExam}', [ExamController::class, 'editExam'])->name('teacher.edit_exam');
                Route::put('update/{exam}', [ExamController::class, 'updateExam'])->name('teacher.update_exam');
                Route::delete('delete/{exam}', [ExamController::class, 'deleteExam'])->name('teacher.delete_exam');
                Route::post('save', [ExamController::class, 'saveExam'])->name('teacher.save_exam');
            });

            // Recuperar asignaturas por curso
            Route::get('courses/{courseId}/get-subjects-json', [CourseController::class, 'getSubjectJson']);
        });
    });

    // Rutas para el estudiante
    Route::middleware('can:studentAccess')->group(function () {
        Route::prefix('student')->group(function () {
            // Asignaturas del Alumno
            Route::get('subjects', [SubjectController::class, 'showSubjectsByStudent'])->name('student.show_subjects_by_student');
            // Notas del Alumno para la asignatura
            Route::get('notes/{subjectId}', [NoteController::class, 'showNotesBySubject'])->name('student.show_notes_by_subject');
        });
    });
});