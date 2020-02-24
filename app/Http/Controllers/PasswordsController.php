<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

      \Mail::send('emails.passwords.reset', compact('token'), function ($message) use($email){
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


}
