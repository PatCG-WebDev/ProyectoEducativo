<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjectCourse = [

            //ESO
            ['course_id' => 1, 'subject_id' => 1],
            ['course_id' => 1, 'subject_id' => 2],

            ['course_id' => 2, 'subject_id' => 3],
            ['course_id' => 2, 'subject_id' => 4],

            ['course_id' => 3, 'subject_id' => 5],
            ['course_id' => 3, 'subject_id' => 6],

            ['course_id' => 4, 'subject_id' => 7],
            ['course_id' => 4, 'subject_id' => 8],

            ['course_id' => 5, 'subject_id' => 9],
            ['course_id' => 5, 'subject_id' => 10],
            
            ['course_id' => 6, 'subject_id' => 11],
            ['course_id' => 6, 'subject_id' => 12],
        ];

        DB::table('subject_course')->insert($subjectCourse);
    }
    
}
