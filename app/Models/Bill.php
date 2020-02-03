<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $fillable = ['id', 'user_id', 'total', 'status', 'created_at','updated_at', 'deleted_at'];
}
