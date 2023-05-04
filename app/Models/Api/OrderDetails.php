<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    protected $fillable = [
        'user_id', 'add_to_cart_id', 'order_no', 'order_id', 'tip', 'discount', 'delivery_fee', 'customer_phone',
        'total_price', 'shipping_address', 'payment_status', 'order_status', 'transaction_no', 'table_no', 'send_to_kitchen'
    ];

    // protected $casts = [
    //     'add_to_cart_id' => 'array'
    // ];
}
