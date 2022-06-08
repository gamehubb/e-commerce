<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = ['order_id','product_id','product_name','product_image','product_type','vendor_id','color','quantity','price',
    'discount'];

    public function orders(){
        return $this->belongsTo(Order::class,'order_id','id');
    }

}
