<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carts extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'product_id', 'product_name','product_code','category','brand','product_type', 'image', 'quantity', 'price', 'total_amount', 'color', 'discount'];
}