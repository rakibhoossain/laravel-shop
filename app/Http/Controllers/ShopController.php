<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Brand;
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
        $category = Category::find($product->category_id);
        $brand = Brand::find($product->brand_id);

        $data = array(
            'product'=> $product,
            'category'=> $category,
            'brand'=> $brand
        );
    	return view('shop.single')->with($data);

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
