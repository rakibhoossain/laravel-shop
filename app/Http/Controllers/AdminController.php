<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Resources\UserCollection;

class AdminController extends Controller
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
    
    public function index(){

        return view('admin.home');
    }
    public function users(){
        $users = User::orderBy('id', 'desc')->paginate(9);
        return view('admin.user.index')->with('users', $users);
    }    
    public function usersList()
    {   
        return new UserCollection( User::all() );
    }


}
