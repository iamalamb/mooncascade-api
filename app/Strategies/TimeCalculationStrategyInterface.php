<?php

namespace Mooncascade\Strategies;

use Illuminate\Support\Collection;
use Mooncascade\Entities\Athlete;


/**
 * Class AbstractTimeCalculationStrategy
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
interface TimeCalculationStrategyInterface extends StrategyInterface
{
    /**
     * Time calculation method.
     * Will generate a random time in seconds
     * and then put the system to sleep and finally
     * return a micro time
     *
     * @return float
     */
    public function calculateTime();

    /**
     * Used to ensure that we actually HAVE
     * a collection of Entities to work with.
     *
     * @param Collection $entities
     * @return bool
     */
    public function checkIfCalculationNeeded(Collection $entities);

    /**
     * Used to set the time on an individual
     * Athelete entity.
     *
     * @param Athlete $entity
     * @param $property
     * @param $time
     * @return Athlete
     */
    public function setCalculatedTimeForEntity(Athlete $entity, $property, $time);
}