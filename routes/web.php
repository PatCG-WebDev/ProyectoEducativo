<?php

use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Gate; 
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ExamController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

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

///////



////////////////////////////////////////////////////////////////////////////////////////////////
Route::middleware(['auth', 'verified'])->group(function () {

    // ADMINISTRATOR
    Route::middleware('can:adminAccess')->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
        Route::get('/profiles', [ProfileController::class, 'index'])->name('admin.profiles.index');
        Route::get('/courses', [CourseController::class, 'index'])->name('admin.courses.index');
        Route::get('/subjects', [SubjectController::class, 'index'])->name('admin.subjects.index');
    });

    // TEACHER
    Route::middleware('can:teacherAccess')->group(function () {
        // Cursos del Profesor
        Route::get('courses', [CourseController::class, 'showCoursesByTeacher'])
            ->name('showCoursesByTeacher');

        // Asignaturas del Profesor y del Curso
        Route::get('courses/{course_id}/subjects', [CourseController::class, 'showSubjectsInCourse'])
            ->name('showSubjectsInCourse');

        // Alumnos de la Asignatura
        Route::get('users-in-subject/{subject_id}', [SubjectController::class, 'showUsersInSubject'])
            ->name('showUsersInSubject');

        // Añadir notas
        Route::get('/add-notes/{subjectId}', [NoteController::class, 'showAddNotesForm'])
            ->name('addNotes');

        // Guardar notas
        Route::post('/save-notes', [NoteController::class, 'saveNotes'])
            ->name('saveNotes');
    });

    // STUDENT
    Route::middleware('can:studentAccess')->group(function () {
        // Asignaturas del Alumno
        Route::get('subjects', [SubjectController::class, 'showSubjectsByStudent'])
            ->name('showSubjectsByStudent');

        // Notas del Alumno para la asignatura
        Route::get('notes/{subject_id}', [NoteController::class, 'showNotesBySubject'])
            ->name('showNotesBySubject');
    });
});