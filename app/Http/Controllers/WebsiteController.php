<?php

namespace App\Http\Controllers;

use Hash;
use App\Product;
use Image;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WebsiteController extends Controller
{
   
    public function about()
    {
        return view('website.about');
    }

    public function product()
    {
        $products = Product::where('status','available')->paginate(12);
        return view('website.product',['products'=>$products]);
    }

   
}