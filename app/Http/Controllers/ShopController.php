<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Brand;

use App\Http\Resources\ItemCollection;

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

    public function itemList()
    {   
        return new ItemCollection( Product::all() );
    }


    public function show(Request $request)
    {
        $product = Product::where('slug', $request->slug)->first();
        if ($product) {
            return view('shop.single')->with('product', $product);
        }else{
            return view('shop.single')->with('product', []);
        }
    }

    public function categoryProduct(Request $request){

        $cat = Category::where('slug', $request->slug)->first();
        if ($cat) {
            $products = Product::where('category_id', $cat->id)->paginate(9);
            return view('shop')->with('products', $products);
        }else{
            return view('shop')->with('products', []);
        }
        
    } 

    public function brandProduct(Request $request){

        $brand = Brand::where('slug', $request->slug)->first();
        if ($brand) {
            $products = Product::where('brand_id', $brand->id)->paginate(9);
            return view('shop')->with('products', $products);
        }else{
            return view('shop')->with('products', []);
        }
        
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
