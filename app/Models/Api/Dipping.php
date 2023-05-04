<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Model;

class Dipping extends Model
{
    protected $fillable = [
        'id', 'dipping_name', 'dipping_image', 'dipping_quantity', 'dipping_price'
    ];
}
