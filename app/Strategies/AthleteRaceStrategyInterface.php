<?php

namespace Mooncascade\Strategies;

use Mooncascade\Entities\Athlete;

interface AthleteRaceStrategyInterface
{
    /**
     * Time calculation method.
     * Will generate a random time in seconds
     * and then put the system to sleep and finally
     * return a micro time
     *
     * @return float
     */
    public function calculateTime(): float;

    /**
     * Used to ensure that we actually HAVE
     * a collection of Entities to work with.
     *
     * @return bool
     */
    public function checkIfCalculationNeeded(): bool;

    /**
     * Used to set the time on an individual
     * Athelete entity.
     *
     * @param Athlete $entity
     * @param $property
     * @param $time
     * @return Athlete
     */
    public function setCalculatedTimeForEntity(Athlete $entity, $property, $time): Athlete;
}
