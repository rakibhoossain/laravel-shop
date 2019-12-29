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

    /**
     * Add to cart from btn
     *
     */
    public function addTo(Request $request){

        if (empty($request->slug)) {
            return back()->withErrors('Invalid product!');
        }
        
        $product = Product::where('slug', $request->slug)->first();
        if (empty($product)) {
            return back()->withErrors('Invalid product!');
        }

        $already_cart = Cart::where('user_id', auth()->user()->id)->where('order_id', null)->where('product_id', $product->id)->first();

        if($already_cart) {
            $already_cart->quantity = $already_cart->quantity + 1;
            $already_cart->price = $product->offer_price + $already_cart->price ;
            if ($already_cart->product->quantity < $already_cart->quantity || $already_cart->product->quantity <= 0) return back()->withErrors('Stock not sufficient!.');
            $already_cart->save();
            
        }else{
            
            $cart = new Cart;
            $cart->user_id = auth()->user()->id;
            $cart->product_id = $product->id;
            $cart->price = $product->offer_price;
            $cart->quantity = 1;
            if ($cart->product->quantity < $cart->quantity || $cart->product->quantity <= 0) return back()->withErrors('Stock not sufficient!.');
            $cart->save();
        }
        return back()->with('success','Product added to cart.');       
    }     

    /**
     * Add to cart from single product page
     *
     */
    public function singleToAdd(Request $request){
        $request->validate([
            'slug'      =>  'required',
            'qty'      =>  'required',
        ]);

        $product = Product::where('slug', $request->slug)->first();
        if ( ($request->qty < 1) || empty($product) ) {
            return back()->withErrors('Something wrong. Try again!');
        }    

        $already_cart = Cart::where('user_id', auth()->user()->id)->where('order_id', null)->where('product_id', $product->id)->first();



        if($already_cart) {
            $already_cart->quantity = $already_cart->quantity + $request->qty;
            $already_cart->price = ($product->offer_price * $request->qty) + $already_cart->price ;

            if ($already_cart->product->quantity < $already_cart->quantity || $already_cart->product->quantity <= 0) return back()->withErrors('Stock not sufficient!.');

            $already_cart->save();
            
        }else{
            
            $cart = new Cart;
            $cart->user_id = auth()->user()->id;
            $cart->product_id = $product->id;
            $cart->price = ($product->offer_price * $request->qty);
            $cart->quantity = $request->qty;

            if ($cart->product->quantity < $cart->quantity || $cart->product->quantity <= 0) return back()->withErrors('Stock not sufficient!.');

            $cart->save();
        }
        return back()->with('success','Product added to cart.');       
    }    

    /**
     * Delete cart from cart page
     *
     */
    public function addToDelete(Request $request){
        $cart = Cart::find($request->id);
        if ($cart) {
            $cart->delete();
            return back()->with('success','Cart removed!');  
        }
        return back()->withErrors('Invalid card');       
    }     

    /**
     * Cart update from cart page
     *
     */
    public function addToUpdate(Request $request){
        if($request->qty){

            $error = array();
            $success = '';

            foreach ($request->qty as $k=>$qty) {

                $id = $request->qty_id[$k];

                $cart = Cart::find($id);

                if ($qty>0 && $cart) {
                    $cart->quantity = ($cart->product->quantity > $qty) ? $qty  : $cart->product->quantity;
                    if ($cart->product->quantity <=0) continue;
                    $cart->price = $cart->product->offer_price * $qty;
                    $cart->save();
                    $success = 'Cart updated!';
                }else{
                    $error[] = 'Cart Invalid!';
                }
            }
            return back()->withErrors($error)->with('success', $success);
        }else{
            return back()->withErrors('Cart Invalid!');
        }     
    } 

    /**
     * Cart checkout
     *
     */
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
