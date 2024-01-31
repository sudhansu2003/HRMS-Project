<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProjectMapping extends Model
{
    protected $table = 'user_project_mapping';
    protected $fillable = [
        'user_id',
        'project_id',
        'role',
        'status'
    ];
}