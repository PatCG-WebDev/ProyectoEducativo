<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ExamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $exams = [
            ['name' => 'Trigonometría 1 ESO','course_id' => 1, 'subject_id' => 1],
            ['name' => 'Estadística 1 ESO','course_id' => 1, 'subject_id' => 1],
            ['name' => 'Aritmética 1 ESO','course_id' => 1, 'subject_id' => 1],
            ['name' => 'Trigonometría 2 ESO','course_id' => 2, 'subject_id' => 3],
            ['name' => 'Estadística 2 ESO','course_id' => 2, 'subject_id' => 3],
            ['name' => 'Aritmética 2 ESO','course_id' => 2, 'subject_id' => 3],
            ['name' => 'Trigonometría 3 ESO','course_id' => 3, 'subject_id' => 5],
            ['name' => 'Estadística 3 ESO','course_id' => 3, 'subject_id' => 5],
            ['name' => 'Aritmética 3 ESO','course_id' => 3, 'subject_id' => 5],
            ['name' => 'Trigonometría 4 ESO','course_id' => 4, 'subject_id' => 7],
            ['name' => 'Estadística 4 ESO','course_id' => 4, 'subject_id' => 7],
            ['name' => 'Aritmética 4 ESO','course_id' => 4, 'subject_id' => 7],
            ['name' => 'Trigonometría 1 BACH','course_id' => 5, 'subject_id' => 9],
            ['name' => 'Estadística 1 BACH','course_id' => 5, 'subject_id' => 9],
            ['name' => 'Aritmética 1 BACH','course_id' => 5, 'subject_id' => 9],
            ['name' => 'Trigonometría 2 BACH','course_id' => 6, 'subject_id' => 11],
            ['name' => 'Estadística 2 BACH','course_id' => 6, 'subject_id' => 11],
            ['name' => 'Aritmética 2 BACH','course_id' => 6, 'subject_id' => 11],

            ['name' => 'Literatura 1 ESO','course_id' => 1, 'subject_id' => 2],
            ['name' => 'Ortografía 1 ESO','course_id' => 1, 'subject_id' => 2],
            ['name' => 'Sintaxis 1 ESO','course_id' => 1, 'subject_id' => 2],
            ['name' => 'Literatura 2 ESO','course_id' => 2, 'subject_id' => 4],
            ['name' => 'Ortografía 2 ESO','course_id' => 2, 'subject_id' => 4],
            ['name' => 'Sintaxis 2 ESO','course_id' => 2, 'subject_id' => 4],
            ['name' => 'Literatura 3 ESO','course_id' => 3, 'subject_id' => 6],
            ['name' => 'Ortografía 3 ESO','course_id' => 3, 'subject_id' => 6],
            ['name' => 'Sintaxis 3 ESO','course_id' => 3, 'subject_id' => 6],
            ['name' => 'Literatura 4 ESO','course_id' => 4, 'subject_id' => 8],
            ['name' => 'Ortografía 4 ESO','course_id' => 4, 'subject_id' => 8],
            ['name' => 'Sintaxis 4 ESO','course_id' => 4, 'subject_id' => 8],
            ['name' => 'Literatura 1 BACH','course_id' => 5, 'subject_id' => 10],
            ['name' => 'Ortografía 1 BACH','course_id' => 5, 'subject_id' => 10],
            ['name' => 'Sintaxis 1 BACH','course_id' => 5, 'subject_id' => 10],
            ['name' => 'Literatura 2 BACH','course_id' => 6, 'subject_id' => 12],
            ['name' => 'Ortografía 2 BACH','course_id' => 6, 'subject_id' => 12],
            ['name' => 'Sintaxis 2 BACH','course_id' => 6, 'subject_id' => 12],
            
        ];

        DB::table('exams')->insert($exams);
    }
    
}
