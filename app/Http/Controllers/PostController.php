<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        
        $post->save();
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
            $post->delete();
            return back()->with('success','You have successfully delete a post.');  
        }
    }
}
