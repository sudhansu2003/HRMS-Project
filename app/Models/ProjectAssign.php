<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectAssign extends Model
{
    protected $table = 'project_assigns';
    protected $primaryKey = 'project_id';
    protected $fillable = [
        'project_name',
        'client_name',
        'deal_date',
        'start_date',
        'estimated_delivery_date',
        'early_delivery',
        'late_delivery'
    ];
}
