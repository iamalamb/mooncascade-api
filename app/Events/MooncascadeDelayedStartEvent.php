<?php

namespace Mooncascade\Events;

use Illuminate\Foundation\Events\Dispatchable;

class MooncascadeDelayedStartEvent
{
    use Dispatchable;

    /**
     * @var integer
     */
    protected $delayRaceStartTime;

    /**
     * MooncascadeDelayedStartEvent constructor.
     * @param int $delayRaceStartTime
     */
    public function __construct($delayRaceStartTime)
    {
        $this->delayRaceStartTime = $delayRaceStartTime;
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
     * @return MooncascadeDelayedStartEvent
     */
    public function setDelayRaceStartTime($delayRaceStartTime)
    {
        $this->delayRaceStartTime = $delayRaceStartTime;

        return $this;
    }

}
