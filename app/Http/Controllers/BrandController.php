<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Brand;
use Illuminate\Http\Request;
use Image;


class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::orderBy('id', 'desc')->get();
        return view('admin.product.brand.index')->with('brands', $brands);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.brand.create');
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
            'name'      =>  'required|max:150',
        ]);

        $brand = new Brand;
        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);
        $brand->description = $request->description;

        //save image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $img = md5( $image->getClientOriginalName(). microtime() ).'.'.$image->getClientOriginalExtension();
            $location = public_path('images/brand/'.$img);

            Image::make($image)->resize(360, 431)->save($location);
            $brand->image = $img;
        }
        $brand->save();
        return back()->with('success','You have successfully created a brand.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $brand = Brand::find($request->id);
        return view('admin.product.brand.edit')->with('brand',$brand);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'name'      =>  'required|max:150',
        ]);

        $brand = Brand::find($request->id);
        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);
        $brand->description = $request->description;

        //save image
        if ($request->hasFile('image')) {

            $this->deletProductBrandImage($brand);
            $image = $request->file('image');
            $img = md5( $image->getClientOriginalName(). microtime() ).'.'.$image->getClientOriginalExtension();
            $location = public_path('images/brand/'.$img);
            Image::make($image)->resize(360, 431)->save($location);
            $brand->image = $img;
        }
        $brand->save();
        return back()->with('success','You have successfully update a brand.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $brand = Brand::find($request->id);
        if ($brand) {
            $this->deletProductBrandImage($brand);
            $brand->delete();
            return back()->with('success','You have successfully delete a brand.');  
        }
    }

    private function deletProductBrandImage($brand){
        if( $brand->image ){
            $imgDestroy = public_path('images/brand/'.$brand->image);
            if ( file_exists($imgDestroy)  ) {
                unlink($imgDestroy);
            }
        }
    }

}
