<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileUser extends Model
{

    protected $table = 'profile_users';


   protected $fillable = [
    'UserID', 'PhoneNumber', 'Gender', 'DateOfBirth', 'Address','City',
    'HospitalOrCenter', 'Specialization', 'ProfilePicture',
     'HealthCertificate',
];

    public function user()
    {
        return $this->belongsTo(User::class, 'UserID', 'UserID');
    }
}
