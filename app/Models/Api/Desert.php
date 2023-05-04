<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Model;

class Desert extends Model
{
    protected $fillable = [
        'name', 'image', 'desert_price', 'desert_quantity',
    ];
}
