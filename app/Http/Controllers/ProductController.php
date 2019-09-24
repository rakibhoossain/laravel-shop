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
    	return view('admin.product.index')->with('products', $products);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.create');
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
        $this->saveProduct($product, $request);
        
        //save image
        if ($request->hasFile('image')) {
            $this->saveProductImage( $request->file('image'), $product);
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
    public function edit(Request $request)
    {
        $product = Product::find($request->id);
        return view('admin.product.edit')->with('product', $product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'title'      =>  'required|max:150',
            'description'      =>  'required',
            'price'      =>  'required',
            'quantity'      =>  'required',
        ]);

        $product = Product::find($request->id);

        if ($product) {
            $this->saveProduct($product, $request);

            if ($request->hasFile('image')) {
                $this->deletProductImage($product);
                $this->saveProductImage( $request->file('image'), $product);
            }
        }

        return back()->with('success','You have successfully update a product.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $product = Product::find($request->id);
        if ($product) {
            $this->deletProductImage($product);
            $product->delete();
            return back()->with('success','You have successfully delete a product.');  
        }
        
    }


    private function deletProductImage($product){
        if( $product->images ){
            foreach ($product->images as $image) {
                $imgDestroy = public_path('images/product/'.$image->image);
                if ( file_exists($imgDestroy)  ) {
                    unlink($imgDestroy);
                }
                $image->delete();  
            }
        }

    }

    private function saveProductImage($files, $product){
        foreach( $files as $image){
            $img = md5( $image->getClientOriginalName(). microtime() ).'.'.$image->getClientOriginalExtension();
            $location = public_path('images/product/'.$img);
            Image::make($image)->resize(360, 431)->save($location);
            
            $productImage = new ProductImage;
            $productImage->product_id = $product->id;
            $productImage->image = $img;
            $productImage->save();
        }
    }

    private function saveProduct($product, $request){
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
    }

}
