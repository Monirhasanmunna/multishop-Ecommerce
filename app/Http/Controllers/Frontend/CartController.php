<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{

    public function cart()
    {
        return view('frontend.cart');
    }

    public function AddToCart($id)
    {
        $product = Product::findOrfail($id);
        
        $cart = session()->get('cart',[]);

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id]= [
                "product_id"   => $id,
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image,
                'category' => $product->category_id,
                'images'   => $product->images()->first(),
                'colors' => $product->colors()->get(),
                'sizes' => $product->sizes()->get()
            ];         
        }

        session()->put('cart', $cart);
        return response()->json($cart);
    }

    public function DeleteToCart(Request $request ,$id)
    {

        $cart = session()->get('cart');

        if(isset($cart[$id])){
            unset($cart[$id]);
            session()->put('cart',$cart);
        }

        return response()->json('success');
    }
}
