<?php

use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Gate; 
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\NoteController;



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
Route::get('see-reports', function () {
    Gate::authorize('seeReports');
    return view('seeReports');
})->name('seeReports');

/* Route::get('notes', function () {
    Gate::authorize('addNotes'); 
    return view('addNotes');
})->name('addNotes'); */



//Cursos del Profesor
Route::get('courses', [CourseController::class, 'showCoursesByTeacher']) //primer parámetro es la ruta el navegador, el segudno es el controlador y la función que se utiliza
    ->middleware('can:showCoursesByTeacher') // Puedes usar middleware en lugar de Gate::authorize
    ->name('showCoursesByTeacher');

//Asignaturas del Profesor y del Curso
Route::get('courses/{course_id}/subjects', [CourseController::class, 'showSubjectsInCourse'])
    /* ->middleware(['auth', 'can:accessSubjectsInCourse'])  */
    ->name('showSubjectsInCourse');

//Alumnos de la Asignatura
Route::get('users-in-subject/{subject_id}', [SubjectController::class, 'showUsersInSubject'])
    ->middleware('can:showUsersInSubject')
    ->name('showUsersInSubject');

//Añadir notas
Route::get('/add-notes/{subjectId}', [NoteController::class, 'showAddNotesForm'])
    ->middleware('can:addNotes')
    ->name('addNotes');

//Guardar notas
Route::post('/save-notes', [NoteController::class, 'saveNotes'])
    /* ->middleware('can:saveNotes') */
    ->middleware('can:addNotes')
    ->name('saveNotes');

//Asignaturas del Alumno
Route::get('subjects', [SubjectController::class, 'showSubjectsByStudent']) //primer parámetro es la ruta el navegador, el segudno es el controlador y la función que se utiliza
    ->middleware('can:showSubjectsByStudent') // Puedes usar middleware en lugar de Gate::authorize
    ->name('showSubjectsByStudent');

//Notas del Alumno para la asignatura
Route::get('notes/{subject_id}', [NoteController::class, 'showNotesBySubject'])
    ->name('showNotesBySubject'); // Ver asignaturas del alumno logueado
