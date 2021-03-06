<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;


class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name','slug','description','image','status','is_special'];

    public function category(){
        return $this->belongsTo(Product::class);
    }
  
}
 