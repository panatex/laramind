<?php

namespace App\Listeners;

use App\Events\RegistraRecord;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotificaAvvenutaRegistrazione
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
     * @param  RegistraRecord  $event
     * @return void
     */
    public function handle(RegistraRecord $event)
    {
        //
    }
}
