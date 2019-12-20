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
        $review = Product_review::first();
        return view('admin.product.review.index')->with('review', $review);
    }
    
    public function commentsList()
    {   
        return new CommentCollection( Product_review::all() );
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
                'review_body'      =>  'required',
                'review_product_id'      =>  'required',
                'rating'      =>  'required',
            ]);
        }else{
            $request->validate([
                'review_body'      =>  'required',
                'review_product_id'      =>  'required',
                'review_name'      =>  'required',
                'review_email'      =>  'required',
                'rating'      =>  'required',
            ]);
        }

        

        $product_review = new Product_review;
        $product_review->body = $request->review_body;
        $product_review->product_id = $request->review_product_id;

        $product_review->rating = $request->rating;



        if(Auth::check()){
            $product_review->user_id = auth()->user()->id;
        }else{
            $product_review->name = $request->review_name;
            $product_review->email = $request->review_email;
            $product_review->website = $request->review_website;

            if($request->has('review_phone')) $product_review->phone = $request->review_phone;           
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
    public function edit(Request $request)
    {
        $review = Product_review::find($request->id);
        return view('admin.product.review.edit')->with('review', $review);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product_review  $product_review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $review = Product_review::find($request->id);
        if ($review) {

            if($review->name){

                $request->validate([
                    'body'      =>  'required',
                    'name'      =>  'required',
                    'email'      =>  'required',
                    'rating'      =>  'required',
                ]);

            }else{
                $request->validate([
                    'body'      =>  'required',
                    'rating'      =>  'required',
                ]);
            }


            $review->body = $request->body;
            $review->status = $request->status;
            $review->rating = $request->rating;

            if($review->name){
                $review->name = $request->name;
                $review->email = $request->email;
                $review->website = $request->website; 
                if($request->has('phone')) $review->phone = $request->phone; 
            }

            $review->save();

            $users = User::where('is_admin', 1)->get();
            $details = [
                'title' => 'Updated review!',
                'actionURL' => route('admin.product.reviews'),  //TODO add
                'fas' => 'fa-star'
            ];
            Notification::send($users, new ShopNotification($details)); 

            return back()->with('success','You have successfully updated review.');

        }else{
            return back()->withError('Invalid review.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product_review  $product_review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $review = Product_review::find($request->id);
        if ($review) {
            $review->delete();
            return back()->with('success','You have successfully delete a review.');
        }else{
            return back()->withErrors('Invalid review!.');
        }
    }
}
