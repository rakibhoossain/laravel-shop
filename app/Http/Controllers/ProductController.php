<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    public function index(){
    	$products = Product::orderBy('id', 'desc')->get();
    	return view('shop.home')->with('products', $products);

    }
}
