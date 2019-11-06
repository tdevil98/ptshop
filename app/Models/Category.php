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
    //Lấy category con
    public function sub_category()
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }
    //Lấy category cha
    public function parent_category()
    {
        return $this->hasMany(self::class, 'id', 'parent_id');
    }
}
