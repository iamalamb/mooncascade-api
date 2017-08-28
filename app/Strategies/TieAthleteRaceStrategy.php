<?php

namespace Mooncascade\Strategies;

use Illuminate\Support\Collection;
use Mooncascade\Entities\Athlete;

/**
 * Class TieAthleteRaceStrategy
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
class TieAthleteRaceStrategy extends AbstractAthleteRaceStrategy
{
    /**
     * @param array $params
     * @return Collection
     */
    public function execute(array $params)
    {
        $entities = parent::execute($params);

        if ($entities) {

            $time = $this->calculateTime();
            $property = $params['property'];

            $entities->each(
                function (Athlete $entity) use ($time, $property) {

                    $this->setCalculatedTimeForEntity($entity, $property, $time);
                }
            );
        }

        return $entities;
    }

}
