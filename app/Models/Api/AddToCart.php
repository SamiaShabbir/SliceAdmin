<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Model;

class AddToCart extends Model
{
    protected $fillable = [
        'product_id', 'pizza_image', 'pizza_name', 'quantity', 'user_id', 'size', 'price', 'drinks', 'order_no', 'add_cart_to_order_status', 'drink_size', 'drink_quantity', 'drink_price', 'cheese_pizza_side', 'cheese', 'cheese_price', 'sauce', 'sauce_price', 'topping_pizza_side', 'topping_type', 'regular_toppings', 'regular_topping_price', 'extra_dressing', 'ex_dressing_price', 'appitizer', 'appitizer_price', 'dipping_name', 'dipping_price', 'dipping_quantity',
        'desserts_name',
        'desserts_price',
        'desserts_quantity',
        'type',
        'drinks_json',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
