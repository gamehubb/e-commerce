<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Subcategory;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name','slug','description','image'];

    // How To Think Relation Between Category and SubCategory
    // Category id:1 can have so manay subcategory 
    // SubCategory->like id:1,5,8,100 
    // So it is HasMany Relation
    public function subcategory(){
        return $this->hasMany(Subcategory::class);
    }
}
 