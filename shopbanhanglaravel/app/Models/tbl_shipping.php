<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_shipping extends Model
{
    use HasFactory;
    protected $fillable = [
        'shipping_id','shipping_name','shipping_notes', 'shipping_address'
        ,'shipping_email', 'shipping_phone'
    ];
}
