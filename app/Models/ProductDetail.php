<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class ProductDetail extends Model
{
    use HasFactory;
    
    protected $fillable = ['product_id','color','image_1','image_2','image_3','quantity','price','discount','product_type','is_special','status'];

    public function product(){
        return $this->belongsTo(Product::class);
    }

}
