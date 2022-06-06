<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Carts;
use App\Models\Cart;
use App\Models\SubCategory;
use App\Models\ProductDetail;
use Illuminate\Http\Request;

use Auth;

class FrontProductListController extends Controller
{
    public function index()
    {
        $products = Product::latest()->where('status', 1)->limit(6)->get();
        $randomActiveProducts = Product::inRandomOrder()->limit(3)->get();
        $randomActiveProductId = [];
        foreach ($randomActiveProducts as $product) {
            array_push($randomActiveProductId, $product->id);
        }
        $randomItemProducts = Product::whereNotIn('id', $randomActiveProductId)->limit(3)->get();
        $categories = Category::get();
        $brands = Brand::get();

        $sliders = Product::where('is_special', '1')->get();

        return view('product', compact('products', 'categories', 'brands', 'randomItemProducts', 'randomActiveProducts', 'sliders'));
    }
    public function show($id)
    {
        $product = Product::find($id);
        $productFromSameCategories = Product::inRandomOrder()->where('category_id', $product->category_id)->where('id', '!=', $product->id)->limit(3)->get();
        return view('show', compact('product', 'productFromSameCategories'));
    }
    public function allProductByCategory($slug)
    {
        $id = Category::where('slug', $slug)->pluck('id');
        $products = Product::where('category_id', $id)->get();
        return view('filteredProduct', compact('products'));
    }
    public function allProductByBrand($slug)
    {
        $id = Brand::where('slug', $slug)->pluck('id');
        $products = Product::where('brand_id', $id)->get();
        return view('filteredProduct', compact('products'));
    }
    public function productDetail($id)
    {
        $products = Product::where('id', $id)->get()->first();
        $cat_products = Product::where('category_id', $products->category_id)->get();
        if ($products == '') {
            return abort('404');
        } else {
            return view('productDetail', compact('products', 'cat_products'));
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