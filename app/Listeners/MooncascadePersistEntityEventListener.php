<?php

namespace Mooncascade\Listeners;

use Mooncascade\Events\MooncascadePersistEntityEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class MooncascadePersistEntityEventListener
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
     * @param  MooncascadePersistEntityEvent  $event
     * @return void
     */
    public function handle(MooncascadePersistEntityEvent $event)
    {
        //
    }
}
