<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Color;
use App\Models\Image;
use App\Models\Product;
use App\Models\Size;
use App\Models\SubCategory;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('app.product.index');
        $products = Product::all();
        return view('backend.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('app.product.create');
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $colors  = Color::all();
        $units = Unit::all();
        $sizes  = Size::all();
        return view('backend.product.create',compact('categories','subcategories','colors','units','sizes'));
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
            'name'          => 'required|max:100',
            'about'         => 'required|max:500',
            'description'   => 'required|max:2000',
            'category'      => 'required',
            'subcategory'   => 'required',
            'unit'          => 'required',
            'color'         => 'required',
            'quantity'      => 'required',
            'image'         => 'required',
            'price'         => 'required',
            'offer_price'   => 'sometimes',
            'size'          => 'sometimes',
            'status'        => 'sometimes'
        ]);

        
        $product = Product::create([
            'name'              => $request->name,
            'about'             => $request->about,
            'description'       => $request->description,
            'category_id'       => $request->category,
            'subcategory_id'    => $request->subcategory,
            'unit_id'           => $request->unit,
            'quantity'          => $request->quantity,
            'price'             => $request->price,
            'offer_price'       => $request->offer_price,
            'status'            => $request->filled('status')
        ]);

        $product->colors()->sync($request->input('color'));
        $product->sizes()->sync($request->input('size'));


        foreach ($request->file('image') as $file) {

            $imgName = time().$file->getClientOriginalName();
                $file->move('uploads/products/Images',$imgName);
                $subimage['sub_image'] = $imgName;

                $subimage = new Image();
                $subimage->product_id = $product->id;
                $subimage->image =  'uploads/products/Images/'.$imgName;
                $subimage->save();
        }
        
        notify()->success("Product Created");
        return redirect()->route('app.product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrfail($id);
        return view('backend.product.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Gate::authorize('app.product.edit');
        $product = Product::findOrfail($id);
        $subCategoryByProdact = SubCategory::where('category_id',$product->category_id)->get();
        $categories = Category::all();
        $colors  = Color::all();
        $units = Unit::all();
        $sizes  = Size::all();
        return view('backend.product.create',compact('product','categories','subCategoryByProdact','colors','units','sizes'));
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
            'name'          => 'required|max:100',
            'about'         => 'required|max:500',
            'description'   => 'required|max:2000',
            'category'      => 'required',
            'subcategory'   => 'required',
            'unit'          => 'required',
            'color'         => 'required',
            'quantity'      => 'required',
            'image'         => 'sometimes',
            'price'         => 'required',
            'offer_price'   => 'sometimes',
            'size'          => 'sometimes',
            'status'        => 'sometimes'
        ]);

        $product = Product::findOrfail($id);
        $product->update([
            'name'              => $request->name,
            'about'             => $request->about,
            'description'       => $request->description,
            'category_id'       => $request->category,
            'subcategory_id'    => $request->subcategory,
            'unit_id'           => $request->unit,
            'quantity'          => $request->quantity,
            'price'             => $request->price,
            'offer_price'       => $request->offer_price,
            'status'            => $request->filled('status')
        ]);


        $product->colors()->sync($request->input('color'));
        $product->sizes()->sync($request->input('size'));


        //delete old pic
        if($request->file('image')){
            foreach($product->images as $productImage){
                if(file_exists($productImage->image) && $productImage->image != ''){
                    unlink($productImage->image);
                    Image::where('product_id',$product->id)->delete();
                }
            }
        }

        //upload New pic
        if($request->file('image')){
            foreach ($request->file('image') as $file) {

                    $imgName = time().$file->getClientOriginalName();
                    $file->move('uploads/products/Images',$imgName);
                    $subimage['sub_image'] = $imgName;

                    $subimage = new Image();
                    $subimage->product_id = $product->id;
                    $subimage->image =  'uploads/products/Images/'.$imgName;
                    $subimage->save();
            }
        }
        
        
        notify()->success("Product Update");
        return redirect()->route('app.product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize('app.product.delete');
        $product = Product::findOrfail($id);
        foreach($product->images as $productImage){
            if(file_exists($productImage->image) && $productImage->image != ''){
                unlink($productImage->image);
            }
        }
        $product->delete();
        notify()->success("Product Deleted");
        return redirect()->route('app.product.index');
    }


    //Ajax Class here

    public function subcategoryById($id)
    {
        $subCategories = SubCategory::where('category_id',$id)->get();
        return response()->json($subCategories);
    }
}
