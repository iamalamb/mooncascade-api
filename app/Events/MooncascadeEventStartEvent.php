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
    public function getStartTime(): int
    {
        return $this->startTime;
    }

    /**
     * @param int $startTime
     * @return MooncascadeEventStartEvent
     */
    public function setStartTime(int $startTime): MooncascadeEventStartEvent
    {
        $this->startTime = $startTime;

        return $this;
    }
}
