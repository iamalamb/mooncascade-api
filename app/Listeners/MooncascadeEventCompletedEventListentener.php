<?php

namespace Mooncascade\Listeners;

use Mooncascade\Events\MooncascadeEventCompletedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class MooncascadeEventCompletedEventListentener
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
     * @param  MooncascadeEventCompletedEvent  $event
     * @return void
     */
    public function handle(MooncascadeEventCompletedEvent $event)
    {
        //
    }
}
