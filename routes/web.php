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
Route::get('reports', function () { 
    Gate::authorize('seeReports'); 
    return view('reports');
})->name('reports');

/* Route::get('notes', function () {
    Gate::authorize('addNotes'); 
    return view('addNotes');
})->name('addNotes'); */

Route::get('courses', [CourseController::class, 'showCourses']) //primer parámetro es la ruta el navegador, el segudno es el controlador y la función que se utiliza
    ->middleware('can:showCourses') // Puedes usar middleware en lugar de Gate::authorize
    ->name('showCourses');

Route::get('subjects', [SubjectController::class, 'mySubjects']) //primer parámetro es la ruta el navegador, el segudno es el controlador y la función que se utiliza
    ->middleware('can:mySubjects') // Puedes usar middleware en lugar de Gate::authorize
    ->name('mySubjects');

Route::get('notes/{subject_id}', [NoteController::class, 'showNotesBySubject'])
    ->name('showNotesBySubject'); // Ver asignaturas del alumno logueado

