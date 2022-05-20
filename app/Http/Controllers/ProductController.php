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
        $context = ['products'=>$products];
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
            
            $image_1 = $request->file('product_image_1')[$x]->store('public/product');
            $image_2 = empty($request->file('product_image_2')[$x]) == true ? 'no-img' : $request->file('product_image_2')[$x]->store('public/product');
            $image_3 = empty($request->file('product_image_3')[$x]) == true ? 'no-img' : $request->file('product_image_3')[$x]->store('public/product');


            ProductDetail::create([
                'product_id' => $product_id,
                'color' => $request->color[$x],
                'price' => $request->product_price[$x],
                'image_1' => $image_1,
                'image_2' => $image_2,
                'image_3' => $image_3,
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

        $value = $request->product_detail_id;

        $product_id = array_diff($request->product_detail_id,[0]);
                            

        foreach($product_id as $id) {

            // print_r(empty($request->product_image_1[$id]) == true ? ProductDetail::find($id)->value('image_1') : $request->file('roduct_image_1')[$id]);
            // print_r("<br/>");
            // print_r(empty($request->product_image_2[$id]) == true ? ProductDetail::find($id)->value('image_2') : $request->file('product_image_2')[$id]);
            // print_r("<br/>");
            // print_r(empty($request->product_image_3[$id]) == true ? ProductDetail::find($id)->value('image_3') : $request->file('product_image_3')[$id]);
            // print_r("<br/>");
            ProductDetail::where('id',$id)->update(
                [
                    'color' => $request->color[$id],
                    'price' => $request->product_price[$id],
                    'quantity' => $request->quantity[$id],
                    'image_1' => empty($request->product_image_1[$id]) == true ? ProductDetail::find($id)->value('image_1') : $request->file('product_image_2')[$id],
                    'image_2' => empty($request->product_image_2[$id]) == true ? ProductDetail::find($id)->value('image_2') : $request->file('product_image_2')[$id],
                    'image_3' => empty($request->product_image_3[$id]) == true ? ProductDetail::find($id)->value('image_3') : $request->file('product_image_3')[$id],
                    'discount' => empty($request->discount[$id]) == true ? '0' : $request->discount[$id],
                    'product_type' => $request->product_type[$id],
                    'is_special' => empty($request->special[$id]) == true ? '0' : $request->special[$id] ,

                ]
            );

        }

        // foreach($product_details as $product){

        //     $PD = ProductDetail::find($product->id);

          
        //     if(!empty($request->file('product_image')))
        //     {

        //         foreach($request->file('product_image') as $key => $chk){
        //             $PD->image = $request->file('product_image')[$key]->store('public/product');
        //         }
                
        //         $PD->image;
        //     }else{
        //         $PD->image_1 = $product->image_1;
        //         $PD->image_2 = $product->image_2;
        //         $PD->image_3 = $product->image_3;
        //     }   


            
                    // $request->product_price,
                    // $request->quantity,
                    // empty($request->discount) == true ? '0' : $request->discount,
                    // $request->product_type,
                    // empty($request->special) == true ? '0' : $request->special);
                    
            

         

            // echo "<img src=".Storage::url($PD->image)." width=100>";

            // $request->product_detail_id;
        


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


            // };

        
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
