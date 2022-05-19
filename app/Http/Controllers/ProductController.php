<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Product;
use App\Models\Brand;
use App\Models\ProductDetail;

use Auth;
 
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

        foreach($products as $product){

            $product_details = ProductDetail::where('product_id',$product->id)->get();

        }
        
        $context = ['products'=>$products, 'product_details' => $product_details];
        return view('admin.product.index',$context);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $select_category = Category::where('status','1')->get();
        $select_brand = Brand::where('status','1')->get();
        $context = ['categories'=>$select_category ,'brands' => $select_brand];
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
        $product = new Product();
        $id = Auth::id();

        $product_id = $product->create([

            'name' => $request->product_name,
            'code' => $request->product_code,
            'category_id' => $request->category,
            'brand_id' => $request->brand,
            'user_id' => $id,
            'wireless' => $request->wired_option,
            'description' => $request->product_description,
            'additional_info' => $request->product_additional_info

        ])->id;

        $count_product = count($request->color);

        for($x = 0; $x < $count_product; $x++) {
            
            $image = $request->file('product_image')[$x]->store('public/product');

            ProductDetail::create([
                'product_id' => $product_id,
                'color' => $request->color[$x],
                'price' => $request->product_price[$x],
                'image' => $image,
                'quantity' => $request->quantity[$x],
                'discount' => empty($request->discount[$x]) == true ? '0' : $request->discount[$x],
                'product_type' => $request->product_type[$x],
                'is_special' => empty($request->special[$x]) == true ? '0' : $request->special[$x] ,
            ]);
        }

        notify()->success('Product Created Successfully!');
        return redirect('auth/product');
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
        $select_product = Product::findorfail($id);
        $select_category = Category::where('status','1')->get();
        $select_brand = Brand::where('status','1')->get();
        $product_detail = ProductDetail::where('product_id',$id)->get();
        $product_types = ['1' => 'in-stock', '2' => 'pre-order'];

        $context = ['product'=>$select_product,'categories'=>$select_category,'brands' => $select_brand,'productDetail' => $product_detail,
                    'product_types' => $product_types];
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

        $user_id = Auth::id();

        $product = Product::find($id);
        $product->name = $request->product_name;
        $product->code = $request->product_code;
        $product->category_id = $request->category;
        $product->brand_id = $request->brand;
        $product->user_id = $user_id;
        $product->wireless = $request->wired_option;
        $product->description = $request->product_description;
        $product->additional_info = $request->product_additionalinfo;

        $product->save();

        $product_details = ProductDetail::where('product_id',$id)->get();
        foreach($product_details as $product){

            $PD = ProductDetail::find($product->id);

            if(!empty($request->product_id))
            {
                $PD->image = $request->file('product_image')[$id]->store('public/product');
            }else{
                $PD->image = $product->image;
            }   

            print_r($request->file('product_image[23]'));

            // echo "<img src=".Storage::url($PD->image)." width=100>";

            print_r($request->product_detail_id);
        


        //     $old_image[] = $product->image;

        //     Storage::delete($product->image); 
        //     $product->delete();
        // }

        //     $count_product = count($request->color);

        //     for($x = 0; $x < $count_product; $x++) {

        //         if(!empty($request->product_image[$x]))
        //         {
        //         $image = $request->file('product_image')[$x]->store('public/product');
        //         }else{
        //         $image = $old_image;
        //         }

        //         ProductDetail::create([
        //             'product_id' => $id,
        //             'color' => $request->color[$x],
        //             'price' => $request->product_price[$x],
        //             'image' => $image,
        //             'quantity' => $request->quantity[$x],
        //             'discount' => empty($request->discount[$x]) == true ? '0' : $request->discount[$x],
        //             'product_type' => $request->product_type[$x],
        //             'is_special' => empty($request->special[$x]) == true ? '0' : $request->special[$x],
        //         ]);

                // $PD->save();


            };

        
        // notify()->success('Product Updated Successfully');
        // return redirect('/auth/product');
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
    public function behaviourOfStatus(Request $request)
    {
        $obj = new \stdClass();
        $obj =Product::where('id',$request->id)->update(['status' => $request->status]); 
        return $obj;
        
    }
}
