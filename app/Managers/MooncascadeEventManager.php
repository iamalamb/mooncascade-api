<?php

namespace Mooncascade\Managers;

use Mooncascade\Events\MooncascadeDelayedStartEvent;
use Mooncascade\Events\MooncascadeEventStartEvent;

/**
 * Class MooncascadeEventManager
 *
 * Responsible for the execution of the demo event
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
class MooncascadeEventManager implements MooncascadeEventManagerInterface
{
    /**
     * Single point of execution.
     * Responsible for all underlying processes.
     */
    public function execute()
    {
        /*
         * Check if we need to delay
         * the initial execution of
         * the event
         */
        if ($this->delayRaceStart) {

            $event = new MooncascadeDelayedStartEvent($this->delayRaceStartTime);
            event($event);

            sleep($this->delayRaceStartTime);
        }

        /*
         * Dispatch an event to notify that the event
         * has now officially started.
         */
        $time = time();

        $event = new MooncascadeEventStartEvent($time);
        event($event);
    }
}
