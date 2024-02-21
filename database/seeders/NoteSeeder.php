<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $notes = [
            ['user_id' => 6, 'subject_id' => 1, 'value' => 4.25, 'exam_id' => 1, 'comment' => 'Puedes hacerlo mejor. Ánimo!'],
            ['user_id' => 6, 'subject_id' => 1, 'value' => 7.50, 'exam_id' => 2, 'comment' => 'Mucho mejor'],
            ['user_id' => 6, 'subject_id' => 1, 'value' => 6.75, 'exam_id' => 3, 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 6, 'subject_id' => 2, 'value' => 4.75, 'exam_id' => 19, 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 6, 'subject_id' => 2, 'value' => 8.25, 'exam_id' => 20, 'comment' => 'Bien hecho! Sigue así!'],
            ['user_id' => 6, 'subject_id' => 2, 'value' => 7.50, 'exam_id' => 21, 'comment' => 'xxxxxxxxxx'],

            ['user_id' => 7, 'subject_id' => 1, 'value' => 7.75, 'exam_id' => 1, 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 7, 'subject_id' => 1, 'value' => 5.55, 'exam_id' => 2, 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 7, 'subject_id' => 1, 'value' => 7.25, 'exam_id' => 3, 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 7, 'subject_id' => 2, 'value' => 8.15, 'exam_id' => 19, 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 7, 'subject_id' => 2, 'value' => 7.50, 'exam_id' => 20, 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 7, 'subject_id' => 2, 'value' => 6.35, 'exam_id' => 21, 'comment' => 'xxxxxxxxxx'],

            ['user_id' => 8, 'subject_id' => 1, 'value' => 5.75, 'exam_id' => 1, 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 8, 'subject_id' => 1, 'value' => 3.25, 'exam_id' => 2, 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 8, 'subject_id' => 1, 'value' => 6.75, 'exam_id' => 3, 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 8, 'subject_id' => 2, 'value' => 4.15, 'exam_id' => 19, 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 8, 'subject_id' => 2, 'value' => 7.25, 'exam_id' => 20, 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 8, 'subject_id' => 2, 'value' => 6.75, 'exam_id' => 21, 'comment' => 'xxxxxxxxxx'],

            ['user_id' => 9, 'subject_id' => 3, 'value' => 7.00, 'exam_id' => 4, 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 9, 'subject_id' => 3, 'value' => 6.75, 'exam_id' => 5, 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 9, 'subject_id' => 3, 'value' => 6.00, 'exam_id' => 6, 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 9, 'subject_id' => 4, 'value' => 4.10, 'exam_id' => 22, 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 9, 'subject_id' => 4, 'value' => 7.75, 'exam_id' => 23, 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 9, 'subject_id' => 4, 'value' => 6.15, 'exam_id' => 24, 'comment' => 'xxxxxxxxxx'],

            ['user_id' => 10, 'subject_id' => 3, 'value' => 5.25, 'exam_id' => 4, 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 10, 'subject_id' => 3, 'value' => 6.50, 'exam_id' => 5, 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 10, 'subject_id' => 3, 'value' => 4.75, 'exam_id' => 6, 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 10, 'subject_id' => 4, 'value' => 6.50, 'exam_id' => 22, 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 10, 'subject_id' => 4, 'value' => 7.75, 'exam_id' => 23, 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 10, 'subject_id' => 4, 'value' => 8.15, 'exam_id' => 24, 'comment' => 'xxxxxxxxxx'],

            ['user_id' => 11, 'subject_id' => 3, 'value' => 6.50, 'exam_id' => 4, 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 11, 'subject_id' => 3, 'value' => 4.50, 'exam_id' => 5, 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 11, 'subject_id' => 3, 'value' => 6.50, 'exam_id' => 6, 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 11, 'subject_id' => 4, 'value' => 7.50, 'exam_id' => 22, 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 11, 'subject_id' => 4, 'value' => 5.75, 'exam_id' => 23, 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 11, 'subject_id' => 4, 'value' => 7.15, 'exam_id' => 24, 'comment' => 'xxxxxxxxxx'],

            ['user_id' => 12, 'subject_id' => 5, 'value' => 3.00, 'exam_id' => 7, 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 12, 'subject_id' => 5, 'value' => 5.00, 'exam_id' => 8, 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 12, 'subject_id' => 5, 'value' => 5.00, 'exam_id' => 9, 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 12, 'subject_id' => 6, 'value' => 5.25, 'exam_id' => 25, 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 12, 'subject_id' => 6, 'value' => 5.25, 'exam_id' => 26, 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 12, 'subject_id' => 6, 'value' => 5.25, 'exam_id' => 27, 'comment' => 'xxxxxxxxxx'],

            ['user_id' => 13, 'subject_id' => 5, 'value' => 4.50, 'exam_id' => 7, 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 13, 'subject_id' => 5, 'value' => 6.00, 'exam_id' => 8, 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 13, 'subject_id' => 5, 'value' => 7.15, 'exam_id' => 9, 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 13, 'subject_id' => 6, 'value' => 5.15, 'exam_id' => 25, 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 13, 'subject_id' => 6, 'value' => 6.25, 'exam_id' => 26, 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 13, 'subject_id' => 6, 'value' => 7.50, 'exam_id' => 27, 'comment' => 'xxxxxxxxxx'],

            ['user_id' => 14, 'subject_id' => 7, 'value' => 5.50, 'exam_id' => 10, 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 14, 'subject_id' => 7, 'value' => 4.50, 'exam_id' => 11, 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 14, 'subject_id' => 7, 'value' => 5.75, 'exam_id' => 12, 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 14, 'subject_id' => 8, 'value' => 4.25, 'exam_id' => 28, 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 14, 'subject_id' => 8, 'value' => 6.25, 'exam_id' => 29, 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 14, 'subject_id' => 8, 'value' => 5.25, 'exam_id' => 30, 'comment' => 'xxxxxxxxxx'],

            ['user_id' => 15, 'subject_id' => 7, 'value' => 7.50, 'exam_id' => 10, 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 15, 'subject_id' => 7, 'value' => 5.50, 'exam_id' => 11, 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 15, 'subject_id' => 7, 'value' => 6.75, 'exam_id' => 12, 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 15, 'subject_id' => 8, 'value' => 5.25, 'exam_id' => 28, 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 15, 'subject_id' => 8, 'value' => 4.75, 'exam_id' => 29, 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 15, 'subject_id' => 8, 'value' => 5.50, 'exam_id' => 30, 'comment' => 'xxxxxxxxxx'],

            ['user_id' => 16, 'subject_id' => 9, 'value' => 5.75, 'exam_id' => 13, 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 16, 'subject_id' => 9, 'value' => 5.00, 'exam_id' => 14, 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 16, 'subject_id' => 9, 'value' => 4.75, 'exam_id' => 15, 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 16, 'subject_id' => 10, 'value' => 6.75, 'exam_id' => 31, 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 16, 'subject_id' => 10, 'value' => 5.15, 'exam_id' => 32, 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 16, 'subject_id' => 10, 'value' => 7.25, 'exam_id' => 33, 'comment' => 'xxxxxxxxxx'],

            ['user_id' => 17, 'subject_id' => 9, 'value' => 6.75, 'exam_id' => 13, 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 17, 'subject_id' => 9, 'value' => 5.25, 'exam_id' => 14, 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 17, 'subject_id' => 9, 'value' => 7.15, 'exam_id' => 15, 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 17, 'subject_id' => 10, 'value' => 4.75, 'exam_id' => 31, 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 17, 'subject_id' => 10, 'value' => 6.15, 'exam_id' => 32, 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 17, 'subject_id' => 10, 'value' => 6.75, 'exam_id' => 33, 'comment' => 'xxxxxxxxxx'],

            ['user_id' => 18, 'subject_id' => 11, 'value' => 7.25, 'exam_id' => 16, 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 18, 'subject_id' => 11, 'value' => 6.75, 'exam_id' => 17, 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 18, 'subject_id' => 11, 'value' => 7.00, 'exam_id' => 18, 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 18, 'subject_id' => 12, 'value' => 6.50, 'exam_id' => 34, 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 18, 'subject_id' => 12, 'value' => 5.50, 'exam_id' => 35, 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 18, 'subject_id' => 12, 'value' => 7.50, 'exam_id' => 36, 'comment' => 'xxxxxxxxxx'],

            ['user_id' => 19, 'subject_id' => 11, 'value' => 8.25, 'exam_id' => 16, 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 19, 'subject_id' => 11, 'value' => 4.25, 'exam_id' => 17, 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 19, 'subject_id' => 11, 'value' => 7.50, 'exam_id' => 18, 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 19, 'subject_id' => 12, 'value' => 5.00, 'exam_id' => 34, 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 19, 'subject_id' => 12, 'value' => 4.50, 'exam_id' => 35, 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 19, 'subject_id' => 12, 'value' => 6.50, 'exam_id' => 36, 'comment' => 'xxxxxxxxxx'],

            ['user_id' => 20, 'subject_id' => 11, 'value' => 5.25, 'exam_id' => 16, 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 20, 'subject_id' => 11, 'value' => 6.75, 'exam_id' => 17, 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 20, 'subject_id' => 11, 'value' => 4.25, 'exam_id' => 18, 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 20, 'subject_id' => 12, 'value' => 4.50, 'exam_id' => 34, 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 20, 'subject_id' => 12, 'value' => 7.50, 'exam_id' => 35, 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 20, 'subject_id' => 12, 'value' => 6.50, 'exam_id' => 36, 'comment' => 'xxxxxxxxxx'],
        ];    

        DB::table('notes')->insert($notes);
    }
}
