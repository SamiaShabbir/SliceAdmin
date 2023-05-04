<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Model;

class Topping extends Model
{
    protected $fillable = [
        'name', 'desc', 'image'
    ];
}
