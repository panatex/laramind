<?php

namespace App\Listeners;

use App\Events\ConfermaAcquisto;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreaFattura
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
     * @param  ConfermaAcquisto  $event
     * @return void
     */
    public function handle(ConfermaAcquisto $event)
    {
        //
    }
}
