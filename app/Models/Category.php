<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name','slug','parent_id','user_id'];
    public function products(){
        return $this->hasMany('App\Models\Product');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
}
