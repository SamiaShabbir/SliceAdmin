<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Model;

class multiple_tooping extends Model
{
    protected $fillable = [
        'add_to_carts_id', 'topping_pizza_side', 'topping_type', 'regular_toppings', 'regular_topping_price',
    ];
}
