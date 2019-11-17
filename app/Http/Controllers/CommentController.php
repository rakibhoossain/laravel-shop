<?php

namespace App\Http\Controllers;

use App\Comment;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\CommentCollection;
use Notification;
use App\Notifications\ShopNotification;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comment = Comment::first();
        return view('admin.comment.index')->with('comment', $comment);
    }

    public function commentsList()
    {   
        return new CommentCollection( Comment::all() );
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
                'post_id'      =>  'required',
            ]);
        }else{
            $request->validate([
                'body'      =>  'required',
                'post_id'      =>  'required',
                'name'      =>  'required',
                'email'      =>  'required',
            ]);
        }

        

        $comment = new Comment;
        $comment->body = $request->body;
        $comment->post_id = $request->post_id;
        if ($request->parent_id) {
            $comment->parent_id = $request->parent_id;
        }

        if(Auth::check()){
            $comment->user_id = auth()->user()->id;
        }else{
            $comment->name = $request->name;
            $comment->email = $request->email;
            $comment->website = $request->website;            
        }

        $comment->save();

        $users = User::where('is_admin', 1)->get();
        $details = [
            'title' => 'New Comment!',
            'actionURL' => route('admin.comments'),  //TODO add id
            'fas' => 'fa-comment'
        ];
        Notification::send($users, new ShopNotification($details)); 

        return back()->with('success','You have successfully commented.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $comment = Comment::find($request->id);
        if ($comment) {
            $comment->delete();
            return redirect()->route('admin.comments')->with('success','You have successfully delete a comment.');
        }else{
            return redirect()->route('admin.comments')->withErrors('Invalid comment!.');
        }
    }
}
