<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carts = Cart::where('user_id', auth()->user()->id)->where('order_id', null)->get();      
        return view('shop.cart')->with('carts', $carts);
    }


    public function addTo(Request $request){

        $product = Product::where('slug', $request->slug)->first();

        // $request->validate([
        //     'name'      =>  'required|max:150',
        // ]);


        $already_cart = Cart::where('user_id', auth()->user()->id)->where('order_id', null)->where('product_id', $product->id)->first();

        if($already_cart) {
            $already_cart->quantity = $already_cart->quantity + 1;
            $already_cart->price = $product->offer_price + $already_cart->price ;
            $already_cart->save();
            
        }else{
            
            $cart = new Cart;
            $cart->user_id = auth()->user()->id;
            $cart->product_id = $product->id;
            $cart->price = $product->offer_price;
            $cart->quantity = 1;
            $cart->save();
        }
        return back()->with('success','Product added to cart.');       
    } 


    public function checkout()
    {
     
        $orders = Cart::where('user_id', auth()->user()->id)->where('order_id', null)->get();
        
        if ($orders->isEmpty()) {

           $data = array(
                'orders'=>[],
                'total_price'=> 0.00
            ); 
          
        }else{
            $total_price = Cart::where('user_id', auth()->user()->id)->where('order_id', null)->sum('price');
            $data = array(
                'orders'=>$orders,
                'total_price'=> $total_price
            );            
        }

        return view('shop.checkout')->with($data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
