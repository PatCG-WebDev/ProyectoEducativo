<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subjects = [
            ['name' => 'Matemáticas 1 ESO','course_id' => 1],
            ['name' => 'Lengua 1 ESO','course_id' => 1],
            ['name' => 'Matemáticas 2 ESO','course_id' => 2],
            ['name' => 'Lengua 2 ESO','course_id' => 2],
            ['name' => 'Matemáticas 3 ESO','course_id' => 3],
            ['name' => 'Lengua 3 ESO','course_id' => 3],
            ['name' => 'Matemáticas 4 ESO','course_id' => 4],
            ['name' => 'Lengua 4 ESO','course_id' => 4],
            ['name' => 'Matemáticas 1 BACH','course_id' => 5],
            ['name' => 'Lengua 1 BACH','course_id' => 5],
            ['name' => 'Matemáticas 2 BACH','course_id' => 6],
            ['name' => 'Lengua 2 BACH','course_id' => 6],
        ];

        DB::table('subjects')->insert($subjects);
    }
}
