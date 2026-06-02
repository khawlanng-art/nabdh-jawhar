<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Builder;
class Service extends Model
{
    protected $table = 'services';
    protected $primaryKey = 'ServiceID';
public $timestamps = false;
    protected $fillable = [
        'ServiceName',
        'Description',
        'BasePrice',
        'CategoryName',
        'IconURL',
        'IsActive',
        'CreatedAt'
    ];


}
