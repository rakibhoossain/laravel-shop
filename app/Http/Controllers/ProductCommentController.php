<?php

namespace App\Http\Controllers;

use App\Product_Comment;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\CommentCollection;
use Notification;
use App\Notifications\ShopNotification;


class ProductCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comment = Product_Comment::first();
        return view('admin.product.comment.index')->with('comment', $comment);
    }

    public function commentsList()
    {   
        return new CommentCollection( Product_Comment::all() );
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

        

        $product_comment = new Product_Comment;
        $product_comment->body = $request->body;
        $product_comment->product_id = $request->product_id;
        if ($request->has('parent_id')) {
            $product_comment->parent_id = $request->parent_id;
        }

        if(Auth::check()){
            $product_comment->user_id = auth()->user()->id;
        }else{
            $product_comment->name = $request->name;
            $product_comment->email = $request->email;
            $product_comment->website = $request->website;

            if($request->has('phone')) $product_comment->phone = $request->phone;           
        }

        $product_comment->save();

        $users = User::where('is_admin', 1)->get();
        $details = [
            'title' => 'New product Comment!',
            'actionURL' => route('admin.product.comments'),  //TODO add id
            'fas' => 'fa-comment'
        ];
        Notification::send($users, new ShopNotification($details)); 

        return back()->with('success','You have successfully commented. Waiting for aproval');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product_Comment  $product_Comment
     * @return \Illuminate\Http\Response
     */
    public function show(Product_Comment $product_Comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product_Comment  $product_Comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $comment = Product_Comment::find($request->id);
        return view('admin.product.comment.edit')->with('comment', $comment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product_Comment  $product_Comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $comment = Product_Comment::find($request->id);
        if ($comment) {

            if($comment->name){

                $request->validate([
                    'body'      =>  'required',
                    'name'      =>  'required',
                    'email'      =>  'required',
                ]);

            }else{
                $request->validate([
                    'body'      =>  'required',
                ]);
            }


            $comment->body = $request->body;
            $comment->status = $request->status;

            if($comment->name){
                $comment->name = $request->name;
                $comment->email = $request->email;
                $comment->website = $request->website; 
                if($request->has('phone')) $comment->phone = $request->phone;  
            }

            $comment->save();

            $users = User::where('is_admin', 1)->get();
            $details = [
                'title' => 'Updated Comment!',
                'actionURL' => route('admin.product.comments'),  //TODO add id
                'fas' => 'fa-comment'
            ];
            Notification::send($users, new ShopNotification($details)); 

            return back()->with('success','You have successfully updated commented.');

        }else{
            return back()->withError('Invalid comment.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product_Comment  $product_Comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $comment = Product_Comment::find($request->id);
        if ($comment) {
            $comment->delete();
            return back()->with('success','You have successfully delete a comment.');
        }else{
            return back()->withErrors('Invalid comment!.');
        }
    }
}
