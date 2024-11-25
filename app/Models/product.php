<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class product extends Model
{
    protected $fillable = [
        'product_name',
        'sku',
        'price',
        'description',
        'image',
        'status',

    ];
}
