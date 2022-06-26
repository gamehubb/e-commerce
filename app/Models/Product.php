<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Brand;
use App\Models\ProductDetail;
use App\Models\OrderItem;
use App\Models\Slider;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'vendor', 'code', 'slug', 'description', 'image', 'price', 'additional_info', 'moto', 'category_id', 'brand_id', 'user_id', 'subcategory_id', 'wireless'];

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function brand()
    {
        return $this->hasOne(Brand::class, 'id', 'brand_id');
    }

    public function productDetail()
    {
        return $this->hasMany(ProductDetail::class, 'product_id', 'id');
    }

    public function order_items()
    {
        return $this->belongsTo(OrderItem::class, 'product_id', 'id');
    }

    public function slider()
    {
        return $this->hasOne(Slider::class, 'product_id', 'id');
    }
}