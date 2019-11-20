<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    protected $fillable = ['name', 'slug', 'color', 'size', 'origin_price', 'sale_price', 'category_id', 'quantity','content', 'user_id', 'status', 'created_at', ];
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
    public function image(){
        return $this->hasMany('App\Models\ProductImage')->latest();
    }
    public function quantitys(){
        return $this->hasMany('App\Models\ProductQuantity');
    }
}
