<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->get();
        return view('shop.home')->with('products', $products);
    }
    /** Return view to upload file */
    public function uploadFile(){
        return view('welcome');
    }

/** Example of File Upload */
    public function uploadFilePost(Request $request){
        $request->validate([
            'fileToUpload' => 'required|file|max:1024',
        ]);
        $request->fileToUpload->store('logos');
        return back()->with('success','You have successfully upload image.');
    }


    
}
