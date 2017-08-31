<?php

namespace Mooncascade\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Support\Collection;

/**
 * Class AbstractMoonCascadeAthleteEvent
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
abstract class AbstractMoonCascadeAthleteEvent implements MooncascadeAthleteEventInterface
{
    use Dispatchable;

    /**
     * @var Collection
     */
    protected $entities;

    /**
     * @return Collection
     */
    public function getEntities(): Collection
    {
        return $this->entities;
    }

    /**
     * @param Collection $entities
     * @return MooncascadeAthleteEventInterface
     */
    public function setEntities(Collection $entities): MooncascadeAthleteEventInterface
    {
        $this->entities = $entities;

        return $this;
    }
}
