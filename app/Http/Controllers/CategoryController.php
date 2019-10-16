<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Category;
use Illuminate\Http\Request;
use Image;

use Helper;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('id', 'desc')->get();
        return view('admin.product.category.index')->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.category.create');
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

        $category = new Category;
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->description = $request->description;
        $category->parent_id = $request->parent_id;

        //save image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $img = md5( $image->getClientOriginalName(). microtime() ).'.'.$image->getClientOriginalExtension();
            $location = public_path('images/product-category/'.$img);

            Image::make($image)->resize(360, 431)->save($location);
            $category->image = $img;
        }
        $category->save();
        return back()->with('success','You have successfully created a category.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $category = Category::find($request->id);
        $data = array(
            'category'=>$category,
            'parentCategories'=> Helper::productCategoryList() //TODO:: modify later
            );
        return view('admin.product.category.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'name'      =>  'required|max:150',
        ]);

        $category = Category::find($request->id);
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->description = $request->description;
        $category->parent_id = $request->parent_id;

        //save image
        if ($request->hasFile('image')) {

            $this->deletProductCategoryImage($category);
            $image = $request->file('image');
            $img = md5( $image->getClientOriginalName(). microtime() ).'.'.$image->getClientOriginalExtension();
            $location = public_path('images/product-category/'.$img);
            Image::make($image)->resize(360, 431)->save($location);
            $category->image = $img;
        }
        $category->save();
        return back()->with('success','You have successfully update a category.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $category = Category::find($request->id);
        if ($category) {
            $this->deletProductCategoryImage($category);
            $category->delete();
            return back()->with('success','You have successfully delete a category.');  
        }
    }

    private function deletProductCategoryImage($category){
        if( $category->image ){
            $imgDestroy = public_path('images/product-category/'.$category->image);
            if ( file_exists($imgDestroy)  ) {
                unlink($imgDestroy);
            }
        }
    }

}
