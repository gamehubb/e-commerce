<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Product;
 
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $select_all_products = Product::get();
        $context = ['select_all_products'=>$select_all_products];
        return view('admin.product.index',$context);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $select_category = Category::all();
        $context = ['select_category'=>$select_category];
        return view('admin.product.create',$context);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'product_name' =>'required',
            'product_description' =>'required|min:3',
            'product_image'=>'required|mimes:jpeg,png',
            'product_price'=>'required|numeric',
            'product_additionalinfo'=>'required',
            'category'=> 'required'
        ]);
        $image = $request->file('product_image')->store('public/product');
        Product::create([
            'name'=>$request->product_name,
            'price'=>$request->product_price,
            'description'=>$request->product_description,
            'additional_info'=>$request->product_additionalinfo,
            'category_id'=>$request->category,
            'subcategory_id'=>$request->subcategory,
            'image'=>$image
        ]);
        notify()->success('Product Created Successfully!');
        return redirect('/auth/product/index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $select_product = Product::find($id);
        $select_category = Category::all();
        // $context = ['select_category'=>$select_category];
        $context = ['select_product'=>$select_product,'select_category'=>$select_category];
        return view('admin.product.edit',$context);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->name = $request->product_name;
        $old_image = $product->image;
        $new_image = $request->file('product_image');
        $product->description = $request->product_description;
        $product->price = $request->product_price;
        $product->additional_info = $request->product_additionalinfo;
        $product->category_id = $request->category;
        $product->subcategory_id = $request->subcategory;
        if($new_image != null){
            Storage::delete($old_image);
            $product->image = $request->file('product_image')->store('public/product');
        }
        else{
            $product->name = $request->product_name;
            $product->description = $request->product_description;
            $product->price = $request->product_price;
            $product->additional_info = $request->product_additionalinfo;
            $product->category_id = $request->category;
            $product->subcategory_id = $request->subcategory;
            $product->image = $old_image;

        }
        $product->save();
        notify()->success('Product Updated Successfully');
        return redirect('/auth/product/index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $filename = $product->image;
        $product->delete();
        Storage::delete($filename);
        notify()->success('Category Deleted Successfully');
        return redirect('/auth/product/index');
    }
    public function loadSubCategories(Request $request,$id){
        $subcategory = Subcategory::where('category_id',"=",$id)->pluck('name','id');
        return response()->json($subcategory);
    }
}
