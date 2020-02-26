<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\User;

class PasswordsController extends Controller
{
    //
    public function __construct()
    {
      $this->middleware('guest');
    }

    public function getRemind()
    {
      return view('passwords.remind');
    }

    public function postRemind(Request $request)
    {
      $this->validate($request,['email'=>'required|email|exists:users']);
      $email = $request->get('email');
      $token = Str::random(64);

      \DB::table('password_resets')->insert([
        'email'=>$email,
        'token'=>$token,
        'created_at'=> \Carbon\Carbon::now()->toDateTimeString(),
      ]);
      $user = User::whereEmail($email)->first();
      $username = $user->name;
      //event(new \App\Events\PasswordRemindCreated($email, $token));

      \Mail::send('emails.passwords.reset', compact('token','username'), function ($message) use($email){
        $message->to($email);
        $message->subject(
            sprintf('[%s] Reset your Password', config('app.name')),
        );
      });

      flash('We have sent email to reset your passwords');
      return redirect('/');
    }

    public function getReset($token = null)
    {
      return view('passwords.reset', compact('token'));
    }

    public function postReset(Request $request)
    {
      $this->validate($request, [
          'email'=>'required|email|exists:users',
          'password'=>'required|confirmed',
          'token'=>'required',
      ]);
      $token = $request->get('token');

      if(! \DB::table('password_resets')->whereToken($token)->first()){
        flash('URL is incorrect!');
        //return back()->withInput();
      }

      \App\User::whereEmail($request->input('email'))->first()->update([
        'password'=>bcrypt($request->input('password'))
      ]);

      \DB::table('password_resets')->whereToken($token)->delete();

      flash('Your password has been changed. Please login with your new password');

      return redirect('/home');
    }

}
