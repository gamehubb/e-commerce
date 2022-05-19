<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Brand;
use App\Models\ProductDetail;


class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name','code','description','image','price','additional_info','category_id','brand_id','user_id','subcategory_id'];

    public function category(){
        return $this->hasOne(Category::class,'id','category_id');
    }

    public function brand(){
        return $this->hasOne(Brand::class, 'id', 'brand_id');
    }

    public function productDetail()
    {
        return $this->hasOne(ProductDetail::class, 'product_id', 'id');
    }

    
} 
