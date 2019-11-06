<?php

namespace App\Http\Controllers;

use App\Order;
use App\Cart;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderBy('status', 'desc')->get();
        return view('admin.order.index')->with('orders', $orders);
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



        // $request->validate([
        //     'name'      =>  'required|max:150',
        // ]);

        $order = new Order;
        $order->order_number = 'ORD-'.strtoupper(uniqid());
        $order->user_id = auth()->user()->id;

        $order->status = 'pending';
        $order->grand_total = Cart::where('user_id', auth()->user()->id)->where('order_id', null)->sum('price');
        $order->item_count = Cart::where('user_id', auth()->user()->id)->where('order_id', null)->sum('quantity');
        $order->payment_status = 0;
        $order->payment_method = null;

        $order->first_name = $request->first_name;
        $order->last_name = $request->last_name;
        $order->address = $request->address;
        $order->city = $request->city;
        $order->country = $request->country;
        $order->post_code = $request->post_code;
        $order->phone_number = $request->phone_number;
        $order->notes = $request->notes;

        $order->save();

        Cart::where('user_id', auth()->user()->id)->where('order_id', null)->update(['order_id' => $order->id]);
        return back()->with('success','Your order success!.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $order = Order::find($request->id);

        $data = array(
            'order'=>$order,
            );
        return view('admin.order.edit')->with($data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
