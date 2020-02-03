<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillDetail extends Model
{
    protected $table = 'bill_detail';
    protected $fillable = ['id', 'bill_id', 'product_id', 'quantity', 'product_price', 'total', 'created_at', 'updated_at', 'deleted_at'];
}
