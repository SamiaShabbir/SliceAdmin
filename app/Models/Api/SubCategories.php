<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Model;

class SubCategories extends Model
{
    //
    protected $fillable = [
        'category_id', 'sub_cat_name'
    ];
}
