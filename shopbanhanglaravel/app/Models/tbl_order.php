<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_order extends Model
{
    use HasFactory;
    protected $fillable = ['order_id', 'customer_id', 'shipping_id'
    ,'payment_id', 'order_total', 'order_status'];
}
