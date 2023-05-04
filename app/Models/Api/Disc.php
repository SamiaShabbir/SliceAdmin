<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Model;

class Disc extends Model
{
    protected $fillable = [
        'order_no', 'disc_no', 'product_details_id', 'status'
    ];
}
