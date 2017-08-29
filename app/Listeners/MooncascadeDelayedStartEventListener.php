<?php

namespace Mooncascade\Listeners;

use Mooncascade\Events\MooncascadeDelayedStartEvent;

class MooncascadeDelayedStartEventListener extends AbstractLoggableEventListener
{
    /**
     * Handle the event.
     *
     * @param  MooncascadeDelayedStartEvent  $event
     * @return void
     */
    public function handle(MooncascadeDelayedStartEvent $event)
    {
        $message = 'Delaying race start time by ' . $event->getDelayRaceStartTime() . ' seconds';
        $this->logMessage($message);
    }
}
