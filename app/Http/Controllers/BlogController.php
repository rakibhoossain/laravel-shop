<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Post_category;

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
            'category' =>  Post_category::where('slug', $request->slug)->first()->name,
            'posts' => Post_category::where('slug', $request->slug)->first()->posts()->paginate(10)
        );
        return view('post.category')->with($data);
    }


    public function show(Request $request){
        $post = Post::where('slug', $request->slug)->first();
    	return view('post.single')->with('post', $post);
    }

}
