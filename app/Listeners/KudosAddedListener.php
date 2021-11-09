<?php

namespace App\Listeners;

use App\Events\KudosAddedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class KudosAddedListener
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
     * @param  KudosAddedEvent  $event
     * @return void
     */
    public function handle(KudosAddedEvent $event)
    {
        //
    }
}
