<?php

namespace Mooncascade\Events;

use Illuminate\Support\Collection;

/**
 * Interface MooncascadeAthleteEventInterface
 */
interface MooncascadeAthleteEventInterface
{
    /**
     * @return Collection
     */
    public function getEntities(): Collection;

    /**
     * @param Collection $entities
     * @return MooncascadeAthleteEventInterface
     */
    public function setEntities(Collection $entities): MooncascadeAthleteEventInterface;
}
