<?php

namespace Mooncascade\Managers;

use Mooncascade\Events\MooncascadeDelayedStartEvent;
use Mooncascade\Events\MooncascadeEventStartEvent;
use Doctrine\Common\Persistence\ObjectRepository;
use Mooncascade\Strategies\RangeCalculationStrategy;
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
     * @var RangeCalculationStrategy
     */
    protected $rangeCalculationStrategy;

    /**
     * @var ObjectRepository
     */
    protected $repostiory;

    /**
     * MooncascadeEventManager constructor.
     * @param RangeCalculationStrategy $rangeCalculationStrategy
     * @param ObjectRepository $repostiory
     */
    public function __construct(RangeCalculationStrategy $rangeCalculationStrategy, ObjectRepository $repostiory)
    {
        $this->rangeCalculationStrategy = $rangeCalculationStrategy;
        $this->repostiory = $repostiory;
    }

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
     * @return RangeCalculationStrategy
     */
    public function getRangeCalculationStrategy(): RangeCalculationStrategy
    {
        return $this->rangeCalculationStrategy;
    }

    /**
     * @param RangeCalculationStrategy $rangeCalculationStrategy
     * @return MooncascadeEventManager
     */
    public function setRangeCalculationStrategy(RangeCalculationStrategy $rangeCalculationStrategy
    ): MooncascadeEventManager {
        $this->rangeCalculationStrategy = $rangeCalculationStrategy;

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

        // Start to loop through the results
    }

    /**
     * This should ideally be extracted later and moved
     * either to the listener for the race start event
     * or a seperate service run from here of the listener.
     *
     * TODO: Extract and move
     */
    public function fetchResults()
    {
        // TODO: Set this dynamicaly using config
        $min = 1;
        $max = 10;

        // Get a dynamic random batch number to process
        $limit = $this->rangeCalculationStrategy->setMin($min)->setMax($max)->execute();

        Log::debug('About to retrieve ' .  $limit . ' items');
    }
}
