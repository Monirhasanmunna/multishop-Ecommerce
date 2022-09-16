<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $products = Product::all();
        return view('frontend.home',compact('products'));
    }

    public function shop()
    {
        return view('frontend.shop');
    }

    public function shopDetails()
    {
        return view('frontend.shop_details');
    }

    public function cart()
    {
        return view('frontend.cart');
    }

    public function checkout()
    {
        return view('frontend.checkout');
    }

    public function contact()
    {
        return view('frontend.contact');
    }
}
