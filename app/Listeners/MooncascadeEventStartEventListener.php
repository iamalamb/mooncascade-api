<?php

namespace Mooncascade\Listeners;

use Mooncascade\Events\MooncascadeEventStartEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class MooncascadeEventStartEventListener
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
     * @param  MooncascadeEventStartEvent  $event
     * @return void
     */
    public function handle(MooncascadeEventStartEvent $event)
    {
        //
    }
}
