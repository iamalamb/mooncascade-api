<?php

namespace Mooncascade\Strategies;

use Illuminate\Support\Collection;

/**
 * Class SequentialAthleteRaceStrategy
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
class SequentialAthleteRaceStrategy extends AbstractAthleteRaceStrategy
{
    /**
     * @return Collection
     */
    public function execute(): Collection
    {
        parent::execute();

        if ($this->entities->count() > 1) {
            $this->entities->each(
                function ($entity) {
                    $time = $this->calculateTime();
                    $this->setCalculatedTimeForEntity($entity, $this->getProperty(), $time);

                    $this->dispatchEvent($entity);
                }
            );
        }


        return $this->entities;
    }
}
