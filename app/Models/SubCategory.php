<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class SubCategory extends Model
{
    use HasFactory; 
    protected $table = 'subcategories';
    protected $fillable = ['name','category_id'];

    //Category can have manay SubCategory so the subcategory is now belongsTo category
    public function category(){
        return $this->belongsTo(Category::class);
    }

}
 