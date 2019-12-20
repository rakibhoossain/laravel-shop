<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Post_category;
use App\Tag;
use App\User;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
    	$posts = Post::orderBy('id', 'desc')->paginate(10);
    	return view('post')->with('posts', $posts);

    }

    public function categoryPost(Request $request){
        $data = array(
            'title' =>  Post_category::where('slug', $request->slug)->first()->name,
            'posts' => Post_category::where('slug', $request->slug)->first()->posts()->paginate(10)
        );
        return view('post.archive')->with($data);
    }    

    public function tagPost(Request $request){
        $data = array(
            'title' =>  Tag::where('slug', $request->slug)->first()->name,
            'posts' => Tag::where('slug', $request->slug)->first()->posts()->paginate(10)
        );
        return view('post.archive')->with($data);
    }

    public function userPost(Request $request){
        $data = array(
            'title' => User::find($request->id)->name,
            'posts' => User::find($request->id)->posts()->paginate(10)
        );
        return view('post.archive')->with($data);
    }

    public function show(Request $request){
        $post = Post::where('slug', $request->slug)->first();
        $previous = Post::where('id', '<', $post->id)->orderBy('id','desc')->first();
        $next = Post::where('id', '>', $post->id)->orderBy('id')->first();
        
        $data = array(
            'post' => $post,
            'previous' => $previous,
            'next' => $next
        );

    	return view('post.single')->with($data);
    }

    public function search(Request $request){
        $posts = Post::orWhere('title', 'like', '%'.$request->search.'%' )
                    ->orWhere('body', 'like', '%'.$request->search.'%' )
                    ->orWhere('slug', 'like', '%'.$request->search.'%' )
                    ->orderBy('id', 'desc')
                    ->paginate(9);
        return view('post')->with('posts', $posts);

    }

}
