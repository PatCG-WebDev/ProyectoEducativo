<?php

// app/Http/Controllers/Api/CourseController.php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function getCourses()
    {
        // Ejemplo de lista de cursos
        $courses = [
            ['id' => 1, 'name' => 'Matemáticas', 'teacher' => 'Prof. García'],
            ['id' => 2, 'name' => 'Historia', 'teacher' => 'Prof. Martínez'],
            ['id' => 3, 'name' => 'Física', 'teacher' => 'Prof. Sánchez'],
        ];

        // Devuelve la lista de cursos como JSON
        return response()->json($courses);
    }
}

