<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

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


    public function show(Request $request){
        $post = Post::where('slug', $request->slug)->first();
    	return view('post.single')->with('post', $post);
    }

}
