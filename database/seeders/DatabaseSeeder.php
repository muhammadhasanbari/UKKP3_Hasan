<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'username' => 'admin',
            'password' => 'admin123',
            'role' => User::ROLE_ADMIN,
        ]);

        User::create([
            'username' => 'petugas',
            'password' => 'petugas123',
            'role' => User::ROLE_PETUGAS,
        ]);

        User::create([
            'username' => 'user',
            'password' => 'user123',
            'role' => User::ROLE_USER,
        ]);
    }
}
