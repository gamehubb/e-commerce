<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Category;
use App\Models\Brand;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    protected $allCategory;

    protected $allBrand;

     public function __construct()
    {
        $allCategory = Category::where('status',1)->get();
        $allBrand = Brand::where('status',1)->get();
        view()->share(['allCategory' => $allCategory, 'allBrand' => $allBrand]);   
    }
}
