<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
  public function run()
{
    $services = [
        ['ServiceName' => 'العطاء والإبر', 'Description' => 'تقديم الإبر للمريض في الوقت المحدد بطريقة آمنة.', 'BasePrice' => 2000, 'CategoryName' => 'تمريض', 'IsActive' => true],
        ['ServiceName' => 'قياس الضغط والسكر', 'Description' => 'متابعة الحالة الصحية للمريض بشكل مستمر.', 'BasePrice' => 1000, 'CategoryName' => 'رعاية', 'IsActive' => true],
        ['ServiceName' => 'تغيير الضمادات والجروح', 'Description' => 'تنظيف الجروح وتبديل الضمادات للمساعدة على الشفاء.', 'BasePrice' => 3000, 'CategoryName' => 'تمريض', 'IsActive' => true],
        ['ServiceName' => 'متابعة المرضى بعد العمليات', 'Description' => 'مراقبة حالة المريض بعد الجراحة والتأكد من تحسنه.', 'BasePrice' => 3500, 'CategoryName' => 'رعاية', 'IsActive' => true],
        ['ServiceName' => 'جلسات علاج طبيعي في المنزل', 'Description' => 'مساعدة المريض على تحسين الحركة وتقوية الجسم.', 'BasePrice' => 5000, 'CategoryName' => 'رعاية', 'IsActive' => true],
        ['ServiceName' => 'خدمة الأمومة والطفولة', 'Description' => 'متابعة صحة الأمهات والأطفال.', 'BasePrice' => 4000, 'CategoryName' => 'رعاية', 'IsActive' => true],
        ['ServiceName' => 'سحب العينات والتحاليل', 'Description' => 'أخذ عينات الدم من المنزل بسهولة.', 'BasePrice' => 1500, 'CategoryName' => 'تمريض', 'IsActive' => true],
        ['ServiceName' => 'تركيب المحاليل الطبية', 'Description' => 'تقديم المحاليل والعلاجات الوريدية داخل المنزل.', 'BasePrice' => 1500, 'CategoryName' => 'تمريض', 'IsActive' => true],
    ];

    foreach ($services as $service) {
        \App\Models\Service::create($service);
    }
}
}
