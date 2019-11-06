<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    protected $fillable = ['name', 'slug', 'origin_price', 'sale_price', 'category_id', 'content', 'user_id', 'status', 'user_id', 'created_at', 'created_at'];
    use SoftDeletes;
    public function category(){
        return $this->belongsTo('App\Models\Category');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function images(){
        return $this->hasMany('App\Models\ProductImage');
    }
}
