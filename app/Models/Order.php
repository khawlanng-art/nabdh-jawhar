<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    // أضيفي هنا كل الأعمدة التي سيتم إدخال بيانات فيها
    protected $fillable = [
        'UserID',
        'nurse_id',
        'service_id',
        'patients_count',
        'service_duration',
        'total_price',
        'status',
        'rating',
        'review'
    ];

    // علاقة الطلب بالمستخدم (صاحب الطلب)
    public function user() {
        return $this->belongsTo(User::class, 'UserID', 'UserID');
    }


    // علاقة الطلب بالممرض
    public function nurse() {
        return $this->belongsTo(User::class, 'nurse_id', 'UserID');
    }

    // علاقة الطلب بالخدمة
    public function service() {
        return $this->belongsTo(Service::class, 'service_id', 'ServiceID');
    }
// في موديل User.php

}
