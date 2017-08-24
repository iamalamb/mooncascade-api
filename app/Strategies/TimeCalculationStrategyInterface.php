<?php

namespace Mooncascade\Strategies;

use Mooncascade\Entities\Athlete;


/**
 * Class AbstractTimeCalculationStrategy
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
interface TimeCalculationStrategyInterface
{
    public function calculateTime();

    public function handleSingleEntity(Athlete $entity);

    public function handleMultipleEntities(array $entities);
}