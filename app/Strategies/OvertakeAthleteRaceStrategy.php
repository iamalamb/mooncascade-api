<?php

namespace Mooncascade\Strategies;

use Mooncascade\Entities\Athlete;

/**
 * Class OvertakeAthleteRaceStrategy
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
class OvertakeAthleteRaceStrategy extends AbstractAthleteRaceStrategy
{
    /**
     * @param array $params
     * @return bool|mixed
     */
    public function execute(array $params)
    {
        $entities = parent::execute($params);

        if ($entities) {

            $property = $params['property'];

            /*
             * Simple random re-ordering of
             * the original entities provided.
             *
             * Time permitting, I would have probably
             * implemented an alternative algorithm.
             */
            $entities = $entities->shuffle();

            // Loop through each shuffled entity
            $entities->each(
                function (Athlete $entity) use ($property) {

                    // Calculate a random time, and sleep
                    $time = $this->calculateTime();

                    // Set our dynamic property
                    $this->setCalculatedTimeForEntity($entity, $property, $time);
                }
            );
        }

        return $entities;
    }
}
