<?php

namespace Mooncascade\Events;

use Illuminate\Foundation\Events\Dispatchable;

class MooncascadeEventStartEvent
{
    use Dispatchable;

    /**
     * @var integer
     */
    protected $startTime;

    /**
     * MooncascadeEventStartEvent constructor.
     * @param int $startTime
     */
    public function __construct($startTime)
    {
        $this->startTime = $startTime;
    }

    /**
     * @return int
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * @param int $startTime
     * @return MooncascadeEventStartEvent
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;

        return $this;
    }

}
