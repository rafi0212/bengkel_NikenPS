<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Menjalankan UserSeeder untuk memasukkan data user
        $this->call([
            UserSeeder::class,
        ]);
    }
}
