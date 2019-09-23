<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Product;
use App\ProductImage;
use Image;

class ProductController extends Controller
{
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
    	$products = Product::orderBy('id', 'desc')->get();
    	return view('shop.home')->with('products', $products);

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
        $request->validate([
            'title'      =>  'required|max:150',
            'description'      =>  'required',
            'price'      =>  'required',
            'quantity'      =>  'required',
        ]);


        $product = new Product;

        $product->title = $request->title;
        $product->category_id = 0;
        $product->brand_id = 0;
        $product->slug = Str::slug($request->title);
        $product->description = $request->description;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->offer_price = $request->offer_price;
        $product->status = 0;
        $product->admin_id = 0;
        $product->save();

        //save image
        if ($request->hasFile('image')) {
            $image = $request->file('image');

        	$img = time().'.'.$image->getClientOriginalExtension();
        	$location = public_path('images/product/'.$img);
        	Image::make($image)->resize(360, 431)->save($location);

        	$productImage = new ProductImage;
        	$productImage->product_id = $product->id;
        	$productImage->image = $img;
        	$productImage->save();
        }

        return back()->with('success','You have successfully created a product.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }


}
