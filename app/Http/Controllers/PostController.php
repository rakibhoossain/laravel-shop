<?php

namespace App\Http\Controllers;

use App\Post;
use App\Post_Category_Relation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;

use App\Http\Resources\PostCollection;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Post::first();
        return view('admin.post.index')->with('post', $post);
    }    

    public function postList()
    {
        return new PostCollection( Post::all() );

        // return 'hello';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.post.create');
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
            'body'      =>  'required',
        ]);

        $post = new Post;
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->body = $request->body;
        $post->user_id = auth()->user()->id;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $img = md5( $image->getClientOriginalName(). microtime() ).'.'.$image->getClientOriginalExtension();
            $location = public_path('images/post/'.$img);

            Image::make($image)->resize(360, 431)->save($location);
            $post->image = $img;
        }

        $post->save();

        $post_cat_rel = new Post_Category_Relation;
        $post_cat_rel->post_id = $post->id;
        $post_cat_rel->post_categories_id = $request->category;
        $post_cat_rel->save();

        return back()->with('success','You have successfully created a post.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $post = Post::find($request->id);
        return view('admin.post.edit')->with('post', $post);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'title'      =>  'required|max:150',
            'body'      =>  'required',
        ]);

        $post = Post::find($request->id);
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->body = $request->body;

            if ($request->hasFile('image')) {
                $this->deletPostImage($post);

                $image = $request->file('image');
                $img = md5( $image->getClientOriginalName(). microtime() ).'.'.$image->getClientOriginalExtension();
                $location = public_path('images/post/'.$img);
                Image::make($image)->resize(360, 431)->save($location);
                $post->image = $img;
            }





        $post->save();
        return back()->with('success','You have successfully update a post.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $post = Post::find($request->id);
        if ($post) {
            deletPostImage($post);
            $post->delete();
            return back()->with('success','You have successfully delete a post.');  
            
        }
    }

    private function deletPostImage($post){
        if( $post->image ){
            $imgDestroy = public_path('images/post/'.$post->image);
            if ( file_exists($imgDestroy)  ) {
                unlink($imgDestroy);
            }
        }
    }

}
