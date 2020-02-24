<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionsController extends Controller
{
    //
    public function __construct()
    {
      $this->middleware('guest', ['except'=>'destroy']);
    }

    public function create()
    {
      return view('sessions.create');
    }

    public function store(Request $request)
    {
      $this->validate($request,[
        'email'=>'required|email',
        'password'=>'required|min:6',
      ]);

      if(!auth()->attempt($request->only('email','password'), $request->has('remember'))){
        flash('Email or Password is incorrect!');
        return back()->withInput();
      }

      if(!auth()->user()->activated){
        auth()->logout();
        flash('Please, verify on your registered email.');
      }

      flash(auth()->user()->name . 'welcome :)');

      return redirect()->intended('home');
    }
}
