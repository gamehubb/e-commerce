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
        $context = ['products' => $products];
        return view('admin.product.index', $context);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $select_category = Category::where('status', '1')->get();
        $select_brand = Brand::where('status', '1')->get();
        $product_types = ['1' => 'in-stock', '2' => 'pre-order'];
        $context = ['categories' => $select_category, 'brands' => $select_brand, 'product_types' => $product_types];
        return view('admin.product.create', $context);
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
            'model_name' => $request->model_name,
            'category_id' => $request->category,
            'brand_id' => $request->brand,
            'user_id' => $id,
            'wireless' => $request->wired_option,
            'warranty' => $request->warranty,
            'product_type' => $request->product_type,
            'is_special' => $request->is_special,
            'description' => $request->product_description,
            'additional_info' => $request->product_additional_info

        ])->id;

        $count_product = count($request->color);

        for ($x = 0; $x < $count_product; $x++) {

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
        $select_category = Category::where('status', '1')->get();
        $select_brand = Brand::where('status', '1')->get();
        $product_detail = ProductDetail::where('product_id', $id)->get();
        $product_types = ['1' => 'in-stock', '2' => 'pre-order'];

        $context = [
            's_product' => $select_product, 'categories' => $select_category, 'brands' => $select_brand, 'productDetail' => $product_detail,
            'product_types' => $product_types
        ];
        return view('admin.product.edit', $context);
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
        $product->model_name = $request->model_name;
        $product->category_id = $request->category;
        $product->brand_id = $request->brand;
        $product->user_id = $user_id;
        $product->wireless = $request->wired_option;
        $product->warranty = $request->warranty;
        $product->product_type = $request->product_type;
        $product->is_special = $request->is_special;
        $product->description = $request->product_description;
        $product->additional_info = $request->product_additionalinfo;

        $product->save();

        $product_details = ProductDetail::where('product_id', $id)->get();

        $value = $request->product_detail_id;

        $product_id = $request->product_detail_id;

        foreach ($product_id as $p_id) {

            ProductDetail::where('id', $p_id)->update(
                [
                    'color' => $request->color[$p_id],
                    'price' => $request->product_price[$p_id],
                    'quantity' => $request->quantity[$p_id],
                    'image_1' => empty($request->file('product_image_1')[$p_id]) == true ? ProductDetail::where('id', $p_id)->value('image_1') : $request->file('product_image_1')[$p_id]->store('public/product'),
                    'image_2' => empty($request->file('product_image_2')[$p_id]) == true ? ProductDetail::where('id', $p_id)->value('image_2') : $request->file('product_image_2')[$p_id]->store('public/product'),
                    'image_3' => empty($request->file('product_image_3')[$p_id]) == true ? ProductDetail::where('id', $p_id)->value('image_3') : $request->file('product_image_3')[$p_id]->store('public/product'),
                    'discount' => empty($request->discount[$p_id]) == true ? '0' : $request->discount[$p_id],
                ]
            );
        }

        $count_product = empty($request->product_new_detail_id) == true ? 0 : count($request->product_new_detail_id);

        if ($count_product != 0) {

            for ($x = 0; $x < $count_product; $x++) {

                print_r($id);

                $image_1 = empty($request->file('new_product_image_1')[$x]) == true ? 'no-img' : $request->file('new_product_image_1')[$x]->store('public/product');
                $image_2 = empty($request->file('new_product_image_2')[$x]) == true ? 'no-img' : $request->file('new_product_image_2')[$x]->store('public/product');
                $image_3 = empty($request->file('new_product_image_3')[$x]) == true ? 'no-img' : $request->file('new_product_image_3')[$x]->store('public/product');

                ProductDetail::create([
                    'product_id' => $id,
                    'color' => $request->new_color[$x],
                    'price' => $request->new_product_price[$x],
                    'image_1' => $image_1,
                    'image_2' => $image_2,
                    'image_3' => $image_3,
                    'quantity' => $request->new_quantity[$x],
                    'discount' => empty($request->new_discount[$x]) == true ? '0' : $request->new_discount[$x],
                ]);
            }
        }

        notify()->success('Product Updated Successfully');
        return redirect('/auth/product');
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
    public function loadSubCategories(Request $request, $id)
    {
        $subcategory = Subcategory::where('category_id', "=", $id)->pluck('name', 'id');
        return response()->json($subcategory);
    }
    public function behaviourOfStatus(Request $request)
    {
        $obj = new \stdClass();
        $obj = Product::where('id', $request->id)->update(['status' => $request->status]);
        return $obj;
    }
}