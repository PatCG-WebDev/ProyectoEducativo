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
            ['user_id' => 6, 'subject_id' => 1, 'value' => 5.25, 'exam' => '1', 'comment' => 'Puedes hacerlo mejor. Ánimo!'],
            ['user_id' => 6, 'subject_id' => 1, 'value' => 7.50, 'exam' => '2', 'comment' => 'Mucho mejor'],
            ['user_id' => 6, 'subject_id' => 1, 'value' => 6.75, 'exam' => '3', 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 6, 'subject_id' => 2, 'value' => 6.75, 'exam' => '1', 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 6, 'subject_id' => 2, 'value' => 8.25, 'exam' => '2', 'comment' => 'Bien hecho! Sigue así!'],
            ['user_id' => 6, 'subject_id' => 2, 'value' => 7.50, 'exam' => '3', 'comment' => 'xxxxxxxxxx'],

            ['user_id' => 7, 'subject_id' => 1, 'value' => 7.25, 'exam' => '1', 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 7, 'subject_id' => 1, 'value' => 7.25, 'exam' => '2', 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 7, 'subject_id' => 2, 'value' => 8.50, 'exam' => '1', 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 7, 'subject_id' => 2, 'value' => 8.50, 'exam' => '2', 'comment' => 'xxxxxxxxxx'],

            ['user_id' => 8, 'subject_id' => 1, 'value' => 5.00, 'exam' => '1', 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 8, 'subject_id' => 1, 'value' => 5.00, 'exam' => '2', 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 8, 'subject_id' => 2, 'value' => 6.15, 'exam' => '1', 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 8, 'subject_id' => 2, 'value' => 6.15, 'exam' => '2', 'comment' => 'xxxxxxxxxx'],

            ['user_id' => 9, 'subject_id' => 3, 'value' => 7.25, 'exam' => '1', 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 9, 'subject_id' => 3, 'value' => 7.25, 'exam' => '2', 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 9, 'subject_id' => 4, 'value' => 5.50, 'exam' => '1', 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 9, 'subject_id' => 4, 'value' => 5.50, 'exam' => '2', 'comment' => 'xxxxxxxxxx'],

            ['user_id' => 10, 'subject_id' => 3, 'value' => 8.75, 'exam' => '1', 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 10, 'subject_id' => 3, 'value' => 7.25, 'exam' => '2', 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 10, 'subject_id' => 4, 'value' => 5.50, 'exam' => '1', 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 10, 'subject_id' => 4, 'value' => 9.25, 'exam' => '2', 'comment' => 'xxxxxxxxxx'],

            ['user_id' => 11, 'subject_id' => 3, 'value' => 6.50, 'exam' => '1', 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 11, 'subject_id' => 3, 'value' => 7.25, 'exam' => '2', 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 11, 'subject_id' => 4, 'value' => 5.50, 'exam' => '1', 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 11, 'subject_id' => 4, 'value' => 5.75, 'exam' => '2', 'comment' => 'xxxxxxxxxx'],

            ['user_id' => 12, 'subject_id' => 5, 'value' => 5.00, 'exam' => '1', 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 12, 'subject_id' => 5, 'value' => 5.00, 'exam' => '2', 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 12, 'subject_id' => 6, 'value' => 5.25, 'exam' => '1', 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 12, 'subject_id' => 6, 'value' => 5.25, 'exam' => '2', 'comment' => 'xxxxxxxxxx'],

            ['user_id' => 13, 'subject_id' => 5, 'value' => 7.25, 'exam' => '1', 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 13, 'subject_id' => 5, 'value' => 5.00, 'exam' => '2', 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 13, 'subject_id' => 6, 'value' => 5.25, 'exam' => '1', 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 13, 'subject_id' => 6, 'value' => 8.50, 'exam' => '2', 'comment' => 'xxxxxxxxxx'],

            ['user_id' => 14, 'subject_id' => 7, 'value' => 7.50, 'exam' => '1', 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 14, 'subject_id' => 7, 'value' => 7.50, 'exam' => '2', 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 14, 'subject_id' => 8, 'value' => 7.25, 'exam' => '1', 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 14, 'subject_id' => 8, 'value' => 7.25, 'exam' => '2', 'comment' => 'xxxxxxxxxx'],

            ['user_id' => 15, 'subject_id' => 7, 'value' => 6.75, 'exam' => '1', 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 15, 'subject_id' => 7, 'value' => 7.50, 'exam' => '2', 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 15, 'subject_id' => 8, 'value' => 7.25, 'exam' => '1', 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 15, 'subject_id' => 8, 'value' => 6.00, 'exam' => '2', 'comment' => 'xxxxxxxxxx'],

            ['user_id' => 16, 'subject_id' => 9, 'value' => 5.75, 'exam' => '1', 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 16, 'subject_id' => 9, 'value' => 5.75, 'exam' => '2', 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 16, 'subject_id' => 10, 'value' => 6.75, 'exam' => '1', 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 16, 'subject_id' => 10, 'value' => 6.75, 'exam' => '2', 'comment' => 'xxxxxxxxxx'],

            ['user_id' => 17, 'subject_id' => 9, 'value' => 8.75, 'exam' => '1', 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 17, 'subject_id' => 9, 'value' => 5.75, 'exam' => '2', 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 17, 'subject_id' => 10, 'value' => 6.75, 'exam' => '1', 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 17, 'subject_id' => 10, 'value' => 8.25, 'exam' => '2', 'comment' => 'xxxxxxxxxx'],

            ['user_id' => 18, 'subject_id' => 11, 'value' => 7.25, 'exam' => '1', 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 18, 'subject_id' => 11, 'value' => 7.25, 'exam' => '2', 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 18, 'subject_id' => 12, 'value' => 5.50, 'exam' => '1', 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 18, 'subject_id' => 12, 'value' => 5.50, 'exam' => '2', 'comment' => 'xxxxxxxxxx'],

            ['user_id' => 19, 'subject_id' => 11, 'value' => 8.75, 'exam' => '1', 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 19, 'subject_id' => 11, 'value' => 7.25, 'exam' => '2', 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 19, 'subject_id' => 12, 'value' => 5.50, 'exam' => '1', 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 19, 'subject_id' => 12, 'value' => 8.25, 'exam' => '2', 'comment' => 'xxxxxxxxxx'],

            ['user_id' => 20, 'subject_id' => 11, 'value' => 6.50, 'exam' => '1', 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 20, 'subject_id' => 11, 'value' => 7.25, 'exam' => '2', 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 20, 'subject_id' => 12, 'value' => 5.50, 'exam' => '1', 'comment' => 'xxxxxxxxxx'],
            ['user_id' => 20, 'subject_id' => 12, 'value' => 8.25, 'exam' => '2', 'comment' => 'xxxxxxxxxx'],
        ];    

        DB::table('notes')->insert($notes);
    }
}
