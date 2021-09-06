<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_category_product extends Model
{
    use HasFactory;
    protected $fillable = ['category_id', 'category_name', 'category_desc', 'category_status'];
}
