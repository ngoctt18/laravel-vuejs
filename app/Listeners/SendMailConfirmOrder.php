<?php

namespace App\Listeners;

use App\Events\CustomerOrder;
use App\Mail\CreatedUserMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailConfirmOrder implements ShouldQueue // ===== thêm queue
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
     * @param CustomerOrder $event
     * @return void
     */
    public function handle(CustomerOrder $event)
    {
        Mail::queue(new CreatedUserMail($event->user)); // ===== gửi vào queue
    }
}
