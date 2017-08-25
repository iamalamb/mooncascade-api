<?php

namespace Mooncascade\Strategies;

use Illuminate\Support\Collection;
use Mooncascade\Entities\Athlete;

/**
 * Class TieAthleteStrategy
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
class TieAthleteStrategy extends AbstractTimeCalculationStrategy
{
    /**
     * @param array $params
     * @return Collection
     */
    public function execute(array $params): Collection
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
