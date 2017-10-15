<?php

namespace App\Listeners;

use App\Events\InviaNotifica;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotificaToCliente
{
    private $arData;

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
        //quindi abbaimo a disposizione della proprietà pubblica
        //occhio mettere il true altrimenti lo ritorna nello srd output
        \Log::info('[NotificaToCliente]' . print_r($event->arData, true));
    }
}
