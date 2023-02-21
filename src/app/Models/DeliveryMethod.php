<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryMethod extends Model
{
    protected $fillable = [
        'name',
    ];

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    public static function getPackageDropId()
    {
        return 1;
    }

    public static function getRecieveId()
    {
        return 2;
    }
}
