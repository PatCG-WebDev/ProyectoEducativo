<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courses = [
            ['name' => '1 ESO'],
            ['name' => '2 ESO'],
            ['name' => '3 ESO'],
            ['name' => '4 ESO'],
            ['name' => '1 BACH'],
            ['name' => '2 BACH'],
        ];

        DB::table('courses')->insert($courses);
    }
}
