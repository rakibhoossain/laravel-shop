<?php

namespace App\Http\Controllers;

use App\Product_review;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\CommentCollection;
use Notification;
use App\Notifications\ShopNotification;

class ProductReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         if(Auth::check()){
            $request->validate([
                'body'      =>  'required',
                'product_id'      =>  'required',
            ]);
        }else{
            $request->validate([
                'body'      =>  'required',
                'product_id'      =>  'required',
                'name'      =>  'required',
                'email'      =>  'required',
            ]);
        }

        

        $product_review = new Product_review;
        $product_review->body = $request->body;
        $product_review->product_id = $request->product_id;

        $product_review->rating = $request->rating;



        if(Auth::check()){
            $product_review->user_id = auth()->user()->id;
        }else{
            $product_review->name = $request->name;
            $product_review->email = $request->email;
            $product_review->website = $request->website;

            if($request->phone) $product_review->phone = $request->phone;           
        }

        $product_review->save();

        $users = User::where('is_admin', 1)->get();
        $details = [
            'title' => 'New product rating!',
            'actionURL' => route('admin.product.reviews'),  //TODO add id
            'fas' => 'fa-star'
        ];
        Notification::send($users, new ShopNotification($details)); 

        return back()->with('success','You have successfully review. Waiting for aproval');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product_review  $product_review
     * @return \Illuminate\Http\Response
     */
    public function show(Product_review $product_review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product_review  $product_review
     * @return \Illuminate\Http\Response
     */
    public function edit(Product_review $product_review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product_review  $product_review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product_review $product_review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product_review  $product_review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product_review $product_review)
    {
        //
    }
}
