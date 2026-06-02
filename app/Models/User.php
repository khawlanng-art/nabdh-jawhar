<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Order;
class User extends Authenticatable
{
    use Notifiable;


protected $primaryKey = 'UserID';
public $incrementing = true;
    protected $fillable = [
        'Username',
        'email',
        'password',
        'Role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];


    public function profile()
    {
        return $this->hasOne(ProfileUser::class, 'UserID', 'UserID');
    }

  public function orders() {
    return $this->hasMany(Order::class, 'nurse_id', 'UserID');
}

// أضيفي هذه الخاصية (Accessor) لحساب التقييم فقط
public function getAverageRatingAttribute()
{
    // حساب التقييم من جدول الطلبات مباشرة دون تحميل بيانات الـ review
    return $this->orders()->avg('rating') ?? 0;
}

}
