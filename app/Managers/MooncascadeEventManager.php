<?php

namespace Mooncascade\Managers;

use Mooncascade\Events\MooncascadeDelayedStartEvent;
use Mooncascade\Events\MooncascadeEventStartEvent;
use Mooncascade\Contracts\Managers\MooncascadeEventManager as Contract;

/**
 * Class MooncascadeEventManager
 *
 * Responsible for the execution of the demo event
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
class MooncascadeEventManager implements Contract
{
    /**
     * @var boolean
     */
    protected $delayRaceStart;

    /**
     * @var integer
     */
    protected $delayRaceStartTime;

    /**
     * MooncascadeEventManager constructor.
     * @param bool $delayRaceStart
     * @param int $delayRaceStartTime
     */
    public function __construct($delayRaceStart, $delayRaceStartTime)
    {
        $this->delayRaceStart = $delayRaceStart;
        $this->delayRaceStartTime = $delayRaceStartTime;
    }

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
