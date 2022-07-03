<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carts extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'product_id','vendor', 'product_name','product_code','category','brand','product_type', 'image', 'quantity', 'price', 'total_amount', 'color', 'discount'];

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function brand()
    {
        return $this->hasOne(Brand::class, 'id', 'brand_id');
    }
}