<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = ['order_id','product_id','product_name','product_image','product_type','vendor_id','color','quantity','price',
    'discount'];

    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function productDetail()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
