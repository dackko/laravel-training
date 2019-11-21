<?php

namespace App\Listeners;

use App\Events\UserRemoved;
use App\Mail\UserHasBeenRemoved;
use Illuminate\Support\Facades\Mail;

class UserRemovedListener
{
    public function handle(UserRemoved $event)
    {
        Mail::to($event->user->email)->send(new UserHasBeenRemoved($event->user,
            $event->reason));
    }
}