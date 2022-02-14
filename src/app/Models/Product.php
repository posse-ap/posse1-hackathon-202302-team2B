<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'version',
        'name',
        'description',
        'thumbnail',
        'image1',
        'quantity',
        'price',
        'is_active',
    ];

    public function order_details()
    {
        return $this->hasMany('App\Models\OrderDetail');
    }

    public function getFormatPriceAttribute()
    {
        return '¥' . number_format($this->price);
    }
}
