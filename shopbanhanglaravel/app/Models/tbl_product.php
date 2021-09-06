<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_product extends Model
{
    use HasFactory;
    protected $fillable =[
    'product_id',
    'category_id',
    'brand_id',
    'product_content',
    'product_price',
    'product_image',
    'product_size',
    'product_status',
    'product_name',
    'product_desc'
    ];
}
