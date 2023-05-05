<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topping extends Model
{
    protected $fillable = [
        'regular_toppings',
        'regular_topping_price',
        'regular_toppings',
        'less_price',
        'regular_topping_price_18',
        'less_price_18',
        'normal_price',
        'normal_price_18',
        'extra_price',
        'extra_price_18',
        'cheese',
        'cheese_price',
        'cheese_price_18',
        'sauce',
        'sauce_price_18'
    ];
}
