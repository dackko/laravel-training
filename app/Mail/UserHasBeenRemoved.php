<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserHasBeenRemoved extends Mailable
{
    use Queueable, SerializesModels;

    /** @var User $user */
    public $user;

    /**
     * @var string
     */
    public $reason;

    public function __construct(User $user, string $reason)
    {
        $this->user = $user;
        $this->reason = $reason;
    }

    public function build()
    {
        return $this->markdown('emails.users.delete');
    }

}