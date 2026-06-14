<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\ProfileUser;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $patients = [
            ['Username' => 'عمر سالم بارشيد', 'PhoneNumber' => '712345678', 'DateOfBirth' => '1992-03-12', 'Gender' => 'Male', 'Address' => 'حي السلام', 'City' => 'المكلا', 'email' => 'omar@example.com'],
            ['Username' => 'نورة عبدالله العطاس', 'PhoneNumber' => '773456789', 'DateOfBirth' => '1998-07-25', 'Gender' => 'Female', 'Address' => 'حي الشهيد', 'City' => 'المكلا', 'email' => 'noora@example.com'],
            ['Username' => 'صالح علي باوزير', 'PhoneNumber' => '734567890', 'DateOfBirth' => '1985-11-02', 'Gender' => 'Male', 'Address' => 'حي الشرج', 'City' => 'المكلا', 'email' => 'saleh@example.com'],
            ['Username' => 'منى خالد العمودي', 'PhoneNumber' => '705678901', 'DateOfBirth' => '2000-01-19', 'Gender' => 'Female', 'Address' => 'حي بلفقيه', 'City' => 'المكلا', 'email' => 'mona@example.com'],
            ['Username' => 'سعيد حسين باحارثه', 'PhoneNumber' => '796789012', 'DateOfBirth' => '1979-09-08', 'Gender' => 'Male', 'Address' => 'حي فوه', 'City' => 'المكلا', 'email' => 'saeed@example.com'],
            ['Username' => 'هدى عوض باعباد', 'PhoneNumber' => '717890123', 'DateOfBirth' => '1994-04-30', 'Gender' => 'Female', 'Address' => 'حي الديس', 'City' => 'المكلا', 'email' => 'huda@example.com'],
            ['Username' => 'محمد صالح بن الشيخ', 'PhoneNumber' => '778901234', 'DateOfBirth' => '1982-12-14', 'Gender' => 'Male', 'Address' => 'حي الإنشاءات', 'City' => 'المكلا', 'email' => 'mohammed@example.com'],
            ['Username' => 'ليلى عمر باجابر', 'PhoneNumber' => '739012345', 'DateOfBirth' => '1996-06-21', 'Gender' => 'Female', 'Address' => 'حي السلام', 'City' => 'المكلا', 'email' => 'layla@example.com'],
        ];

        foreach ($patients as $data) {
            // 1. إنشاء المستخدم
            $user = User::create([
                'Username' => $data['Username'],
                'email' => $data['email'],
                'password' => Hash::make('password123'),
            ]);

            // 2. إنشاء البروفايل المرتبط
            ProfileUser::create([
                'UserID'           => $user->UserID,
                'PhoneNumber' => $data['PhoneNumber'],
                'DateOfBirth' => $data['DateOfBirth'],
                'Gender' => $data['Gender'],
                'Address' => $data['Address'],
                'City' => $data['City'],
            ]);
        }
    }
}
