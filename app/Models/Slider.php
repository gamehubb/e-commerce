<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Product;


class Slider extends Model
{
    use HasFactory; 
    protected $fillable = ['product_id','name','image'];

    public function products(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
}
