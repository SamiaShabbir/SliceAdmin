<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id', 'name', 'image', 'price', 'product_code', 'size1', 'size2', 'stock_status', 'quntity'
    ];
}
