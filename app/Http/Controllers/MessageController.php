<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;
use App\Events\MessageEvent;
use Helper;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = Message::paginate(20);
        return view('admin.message.index')->with('messages', $messages);
    }    

    public function messageFive()
    {
        $messages = Message::whereNull('read_at')->limit(5)->get();
        return response()->json($messages);
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
        $this->validate($request, [
        'name' => 'required|min:2',
        'email' => 'required|email',
        'message' => 'required|min:20',
        'subject' => 'required|max:200|min:4'
        ]);
       $message = Message::create($request->all());

       $data = array();
       $data['url'] = route('admin.message.show', $message->id);
       $data['date'] = $message->created_at->format('F d, Y h:i A');
       $data['name'] = $message->name;
       $data['email'] = $message->email;
       $data['image'] = Helper::get_gravatar($message->email,60);
       $data['message'] = $message->message;
       $data['subject'] = $message->subject;

       event(new MessageEvent($data));
       exit();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $message = Message::find($request->id);
        if($message){
            $message->read_at = \Carbon\Carbon::now();
            $message->save();  
            return view('admin.message.show')->with('message', $message); 
        }else{
            return back();
        }         
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $message = Message::find($request->id);
        if($message){
          $message->delete(); 
          return back()->with('success','Message delete success!.');
        }else{
            return back()->withErrors('Invalid message!.');
        }
    }
}
