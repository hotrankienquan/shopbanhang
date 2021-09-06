<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_payment extends Model
{
    use HasFactory;
    protected $fillable = ['payment_id', 'payment_method', 'payment_status'];
}
