<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subcategory;
use App\Models\Category;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategories = Subcategory::get();
        $context = ['subcategories'=>$subcategories];
        return view('admin.subcategory.index',$context); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $select_category = Category::all();
        $context = ['select_category' => $select_category];
        return view('admin.subcategory.create',$context);
        
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
            'subcategory_name' => 'required|min:3',
            'category' => 'required'
        ]);
        SubCategory::create([
            'name' => $request->get('subcategory_name'),
            'category_id' => $request->get('category')
        ]);
        notify()->success('SubCategory Created Successfully');
        return redirect('/auth/subcategory/index');
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
        $subcategory = Subcategory::find($id);
        $select_category = Category::all();
        $context = ['subcategory'=>$subcategory,'select_category'=>$select_category];
        return view('admin.subcategory.edit',$context);
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
            'subcategory_name'=>'required',
            'category' => 'required'
        ]);
        $subcategory = Subcategory::find($id);
        $subcategory->name = $request->subcategory_name;
        $subcategory->category_id = $request->category;
        $subcategory->save();
        notify()->success('SubCategory Updated Successfully');
        return redirect('/auth/subcategory/index');
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
        notify()->success('Sub-category Deleted Successfully');
        return redirect('/subcategory/index');
    }
    public function behaviourOfStatus(Request $request)
    {
        $obj = new \stdClass();
        $obj =SubCategory::where('id',$request->id)->update(['status' => $request->status]); 
        return $obj;
        
    }
}
