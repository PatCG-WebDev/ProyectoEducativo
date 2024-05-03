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
            ['name' => 'Administrador'],
            ['name' => 'Docente'],
            ['name' => 'Estudiante'],
        ];

        DB::table('profiles')->insert($profiles);
    }
}
