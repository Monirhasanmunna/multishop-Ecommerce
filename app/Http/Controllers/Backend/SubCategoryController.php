<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use App\Traits\Filesaver;

class SubCategoryController extends Controller
{
    use Filesaver;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('app.subcategory.index');
        $subcategories = SubCategory::all();
        return view('backend.subcategory.index',compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('app.subcategory.create');
        $categories = Category::all();
        return view('backend.subcategory.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|unique:sub_categories',
            'role'  => 'required',
            'image' => 'required|mimes:jpg,png|max:2048',
            'description'   => 'sometimes|max:1000'
        ]);

        $subcategory = SubCategory::create([
            'name'  => $request->name,
            'category_id'   => $request->role,
            'slug'  => Str::slug($request->name),
            'description'   => $request->description,
        ]);

         // <!-- update user image -->
         if($request->file('image')){
            $this->uploadFileWithResize($request->image, $subcategory, 'image', 'subcategory',250,250);
        }

        notify()->success("Sub Category Created");
        return redirect()->route('app.subcategory.index');
    
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
        Gate::authorize('app.subcategory.edit');
        $subcategory = SubCategory::findOrfail($id);
        $categories = Category::all();
        return view('backend.subcategory.create',compact('categories','subcategory'));
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
        $request->validate([
            'name'  => 'required',
            'role'  => 'required',
            'image' => 'sometimes|mimes:jpg,png|max:2048',
            'description'   => 'sometimes|max:1000'
        ]);

        $subcategory = SubCategory::findOrfail($id);
        $subcategory->update([
            'name'  => $request->name,
            'category_id'   => $request->role,
            'slug'  => Str::slug($request->name),
            'description'   => $request->description,
        ]);

        // <!-- update user image -->
        if($request->file('image')){
            $this->upload_file($request->image, $subcategory, 'image', 'subcategory',250,250);
        }

        notify()->success("Sub Category Updated");
        return redirect()->route('app.subcategory.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize('app.subcategory.delete');
        $subcategory = SubCategory::findOrfail($id);
        if(file_exists($subcategory->image) && $subcategory->image != ''){
            unlink($subcategory->image);
            $subcategory->delete();
        }else{
            $subcategory->delete();
        }

        notify()->success("Sub Category Deleted");
        return redirect()->route('app.subcategory.index');
    }
}
