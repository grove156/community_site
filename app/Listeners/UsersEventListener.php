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
