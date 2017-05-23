<?php

namespace App\Listeners;

use App\User;
use Illuminate\Auth\Events\Lockout;
use App\Notifications\Lockout as Lock;

class LogLockout extends Lockout
{
    /**


    /**
     * Handle the event.
     *
     * @param  Lockout  $event
     * @return void
     */
    public function handle(Lockout $event)
    {
        //dd($event->request['email']);
        $user = User::where('email','=',$event->request['email'])->first();
        $user->notify(new Lock($user));
        dd($user);
    }
}
