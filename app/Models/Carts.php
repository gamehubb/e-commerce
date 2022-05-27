<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carts extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'product_id', 'product_name', 'category_id', 'image', 'quantity', 'price', 'total_amount', 'color', 'discount'];
}