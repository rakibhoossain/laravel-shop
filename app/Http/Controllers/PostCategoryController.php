<?php

namespace App\Http\Controllers;

use App\Post_category;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Image;

class PostCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Post_category::orderBy('id', 'desc')->get();
        return view('admin.post.category.index')->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.post.category.create');
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
        $category = new Post_category;
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->description = $request->description;
        $category->parent_id = $request->parent_id;

        //save image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $img = md5( $image->getClientOriginalName(). microtime() ).'.'.$image->getClientOriginalExtension();
            $location = public_path('images/category/'.$img);

            Image::make($image)->resize(360, 431)->save($location);
            $category->image = $img;
        }
        $category->save();
        return back()->with('success','You have successfully created a category.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post_category  $post_category
     * @return \Illuminate\Http\Response
     */
    public function show(Post_category $post_category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post_category  $post_category
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $category = Post_category::find($request->id);
        return view('admin.post.category.edit')->with('category', $category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post_category  $post_category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'name'      =>  'required|max:150',
        ]);

        $category = Post_category::find($request->id);
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->description = $request->description;
        $category->parent_id = $request->parent_id;

        //save image
        if ($request->hasFile('image')) {

            $this->deletPostCategoryImage($category);
            $image = $request->file('image');
            $img = md5( $image->getClientOriginalName(). microtime() ).'.'.$image->getClientOriginalExtension();
            $location = public_path('images/category/'.$img);
            Image::make($image)->resize(360, 431)->save($location);
            $category->image = $img;
        }
        $category->save();
        return back()->with('success','You have successfully update a category.');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post_category  $post_category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $category = Post_category::find($request->id);
        if ($category) {
            $this->deletPostCategoryImage($category);
            $category->delete();
            return back()->with('success','You have successfully delete a category.');  
        }
    }

    private function deletPostCategoryImage($category){
        if( $category->image ){
            $imgDestroy = public_path('images/category/'.$category->image);
            if ( file_exists($imgDestroy)  ) {
                unlink($imgDestroy);
            }
        }
    }

}
