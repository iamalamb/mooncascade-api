<?php

namespace Mooncascade\Managers;

use Mooncascade\Events\MooncascadeDelayedStartEvent;
use Mooncascade\Events\MooncascadeEventStartEvent;
use Doctrine\Common\Persistence\ObjectRepository;
use Illuminate\Support\Facades\Log;

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
     * @var boolean
     */
    protected $delayRaceStart;

    /**
     * @var integer
     */
    protected $delayRaceStartTime;

    /**
     * @return bool
     */
    public function isDelayRaceStart()
    {
        return $this->delayRaceStart;
    }

    /**
     * @param bool $delayRaceStart
     * @return MooncascadeEventManager
     */
    public function setDelayRaceStart($delayRaceStart)
    {
        $this->delayRaceStart = $delayRaceStart;

        return $this;
    }

    /**
     * @return int
     */
    public function getDelayRaceStartTime()
    {
        return $this->delayRaceStartTime;
    }

    /**
     * @param int $delayRaceStartTime
     * @return MooncascadeEventManager
     */
    public function setDelayRaceStartTime($delayRaceStartTime)
    {
        $this->delayRaceStartTime = $delayRaceStartTime;

        return $this;
    }


    /**
     * @return ObjectRepository
     */
    public function getRepostiory(): ObjectRepository
    {
        return $this->repostiory;
    }

    /**
     * @param ObjectRepository $repostiory
     * @return MooncascadeEventManager
     */
    public function setRepostiory(ObjectRepository $repostiory): MooncascadeEventManager
    {
        $this->repostiory = $repostiory;

        return $this;
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
