<?php

namespace Mooncascade\Strategies;

/**
 * Class SequentialAthleteStrategy
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
class SequentialAthleteStrategy extends AbstractTimeCalculationStrategy
{
    /**
     * @param array $params
     * @return bool|mixed
     */
    public function execute(array $params)
    {
        $entities = parent::execute($params);

        $property = $params['property'];

        $entities->each(
            function ($entity) use ($property) {

                $time = $this->calculateTime();
                $this->setCalculatedTimeForEntity($entity, $property, $time);
            }
        );

        return $entities;
    }
}
