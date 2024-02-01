<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $profiles = [
            ['name' => 'Administrator'],
            ['name' => 'Teacher'],
            ['name' => 'Student'],
        ];

        DB::table('profiles')->insert($profiles);
    }
}
