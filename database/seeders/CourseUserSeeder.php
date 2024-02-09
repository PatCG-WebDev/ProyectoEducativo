<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courseUser = [
            /* ['user_id' => 1, 'course_id' => null], */
            //Teacher
            ['user_id' => 2, 'course_id' => 1],
            ['user_id' => 2, 'course_id' => 2],
            ['user_id' => 2, 'course_id' => 3],
            ['user_id' => 2, 'course_id' => 4],

            ['user_id' => 3, 'course_id' => 1],
            ['user_id' => 3, 'course_id' => 2],
            ['user_id' => 3, 'course_id' => 3],

            ['user_id' => 4, 'course_id' => 4],
            ['user_id' => 4, 'course_id' => 5],
            ['user_id' => 4, 'course_id' => 6],

            ['user_id' => 5, 'course_id' => 4],
            ['user_id' => 5, 'course_id' => 5],
            ['user_id' => 5, 'course_id' => 6],

            //Student
            ['user_id' => 6, 'course_id' => 1],
            ['user_id' => 7, 'course_id' => 1],
            ['user_id' => 8, 'course_id' => 1],

            ['user_id' => 9, 'course_id' => 2],
            ['user_id' => 10, 'course_id' => 2],
            ['user_id' => 11, 'course_id' => 2],

            ['user_id' => 12, 'course_id' => 3],
            ['user_id' => 13, 'course_id' => 3],

            ['user_id' => 14, 'course_id' => 4],
            ['user_id' => 15, 'course_id' => 4],

            ['user_id' => 16, 'course_id' => 5],
            ['user_id' => 17, 'course_id' => 5],

            ['user_id' => 18, 'course_id' => 6],
            ['user_id' => 19, 'course_id' => 6],
            ['user_id' => 20, 'course_id' => 6],
        ];

        DB::table('course_user')->insert($courseUser);
    }
}
