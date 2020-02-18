<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CreatedUserMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $subject = "User created ";

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('adminnn@gmail.com')
            ->to($this->user->email)
            ->markdown('emails.orders.shipped');
//            ->view('emails.create-user-mail');
    }
}
