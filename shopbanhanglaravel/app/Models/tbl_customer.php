<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_customer extends Model
{
    use HasFactory;
    protected $fillable = ['customer_id','customer_email', 'customer_name', 'customer_password', 'customer_phone'];
}
