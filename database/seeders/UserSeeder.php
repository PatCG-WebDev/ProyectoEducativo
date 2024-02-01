<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            ['profile_id' => 1, 'name' => 'Admin', 'email' => 'admin@gmail.com', 'password' => Hash::make('12345678')],
            ['profile_id' => 2, 'name' => 'D.Pedro', 'email' => 'pedro@gmail.com', 'password' => Hash::make('12345678')],
            ['profile_id' => 2, 'name' => 'D.Rosa', 'email' => 'rosa@gmail.com', 'password' => Hash::make('12345678')],
            ['profile_id' => 2, 'name' => 'D.Mercedes', 'email' => 'mercedes@gmail.com', 'password' => Hash::make('12345678')],
            ['profile_id' => 2, 'name' => 'D.Manuel', 'email' => 'manuel@gmail.com', 'password' => Hash::make('12345678')],
            ['profile_id' => 3, 'name' => 'Ana', 'email' => 'ana@gmail.com', 'password' => Hash::make('12345678')],
            ['profile_id' => 3, 'name' => 'Andrea', 'email' => 'andrea@gmail.com', 'password' => Hash::make('12345678')],
            ['profile_id' => 3, 'name' => 'Rafael', 'email' => 'Rafael@gmail.com', 'password' => Hash::make('12345678')],
            ['profile_id' => 3, 'name' => 'Daniel', 'email' => 'daniel@gmail.com', 'password' => Hash::make('12345678')],
            ['profile_id' => 3, 'name' => 'Mateo', 'email' => 'mateo@gmail.com', 'password' => Hash::make('12345678')],
            ['profile_id' => 3, 'name' => 'Isabel', 'email' => 'isabel@gmail.com', 'password' => Hash::make('12345678')],
            ['profile_id' => 3, 'name' => 'Marcos', 'email' => 'marcos@gmail.com', 'password' => Hash::make('12345678')],
            ['profile_id' => 3, 'name' => 'Andrés', 'email' => 'andres@gmail.com', 'password' => Hash::make('12345678')],
            ['profile_id' => 3, 'name' => 'Marta', 'email' => 'marta@gmail.com', 'password' => Hash::make('12345678')],
            ['profile_id' => 3, 'name' => 'Julia', 'email' => 'julia@gmail.com', 'password' => Hash::make('12345678')],
            ['profile_id' => 3, 'name' => 'Jose', 'email' => 'jose@gmail.com', 'password' => Hash::make('12345678')],
            ['profile_id' => 3, 'name' => 'Carlos', 'email' => 'carlos@gmail.com', 'password' => Hash::make('12345678')],
            ['profile_id' => 3, 'name' => 'Raquel', 'email' => 'raquel@gmail.com', 'password' => Hash::make('12345678')],
            ['profile_id' => 3, 'name' => 'Almudena', 'email' => 'almudena@gmail.com', 'password' => Hash::make('12345678')],
            ['profile_id' => 3, 'name' => 'Rocío', 'email' => 'rocio@gmail.com', 'password' => Hash::make('12345678')],
        ];

        DB::table('users')->insert($users);
    }
}
