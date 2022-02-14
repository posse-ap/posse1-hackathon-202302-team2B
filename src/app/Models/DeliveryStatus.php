<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryStatus extends Model
{
    protected $fillable = [
        'name',
    ];

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    public function isCancelable()
    {
        return $this->id == self::getInPreparationId() ? true : false;
    }

    public static function getInPreparationId()
    {
        return 1;
    }

    public static function getInTransitId()
    {
        return 2;
    }

    public static function getDeliveredId()
    {
        return 3;
    }

    public static function getCancelingId()
    {
        return 4;
    }

    public static function getCanceledId()
    {
        return 5;
    }
}
