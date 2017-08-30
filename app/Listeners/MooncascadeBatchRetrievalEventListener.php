<?php

namespace Mooncascade\Listeners;

use Mooncascade\Events\MooncascadeBatchRetrievalEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class MooncascadeBatchRetrievalEventListener
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
     * @param  MooncascadeBatchRetrievalEvent  $event
     * @return void
     */
    public function handle(MooncascadeBatchRetrievalEvent $event)
    {
        //
    }
}
