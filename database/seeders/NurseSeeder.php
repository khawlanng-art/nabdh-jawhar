<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\ProfileUser;
use Illuminate\Support\Facades\Hash;

class NurseSeeder extends Seeder
{
    public function run()
    {
        $nurses = [
            ['Username' => 'أحمد خالد باوزير', 'email' => 'ahmed.bawazeer@nursehub.com', 'password' => 'Ahmed@123', 'PhoneNumber' => '771234501', 'Specialization' => 'العناية المركزة والطوارئ', 'HospitalOrCenter' => 'مستشفى ابن سينا', 'Gender' => 'Male', 'City' => 'المكلا', 'Address' => 'فوة - شارع ابن سينا'],
            ['Username' => 'أروى سالم باعباد', 'email' => 'arwa.baabad@nursehub.com', 'password' => 'Arwa@123', 'PhoneNumber' => '771234502', 'Specialization' => 'الأطفال وحديثي الولادة', 'HospitalOrCenter' => 'مستشفى المكلا للأمومة والطفولة', 'Gender' => 'Female', 'City' => 'المكلا', 'Address' => 'باشراحيل - شارع المستشفى'],
            ['Username' => 'ريم سعيد بن هادي', 'email' => 'reem.hadi@nursehub.com', 'password' => 'Reem@123', 'PhoneNumber' => '771234503', 'Specialization' => 'النساء والتوليد', 'HospitalOrCenter' => 'مستشفى العرب التخصصي', 'Gender' => 'Female', 'City' => 'المكلا', 'Address' => 'المكلا الجديدة - مقابل الجسر البحري'],
            ['Username' => 'محمد عمر بلحاج', 'email' => 'mohamed.belhaj@nursehub.com', 'password' => 'Mohamed@123', 'PhoneNumber' => '771234504', 'Specialization' => 'الصحة النفسية والعقلية', 'HospitalOrCenter' => 'مستوصف النور الطبي التخصصي', 'Gender' => 'Male', 'City' => 'المكلا', 'Address' => 'الديس - شارع الستين'],
            ['Username' => 'وليد عبدالله باكثير', 'email' => 'waleed.bakathir@nursehub.com', 'password' => 'Waleed@123', 'PhoneNumber' => '771234505', 'Specialization' => 'صحة المجتمع', 'HospitalOrCenter' => 'مستوصف المدينة', 'Gender' => 'Male', 'City' => 'المكلا', 'Address' => 'السلام - شارع السلام'],
            ['Username' => 'سالم حسين بارجاء', 'email' => 'salem.barjaa@nursehub.com', 'password' => 'Salem@123', 'PhoneNumber' => '771234506', 'Specialization' => 'الباطني والجراحي', 'HospitalOrCenter' => 'مستشفى البرج الاستشاري', 'Gender' => 'Male', 'City' => 'المكلا', 'Address' => 'الديس - شارع الغويزي'],
            ['Username' => 'ماريا أحمد باشراحيل', 'email' => 'maria.bashraheel@nursehub.com', 'password' => 'Maria@123', 'PhoneNumber' => '771234507', 'Specialization' => 'الأمراض المزمنة', 'HospitalOrCenter' => 'برج الصفوة الطبي الاستشاري', 'Gender' => 'Female', 'City' => 'المكلا', 'Address' => 'خور المكلا - باجعمان'],
            ['Username' => 'خولة عمر باجابر', 'email' => 'khawla.bajaber@nursehub.com', 'password' => 'Khawla@123', 'PhoneNumber' => '771234508', 'Specialization' => 'صحة الأم والطفل', 'HospitalOrCenter' => 'مستشفى حضرموت الحديث', 'Gender' => 'Female', 'City' => 'المكلا', 'Address' => 'فوة - شارع الأربعين'],
        ];
$statuses = ['Available', 'Offline', 'Busy', 'Pending'];
        foreach ($nurses as $nurseData) {
            $user = User::create([
                'Username' => $nurseData['Username'],
                'email'    => $nurseData['email'],
                'password' => Hash::make($nurseData['password']),
                'Role'     => 'Nurse',
                'Status'   => $statuses[array_rand($statuses)],
            ]);

            ProfileUser::create([
                'UserID'           => $user->UserID,
                'PhoneNumber'      => $nurseData['PhoneNumber'],
                'Gender'           => $nurseData['Gender'],
                'DateOfBirth'      => now()->subYears(rand(25, 45))->subDays(rand(1, 300))->format('Y-m-d'),
                'Address'          => $nurseData['Address'],
                'City'             => $nurseData['City'],
                'HospitalOrCenter' => $nurseData['HospitalOrCenter'],
                'Specialization'   => $nurseData['Specialization'],
            ]);
        }
    }
}
