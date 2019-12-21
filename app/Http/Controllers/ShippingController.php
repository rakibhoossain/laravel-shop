<?php

namespace App\Http\Controllers;

use App\Shipping;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shippings = Shipping::orderBy('id', 'desc')->get();
        return view('admin.shipping.index')->with('shippings', $shippings);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.shipping.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'type'      =>  'required',
            'price'      =>  'required',
        ]);
        $shipping = new Shipping;
        $shipping->type = $request->type;
        $shipping->price = $request->price;
        $shipping->description = $request->description;
        $shipping->save();
        return back()->with('success','You have successfully created a shipping.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function show(Shipping $shipping)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $shipping = Shipping::find($request->id);
        return view('admin.shipping.edit')->with('shipping', $shipping);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'type'      =>  'required',
            'price'      =>  'required',
        ]);
        $shipping = Shipping::find($request->id);
        $shipping->type = $request->type;
        $shipping->price = $request->price;
        $shipping->description = $request->description;
        $shipping->save();
        return back()->with('success','You have successfully update a shipping.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Shipping  $shipping
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $shipping = Shipping::find($request->id);
        $shipping->delete();
        return back()->with('success','You have successfully delete a shipping.'); 
    }
}
