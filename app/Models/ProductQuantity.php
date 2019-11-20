<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductQuantity extends Model
{
    protected $table = 'product_quantity';
    protected $fillable = ['product_id', 'size', 'quantity', 'created_at', 'deleted_at', 'updated_at'];
    use SoftDeletes;
    public function product(){
        return $this->belongsTo('App\Models\Product');
    }
}
