<?php

namespace Mooncascade\Strategies;

use Illuminate\Support\Collection;

/**
 * Class TieAthleteRaceStrategy
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
class TieAthleteRaceStrategy extends AbstractAthleteRaceStrategy
{
    /**
     * @return Collection
     */
    public function execute(): Collection
    {
        parent::execute();

        if ($this->entities->count() > 1) {
            $time = $this->calculateTime();
            $this->entities->each(
                function ($entity) use ($time) {
                    $this->setCalculatedTimeForEntity($entity, $this->getProperty(), $time);

                    $this->dispatchEvent($entity);
                }
            );
        }

        return $this->entities;
    }
}
