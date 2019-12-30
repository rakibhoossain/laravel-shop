<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Brand;
use App\Currency;
use App\Coupon;
use App\Cart;

use Session;
use Newsletter;
use Helper;

use App\Http\Resources\ItemCollection;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

        $products = Product::query();

        if(!empty($_GET['category'])){

            $slugs = explode(',', $_GET['category']);
            $cat_ids = Category::select('id')->whereIn('slug', $slugs)->pluck('id')->toArray();
            $products->whereIn('category_id',  $cat_ids);
        }

        if(!empty($_GET['brand'])){
            $slugs = explode(',', $_GET['brand']);
            $brand_ids = Brand::select('id')->whereIn('slug', $slugs)->pluck('id')->toArray();
            $products->whereIn('brand_id',  $brand_ids);
        }

        if(!empty($_GET['sortBy'])){

            if($_GET['sortBy'] == 'price'){
                $products->orderBy('offer_price', 'desc');
            }

            if($_GET['sortBy'] == 'category'){
                $products->join('categories', 'products.category_id', '=', 'categories.id')->orderBy('categories.name', 'asc')->select('products.*');
            }

            if($_GET['sortBy'] == 'brand'){
                $products->join('brands', 'products.category_id', '=', 'brands.id')->orderBy('brands.name', 'asc')->select('products.*');
            }

        }

        if(!empty($_GET['price'])){
            $price = explode('-', $_GET['price']);
            if(isset($price[0]) && is_numeric($price[0])) $price[0] = floor(Helper::base_amount($price[0]));
            if(isset($price[1]) && is_numeric($price[1])) $price[1] = ceil(Helper::base_amount($price[1]));
            $products->whereBetween('offer_price', $price);
        }

        if(!empty($_GET['show'])){
            $products = $products->paginate($_GET['show']);
        }else{
            $products = $products->orderBy('id')->paginate(9); 
        }

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

    
    public function filter(Request $request)
    {
        $data = $request->all();

        $catURL = '';
        if(!empty($data['category'])){
            foreach($data['category'] as $category){
                if(empty($catURL)){
                    $catURL .= '&category='.$category;
                }else{
                    $catURL .= ','.$category;
                }
            }
        }

        $brandURL = '';
        if(!empty($data['brand'])){
            foreach($data['brand'] as $brand){
                if(empty($brandURL)){
                    $brandURL .= '&brand='.$brand;
                }else{
                    $brandURL .= ','.$brand;
                }
            }
        }

        $sortByURL = '';
        if(!empty($data['sortBy'])){
            $sortByURL .= '&sortBy='.$data['sortBy'];
        }

        $showURL = '';
        if(!empty($data['show'])){
            $showURL .= '&show='.$data['show'];
        }

        $price_range_URL = '';
        if(!empty($data['price_range'])){
            $price_range_URL .= '&price='.$data['price_range'];
        }

        return redirect()->route('shop',$catURL.$brandURL.$price_range_URL.$showURL.$sortByURL);
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

    public function shopCurrency(Request $request){
        
        $currency = Currency::find($request->id);
        if($currency){
            Session::put('shop_currency', $request->id);
        }else if($request->id == 0){
            Session::put('shop_currency', 0);
        }
        return back();

    }

    public function storeEmail(Request $request){

        if ( ! Newsletter::isSubscribed($request->email) ) {
            Newsletter::subscribePending($request->email);
           return Newsletter::lastActionSucceeded()? back()->with('success', 'Subscribed! Check your email!') : back()->withErrors(Newsletter::getLastError()); 
        }

        return back()->withErrors('Already subscribed!');
        
    }

    public function couponApply(Request $request){
        
        $coupon = Coupon::where('code', $request->code)->first();
        if($coupon){
            $total_price = Cart::where('user_id', auth()->user()->id)->where('order_id', null)->sum('price');
            Session::put('discount', [
                'id' => $coupon->id,
                'code' => $coupon->code,
                'value' => $coupon->discount($total_price)
            ]);
         return 1;   
        }
        return 0;
    }
}
