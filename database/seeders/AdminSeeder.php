<?php

namespace Database\Seeders;
use App\Models\User;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@nabd.com'], // البحث بهذا الإيميل لمنع التكرار
            [
                'Username' => 'مدير النظام',
                'password' => Hash::make('admin123'), // كلمة المرور الثابتة
                'Role'     => 'Admin',
                'status'   => 'Active',
            ]

        );

    }
}
