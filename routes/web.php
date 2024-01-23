<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Gate; 
use App\Http\Controllers\UserController;


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
    Gate::authorize('see-reports'); 
    return view('reports');
})->name('reports');

Route::get('grades', function () {
    Gate::authorize('ad-grades'); 
    return view('grades');
})->name('grades');


Route::get('subjects', function () {
    Gate::authorize('my-subjects'); 
    return view('subjects');
})->name('subjects');



/* Route::get('reports', [UserController::class, 'showReports'])->name('reports');
 */
//muestra asignaturas de alumno logueado
/* Route::get('/mis-asignaturas', [UserController::class, 'mySubjects'])->name('my-subjects'); */