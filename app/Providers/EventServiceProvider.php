<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        //un evento può avere più listener chiamati in sequenza i listener
        'App\Events\InviaNotifica' => [
            'App\Listeners\NotificaToCliente',
            'App\Listeners\NotificaToMagazzino',
            'App\Listeners\NotificaToIacopo',
        ],
        //un evento può avere più listener
        'App\Events\RegistraRecord' => [
            'App\Listeners\RegistraAltraInformazione',
            'App\Listeners\NotificaAvvenutaRegistrazione',
        ],
        'App\Events\ConfermaAcquisto' => [
            'App\Listeners\InviaOrdineMagazzino',
            'App\Listeners\CreaFattura',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
