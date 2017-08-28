<?php

namespace Mooncascade\Strategies;

/**
 * Class SequentialAthleteRaceStrategy
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
class SequentialAthleteRaceStrategy extends AbstractAthleteRaceStrategy
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

            $entities->each(
                function ($entity) use ($property) {

                    $time = $this->calculateTime();
                    $this->setCalculatedTimeForEntity($entity, $property, $time);
                }
            );
        }


        return $entities;
    }
}
