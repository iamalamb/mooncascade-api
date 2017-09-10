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
 * @see https://laravel.com/docs/5.4/contracts
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
class MooncascadeEventManager implements Contract
{
    /**
     * Determines whether the event
     * should be delayed by a pre-determined
     * amount of time, in seconds as defined
     * by $delayRaceStartTime.
     *
     * @var boolean
     */
    protected $delayRaceStart;

    /**
     * If $delayRaceStart is true,
     * then use this value to determine
     * how long, in seconds to delay
     * the actual start of the event.
     *
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
     * Execute function intended to start the
     * initial event. This SHOULD be intended
     * as the initial entry point for all
     * underlying processes.
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
