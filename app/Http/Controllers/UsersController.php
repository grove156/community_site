<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function create()
    {
      return view('users.create');
    }

    public function store(request $request)
    {
      $this->validate($request, [
        'name'=>'required|max:255',
        'email'=>'required|email|max:255|unique:users',
        'password'=>'required|confirmed|min:6',
      ]);

      $confirmCode = Str::random(60);

      $user = User::create([
            'name'=> $request->input('name'),
            'email'=> $request->input('email'),
            'password'=> bcrypt($request->input('password')),
            'confirm_code'=>$confirmCode
        ]);
    //  \Mail::send('emails.auth.confirm', compact('user'), function ($message) use($user){
    //    $message->to($user->email);
    //    $message->subject(
    //      sprintf('[%s] Please confirm your registration.', config('app.name'))
    //      );
    //  });
    //  flash('We sent confirmation message via your email. please, check that message in your email and login :)');
    //  return redirect('/');
    event(new \App\Events\UserCreated($user));
    return $this->respondCreated('We sent confirmation message via your email. please, check that message in your email and login :)');
    }

    protected function respondCreated($message)
    {
      flash($message);
      return redirect('/');
    }

    public function confirm($code)
    {
      $user = User::whereConfirmCode($code)->first();

      if(!$user){
        flash('URL is incorrect!');
        return redirect('/');
      }
      $user->activated = 1;
      $user->confirm_code = null;
      $user->save();

      auth()->login($user);
      flash(auth()->user()->name . ', welcome :)');

      return redirect('home');
    }
}
