<?php

namespace Mooncascade\Strategies;

use Illuminate\Support\Collection;
use Mooncascade\Entities\Athlete;

/**
 * Class OvertakeAthleteRaceStrategy
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
class OvertakeAthleteRaceStrategy extends AbstractAthleteRaceStrategy
{
    /**
     * @return bool|mixed
     */
    public function execute(): Collection
    {
        parent::execute();

        if ($this->entities->count() > 1) {
            /*
             * Simple random re-ordering of
             * the original entities provided.
             *
             * Time permitting, I would have probably
             * implemented an alternative algorithm.
             */
            $entities = $this->entities->shuffle();

            // Loop through each shuffled entity
            $entities->each(
                function (Athlete $entity) {

                    // Calculate a random time, and sleep
                    $time = $this->calculateTime();

                    // Set our dynamic property
                    $this->setCalculatedTimeForEntity($entity, $this->getProperty(), $time);

                    $this->dispatchEvent($entity);
                }
            );
        }

        return $entities;
    }
}
