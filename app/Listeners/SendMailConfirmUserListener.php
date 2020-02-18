<?php

namespace App\Listeners;

use App\Events\UserCreatedEvent;
use App\Mail\CreatedUserMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendMailConfirmUserListener implements ShouldQueue // ===== thêm queue
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

    /**
     * Handle the event.
     *
     * @param UserCreatedEvent $event
     * @return void
     */
    public function handle(UserCreatedEvent $event)
    {
        Mail::queue(new CreatedUserMail($event->user)); // ===== gửi vào queue
    }
}
