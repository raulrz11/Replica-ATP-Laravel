<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'nombre' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@admin.es',
                'password' => bcrypt('Admin1'),
                'rol' => 'ADMIN',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'User',
                'username' => 'user',
                'email' => 'user@user.es',
                'password' => bcrypt('User1'),
                'rol' => 'USER',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
