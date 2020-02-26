<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UsersEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function subscribe(\Illuminate\Events\Dispatcher $events)
    {
      $events->listen(
          \App\Events\UserCreated::class,
          __CLASS__ . '@onUserCreated'
      );

      $events->listen(
        \App\Events\PasswordRemindCreated::class,
        __CLASS__ . '@onPasswordRemindCreated'
      );
    }

    public function onUserCreated(\App\Events\UserCreated $event)
    {
      $user = $event->user;
      \Mail::send('emails.auth.confirm', compact('user'), function ($message) use($user){
        $message->to($user->email);
        $message->subject(
            sprintf('[%s] Please confirm your registration.', config('app.name'))
        );
      });
    }

    public function onPasswordRemindCreated(\App\Events\PasswordRemindCreated $event)
    {
        $param = ['token'=> $event->token, 'username'=>$event->username];
       \Mail::send('emails.passwords.reset',$param,
        function ($message) use ($event){
            $message->to($event->email);
            $message->subject(
             sprintf('[%s] reset your password', config('app.name'))
            );
        });
    }
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        //
    }
}
