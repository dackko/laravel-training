<?php

namespace App\Events;

class UserRemoved
{
    public $user;

    public $reason;

    public function __construct($user, $reason)
    {
        $this->user = $user;
        $this->reason = $reason;
    }
}