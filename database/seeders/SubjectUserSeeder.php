<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subjectUser = [
            //admin
            ['user_id' => 1, 'subject_id' => 1],

            //Teacher
            ['user_id' => 2, 'subject_id' => 1],
            ['user_id' => 2, 'subject_id' => 3],
            ['user_id' => 2, 'subject_id' => 5],
            ['user_id' => 2, 'subject_id' => 7],

            ['user_id' => 3, 'subject_id' => 2],
            ['user_id' => 3, 'subject_id' => 4],
            ['user_id' => 3, 'subject_id' => 6],

            ['user_id' => 4, 'subject_id' => 7],
            ['user_id' => 4, 'subject_id' => 9],
            ['user_id' => 4, 'subject_id' => 11],

            ['user_id' => 5, 'subject_id' => 8],
            ['user_id' => 5, 'subject_id' => 10],
            ['user_id' => 5, 'subject_id' => 12],

            //Student
            ['user_id' => 6, 'subject_id' => 1],
            ['user_id' => 6, 'subject_id' => 2],
            ['user_id' => 7, 'subject_id' => 1],
            ['user_id' => 7, 'subject_id' => 2],
            ['user_id' => 8, 'subject_id' => 1],
            ['user_id' => 8, 'subject_id' => 2],

            ['user_id' => 9, 'subject_id' => 3],
            ['user_id' => 9, 'subject_id' => 4],
            ['user_id' => 10, 'subject_id' => 3],
            ['user_id' => 10, 'subject_id' => 4],
            ['user_id' => 11, 'subject_id' => 3],
            ['user_id' => 11, 'subject_id' => 4],

            ['user_id' => 12, 'subject_id' => 5],
            ['user_id' => 12, 'subject_id' => 6],
            ['user_id' => 13, 'subject_id' => 5],
            ['user_id' => 13, 'subject_id' => 6],

            ['user_id' => 14, 'subject_id' => 7],
            ['user_id' => 14, 'subject_id' => 8],
            ['user_id' => 15, 'subject_id' => 7],
            ['user_id' => 15, 'subject_id' => 8],

            ['user_id' => 16, 'subject_id' => 9],
            ['user_id' => 16, 'subject_id' => 10],
            ['user_id' => 17, 'subject_id' => 9],
            ['user_id' => 17, 'subject_id' => 10],

            ['user_id' => 18, 'subject_id' => 11],
            ['user_id' => 18, 'subject_id' => 12],
            ['user_id' => 19, 'subject_id' => 11],
            ['user_id' => 19, 'subject_id' => 12],
            ['user_id' => 20, 'subject_id' => 11],
            ['user_id' => 20, 'subject_id' => 12],
        ];

        DB::table('subject_user')->insert($subjectUser);
    }
}
