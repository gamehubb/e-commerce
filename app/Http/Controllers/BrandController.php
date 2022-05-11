<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Str;


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
            'brand' => 'required|min:3',
        ]);
        SubCategory::create([
            'name' => $request->get('name'),
            'slug' => Str::slug($request->get('name')),
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
        $this->validate($request,[
            'name'=>'required',
        ]);
        $subcategory = Subcategory::find($id);
        $subcategory->name = $request->subcategory_name;
        $subcategory->category_id = $request->category;
        $subcategory->save();
        notify()->success('Updated :)');
        return redirect('/auth/brand/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subcategory = Subcategory::find($id);
        $subcategory->delete();
        notify()->success('Deleted :)');
        return redirect('/brand/index');
    }
    public function behaviourOfStatus(Request $request)
    {
        $obj = new \stdClass();
        $obj =SubCategory::where('id',$request->id)->update(['status' => $request->status]); 
        return $obj;
        
    }
}
