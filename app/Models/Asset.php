<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $fillable = [
        'name',
        'purchase_date',
        'supported_date',
        'amount',
        'description',
        'created_by',
    ];

}
