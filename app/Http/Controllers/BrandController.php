<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::where('status','1')->get();
        $context = ['brands'=>$brands];
        return view('admin.brand.index',$context); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brand.create');
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
            'brand_name' => 'required|min:3',
        ]);

        if($request->file('brand_image') != null)
        {
            $image = $request->file('brand_image')->store('public/files');
        }else{
            $image = null;
        }

        Brand::create([
            'name' => $request->get('brand_name'),
            'slug' => $this->slug(),
            'image' => $image
        ]);

        notify()->success('Creation Succeed');
        return redirect('/auth/brand/index');
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
        $brand = Brand::findorFail($id);
        $context = ['brand'=>$brand];
        return view('admin.brand.edit',$context);
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
        $brand = Brand::find($id);
        $old_image = $brand->image;
        $new_image = $request->file('brand_image');
        
        $brand->name = $request->brand_name;
        if($new_image != null){
            Storage::delete($old_image); 
            $brand->image = $request->file('brand_image')->store('public/files');
        }
        else{
            $brand->image = $old_image;
        }
        $brand->save();
        notify()->success('Updated Successfully');
        return redirect('/auth/brand');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::findorFail($id);
        $brand->delete();
        notify()->success('Deleted :)');
        return redirect('/auth/brand');
    }
    public function behaviourOfStatus(Request $request)
    {
        $obj = new \stdClass();
        $obj =Brand::where('id',$request->id)->update(['status' => $request->status]); 
        return $obj;
    }

    private function slug()
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 6; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
            $finalvouchernumber = 'GH#' . $randomString;
        }
        return $finalvouchernumber;
    }

}
