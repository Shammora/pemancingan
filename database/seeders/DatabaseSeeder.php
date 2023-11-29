<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name'	=> 'Admin',
            'email'	=> 'admin@app.com',
            'password'	=> bcrypt('password'),
            'username' => 'admin',
            'no_hp' => null,
            'foto' => null,
            'peran' => 'Admin',
        ]);
        DB::table('users')->insert([
            'name'	=> 'Pemancingan',
            'email'	=> 'pemancingan@app.com',
            'password'	=> bcrypt('password'),
            'username' => 'pemancingan',
            'no_hp' => null,
            'foto' => null,
            'peran' => 'Pihak Pemancingan',
        ]);
        DB::table('users')->insert([
            'name'	=> 'Pemancing',
            'email'	=> 'pemancing@app.com',
            'password'	=> bcrypt('password'),
            'username' => 'pemancing',
            'no_hp' => null,
            'foto' => null,
            'peran' => 'Pemancing',
        ]);
    }
}
