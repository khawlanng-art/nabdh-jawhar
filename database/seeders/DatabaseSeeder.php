<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// هذا السطر مهم جداً لجعل الملف يرى AdminSeeder
use Database\Seeders\AdminSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
        ]);
    }
}
