<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;


class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = ['order_id','product_id','product_name','product_image','product_type','vendor_id','color','quantity','price',
    'discount'];

    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function vendor()
    {
        return $this->hasOne(User::class, 'id', 'vendor_id');
    }
}
