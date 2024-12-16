<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'email' => 'admin@example.com',
                'username' => 'superadmin',
                'password' => Hash::make('password123'),
                'status_pekerjaan' => 'Owner',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'email' => 'kasir@example.com',
                'username' => 'kasiruser',
                'password' => Hash::make('password123'),
                'status_pekerjaan' => 'Kasir',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
