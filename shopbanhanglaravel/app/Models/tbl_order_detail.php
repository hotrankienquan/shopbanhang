<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_order_detail extends Model
{
    use HasFactory;
    protected $fillable = ['order_details_id', 'order_id', 'product_id'
    ,'product_name','product_price', 'product_sales_quantity'];
}
