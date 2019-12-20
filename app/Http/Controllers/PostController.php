<?php

namespace App\Http\Controllers;

use App\Post;
use App\Tag;
use App\Post_Category;
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
            $post->image = $this->savePostImage($post, $request);
        }

        $post->save();
        $categories = Post_Category::find((array)$request->category);
        $post->categories()->attach($categories);

        $tags = Tag::find((array)$request->tags);
        $post->tags()->attach($tags);

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
            $post->image = $this->savePostImage($post, $request);
        }

        $post->categories()->detach(); //Delete existing category
        $categories = Post_Category::find((array)$request->category);
        $post->categories()->attach($categories);

        // foreach ($request->category as $category) {
            // $post->categories()->attach(['post_id' => $post->id, 'post_category_id' => $category]);
        // }

        $post->tags()->detach(); //Delete existing tags
        $tags = Tag::find((array)$request->tags);
        $post->tags()->attach($tags);

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
            $post->categories()->detach();
            $post->tags()->detach(); //Delete existing tags
            $this->deletPostImage($post);
            $post->delete();
            return back()->with('success','You have successfully delete a post.');  
            
        }
    }

    private function deletPostImage($post){
        if( $post->image ){
            $imgDestroy = public_path('images/post/'.$post->image);
            $imgDestroy_sm = public_path('images/post/small/'.$post->image);
            $imgDestroy_thumb = public_path('images/post/thumb/'.$post->image);

            if ( file_exists($imgDestroy) ) unlink($imgDestroy);
            if ( file_exists($imgDestroy_sm) ) unlink($imgDestroy_sm);
            if ( file_exists($imgDestroy_thumb) ) unlink($imgDestroy_thumb);
        }
    }

    private function savePostImage($post, $request){
        $image = $request->file('image');
        $img = md5( $image->getClientOriginalName(). microtime() ).'.'.$image->getClientOriginalExtension();
        $location_sm = public_path('images/post/small/'.$img);
        $location_thumb = public_path('images/post/thumb/'.$img);
        $location = public_path('images/post/'.$img);
        Image::make($image)->resize(89, 89)->save($location_sm);
        Image::make($image)->resize(360, 250)->save($location_thumb);
        Image::make($image)->save($location);
        return $img;
    }
}
