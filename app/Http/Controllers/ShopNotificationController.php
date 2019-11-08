<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class ShopNotificationController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request){
        return view('admin.layouts.notification');
    }

    public function show(Request $request){
        $notification = auth()->user()->notifications()->where('id', $request->id)->first();
        if ($notification) {
            $notification->markAsRead();
            return redirect($notification->data['actionURL']);
        }       
    }

    public function delete(Request $request){
        $notification = auth()->user()->notifications()->where('id', $request->id)->first();
        if ($notification) {
            $notification->delete();
            return redirect()->route('admin.notifications')->with('success','Notification delete success!.');
        }else{
            return redirect()->route('admin.notifications')->withErrors('Invalid notification!.');
        }       
    }




}
