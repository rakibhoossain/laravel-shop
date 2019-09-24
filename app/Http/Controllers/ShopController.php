<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
    	$products = Product::orderBy('id', 'desc')->paginate(9);
    	return view('shop')->with('products', $products);

    }
    public function show(Request $request){
    	$product = Product::where('slug', $request->slug)->first();
    	return view('shop.single')->with('product', $product);

    }    

    public function search(Request $request){


        $products = Product::orWhere('title', 'like', '%'.$request->search.'%' )
                    ->orWhere('description', 'like', '%'.$request->search.'%' )
                    ->orWhere('slug', 'like', '%'.$request->search.'%' )
                    ->orWhere('price', 'like', '%'.$request->search.'%' )
                    ->orWhere('quantity', 'like', '%'.$request->search.'%' )
                    ->orderBy('id', 'desc')
                    ->paginate(9);
        return view('shop.search')->with('products', $products);

    }
}
