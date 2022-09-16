<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Carts;
use App\Models\Cart;
use App\Models\SubCategory;
use App\Models\ProductDetail;
use App\Models\Slider;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

use Auth;

class FrontProductListController extends Controller
{
    public function index()
    {
        $products = Product::latest()->where('status', 1)->limit(6)->get();
        $randomActiveProducts = Product::inRandomOrder()->limit(3)->get();
        $randomActiveProductId = [];
        $product_list = [];
        foreach ($randomActiveProducts as $product) {
            array_push($randomActiveProductId, $product->id);
        }
        $randomItemProducts  = Product::where('id', 70)->get();
        $categories = Category::where('status',1)->get();
        $s_categories = Category::where(['status' => '1', 'is_special' => '1'])->get();

        foreach ($s_categories as $s_category) {
            $product_list[$s_category->id] = Product::where('category_id', $s_category->id)->where('status','1')->with('productDetail')->get();
            
        }

        $brands = Brand::get();

        $sliders = Slider::with('products')->where('status', 1)->limit(5)->get();


        return view('product', compact('products', 'categories', 'brands', 'randomItemProducts', 'randomActiveProducts', 'sliders', 'product_list'));
    }
    public function show($id)
    {
        $product = Product::find($id);
        $productFromSameCategories = Product::inRandomOrder()->where('category_id', $product->category_id)->where('id', '!=', $product->id)->limit(3)->get();
        return view('show', compact('product', 'productFromSameCategories'));
    }
    public function allProductByCategory($slug)
    {
        $cat = Category::where('slug', $slug)->get()->first();
        $products = Product::where('category_id', $cat->id)->where('status','1')->get();
        $name = $cat->name;
        return view('filteredProduct', compact('products', 'name'));
    }
    public function allProductByBrand($slug)
    {
        $brand = Brand::where('slug', $slug)->get()->first();
        $products = Product::where('brand_id', $brand->id)->where('status','1')->get();
        $name = $brand->name;
        return view('filteredProduct', compact('products', 'name'));
    }
    
    public function search(Request $request)
    {
        $name = $request->name;
        $c_products = Product::where("status", 1)->whereHas("Category", function ($query) use ($name) {
            $query->where("name", "like", "%" . $name . "%");
        })->get();
        $b_products = Product::where("status", 1)->whereHas("Brand", function ($query) use ($name) {
            $query->where("name", "like", "%" . $name . "%");
        })->get();

        $p_products = Product::where("status", 1)->where("name", "like", "%" . $name . "%")->get();
        $products = $p_products->merge($b_products)->merge($c_products);
        return view('filteredProduct', compact('products', 'name'));
    }
    public function productDetail($id)
    {

        try {
            $id = Crypt::decrypt($id);
            $products = Product::where('id', $id)->get()->first();
            $cat_products = Product::where('category_id', $products->category_id)->where('id','!=' , $id)->where("status", 1)->get();
            if ($products == '') {
                return abort('404');
            } else {
                return view('productDetail', compact('products', 'cat_products'));
            }
           
        }catch(DecryptException $e){
            abort(404);
        }

      
    }
    public function allProduct($name, Request $request)
    {
        $category = Category::where('slug', $name)->first();
        $categoryId = $category->id;
        $subcategories = SubCategory::where('category_id', $category->id)->get();
        $slug  = $name;
        $filterSubCategories = [];
        if ($request->subcategory) {
            //filter products 
            $products = $this->filterProducts($request);
            $filterSubCategories = $this->getSubcategoriesId($request);
            // return $filterSubCategories;
            return view('category', compact('products', 'subcategories', 'slug', 'filterSubCategories', 'categoryId'));
        } elseif ($request->min || $request->max) {
            $products = $this->filterByPrice($request);
            return view('category', compact('products', 'subcategories', 'slug', 'categoryId'));
        } else {
            $products = Product::where('category_id', $category->id)->get();
            return view('category', compact('products', 'subcategories', 'slug', 'categoryId'));
        }
    }
    public function filterProducts(Request $request)
    {
        $subId = [];
        $subcategory = Subcategory::whereIn('id', $request->subcategory)->get();
        foreach ($subcategory as $sub) {
            array_push($subId, $sub->id);
        }
        $products = Product::whereIn('subcategory_id', $subId)->get();
        return $products;
    }
    public function getSubcategoriesId(Request $request)
    {
        $subId = [];
        $subcategory = Subcategory::whereIn('id', $request->subcategory)->get();
        foreach ($subcategory as $sub) {
            array_push($subId, $sub->id);
        }
        return $subId;
    }
    public function filterByPrice(Request $request)
    {
        $categoryId = $request->categoryId;
        $product = Product::whereBetween('price', [$request->min, $request->max])->where('category_id', $categoryId)->get();
        return $product;
    }
    public function moreProducts(Request $request)
    {
        if ($request->search) {
            $products = Product::where('name', 'like', '%' . $request->search . '%')->orWhere('description', 'like', '%' . $request->search . '%')->orWhere('additional_info', 'like', '%' . $request->search . '%')
                ->paginate(6);
            return view('all-product', compact('products'));
        }
        $products = Product::latest()->paginate(6);
        return view('all-product', compact('products'));
    }
}