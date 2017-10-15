<?php

namespace App\Listeners;

use App\Events\InviaNotifica;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotificaToIacopo
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
     * @param  InviaNotifica  $event
     * @return void
     */
    public function handle(InviaNotifica $event)
    {
        //
    }
}
