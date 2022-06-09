<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Category;
class CategoryController extends Controller
{
    /** WS 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::get();
        $context = ['categories' => $categories];
        return view('admin.category.index',$context);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
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
            'category_name'=>'required',
            'category_image' => 'required|mimes:png,jpeg'
        ]); 
        $image = $request->file('category_image')->store('public/files');
        Category::create([
            'name' => $request->get('category_name'),
            'slug' => $this->slug(),
            'description' => $request->get('category_description'),
            'image' =>  $image,
            'is_special' => $request->get('is_special'),
        ]);
        notify()->success('Category Created Successfully');
        return redirect('/auth/category/index');
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
        $category = Category::find($id);
        $context = ['category'=>$category];
        return view('admin.category.edit',$context);
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
        
        $category = Category::find($id);
        $old_image = $category->image;
        $new_image = $request->file('category_image');
        $category->is_special = $request->is_special;
        $category->name = $request->category_name;
        $category->description = $request->category_description;
        if($new_image != null){
            Storage::delete($old_image); 
            $category->image = $request->file('category_image')->store('public/files');
        }
        else{
            $category->image = $old_image;
        }
        $category->save();
        notify()->success('Updated Successfully');
        return redirect('/auth/category/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $filename = $category->image;
        $category->delete();
        Storage::delete($filename);
        notify()->success('Category Deleted Successfully');
        return redirect('/auth/category/index');
    }
    
    public function behaviourOfStatus(Request $request)
    {
        $obj = new \stdClass();
        $obj =Category::where('id',$request->id)->update(['status' => $request->status]); 
        return $obj;
        
    }

    private function slug()
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 6; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
            $finalvouchernumber = 'GH' . $randomString;
        }
        return $finalvouchernumber;
    }
}
