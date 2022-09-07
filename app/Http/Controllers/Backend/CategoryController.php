<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use App\Traits\Filesaver;

class CategoryController extends Controller
{
    use Filesaver;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('app.role.index');
        $categories = Category::all();
        return view('backend.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('app.role.create');
        return view('backend.category.create');
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
            'name'          => 'required|max:50',
            'description'   => 'sometimes|max:500',
            'image'         =>'required|mimes:jpg,png|max:2048',
        ]);

        $category =  Category::create([
            'name'   => $request->name,
            'description'      => $request->description,
            'slug'   => Str::slug($request->name),
            'image'  => $request->image
        ]);

         // <!-- update user image -->
        if($request->file('image')){
            $this->uploadFileWithResize($request->image, $category, 'image', 'category',250,250);
        }

        notify()->success("Category Created");
        return redirect()->route('app.category.index');
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
        Gate::authorize('app.role.edit');
        $category = Category::findOrfail($id);
        return view('backend.category.create',compact('category'));
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
            'name'          => 'required|max:50',
            'description'   => 'sometimes|max:500',
            'image'         =>'sometimes|mimes:jpg,png|max:2048',
        ]);

        $category = Category::findOrfail($id);
        $category->update([
            'name'   => $request->name,
            'description'      => $request->description,
            'slug'   => Str::slug($request->name),
        ]);

         // <!-- update user image -->
        if($request->file('image')){
            $this->upload_file($request->image, $category, 'image', 'category',250,250);
        }

        notify()->success("Category Updated");
        return redirect()->route('app.category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize('app.category.delete');
        $category = Category::findOrfail($id);
        if(file_exists($category->image) && $category->image != ''){
            unlink($category->image);
            $category->delete();
            return response()->json($category);
        }
    }
}
