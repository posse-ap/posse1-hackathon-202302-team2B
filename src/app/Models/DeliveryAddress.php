<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeliveryAddress extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'name',
        'tel',
        'sort_number',
        'postal_code',
        'prefecture',
        'city',
        'address_1',
        'address_2',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    public function getFullAddressAttribute()
    {
        return "{$this->prefecture} {$this->city} {$this->address_1} {$this->address_2}";
    }
}
