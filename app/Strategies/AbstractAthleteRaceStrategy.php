<?php

namespace Mooncascade\Strategies;

use Illuminate\Support\Collection;
use Mooncascade\Entities\Athlete;
use Mooncascade\Events\MooncascadePersistEntityEvent;
use Mooncascade\Factories\FactoryItemInterface;
use Mooncascade\Generators\RandomIntegerGenerator;
use Symfony\Component\PropertyAccess\PropertyAccessor;

/**
 * Class AbstractAthleteRaceStrategy
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
abstract class AbstractAthleteRaceStrategy implements
    AthleteRaceStrategyInterface,
    FactoryItemInterface,
    StrategyInterface
{
    /**
     * Reference to the
     * collection of Athlete entities
     *
     * @var Collection
     */
    protected $entities;

    /**
     * Generator used to
     * calculate the random sleep
     * time
     *
     * @var RandomIntegerGenerator
     */
    protected $integerGenerator;

    /**
     * The minimum threshold
     * for sleeping an individual
     * Athlete entity
     *
     * @var integer
     */
    protected $min;

    /**
     * The maximum threshold
     * for sleeping an individual
     * Athlete entity
     *
     * @var integer
     */
    protected $max;

    /**
     * The Athlete property
     * that we will save to
     *
     * @var string
     */
    protected $property;

    /**
     * Symfony ProperyAccessor
     * used to dynamically write
     * to the designated property
     *
     * @var PropertyAccessor
     */
    protected $propertyAccessor;

    /**
     * AbstractAthleteRaceStrategy constructor.
     * @param RandomIntegerGenerator $integerGenerator
     * @param int $min
     * @param int $max
     * @param PropertyAccessor $propertyAccessor
     */
    public function __construct(
        RandomIntegerGenerator $integerGenerator,
        $min,
        $max,
        PropertyAccessor $propertyAccessor
    ) {
        $this->integerGenerator = $integerGenerator;
        $this->min = $min;
        $this->max = $max;
        $this->propertyAccessor = $propertyAccessor;
    }

    /**
     * @return Collection
     */
    public function getEntities(): Collection
    {
        return $this->entities;
    }

    /**
     * @param Collection $entities
     * @return AbstractAthleteRaceStrategy
     */
    public function setEntities(Collection $entities): AbstractAthleteRaceStrategy
    {
        $this->entities = $entities;

        return $this;
    }

    /**
     * @return string
     */
    public function getProperty(): string
    {
        return $this->property;
    }

    /**
     * @param string $property
     * @return AbstractAthleteRaceStrategy
     */
    public function setProperty(string $property): AbstractAthleteRaceStrategy
    {
        $this->property = $property;

        return $this;
    }

    /**
     * Calculates a random time in seconds
     * using the RangeCalculationStrategy
     * between min and max thresholds.
     *
     * @return float
     */
    public function calculateTime(): float
    {
        /*
         * Set the minimum and maximum thresholds
         * for calculating sleep time
         *
         * TODO: Could this be moved into the service provider?
         */

        $this->integerGenerator
            ->setMin($this->min)
            ->setMax($this->max);

        // Calculate a dynamic time and sleep
        $time = $this->integerGenerator->generate();
        sleep($time);

        // Return the current microtime for storage
        return microtime(true);
    }

    /**
     * Simply checks that we have entities to work on.
     *
     * @return bool
     */
    public function checkIfCalculationNeeded(): bool
    {
        if (!$this->entities->count()) {
            return false;
        }

        return true;
    }

    /**
     * @param Athlete $entity
     */
    public function dispatchEvent(Athlete $entity)
    {
        $event = new MooncascadePersistEntityEvent();

        $event->setEntity($entity);

        event($event);
    }

    /**
     * Initial execute function intended for
     * overloading by concrete implementations.
     *
     * @return Collection
     */
    public function execute(): Collection
    {
        /*
         * If there are no entities to work
         * with, there's no point in proceeding further
         */
        if ($this->checkIfCalculationNeeded()) {

            // If there is only one entity process it
            if ($this->entities->count() === 1) {
                // Retrieve the entity
                $entity = $this->entities->shift();

                // Calculate the time
                $time = $this->calculateTime();

                // Set and return the entity back
                $this->setCalculatedTimeForEntity($entity, $this->getProperty(), $time);

                $this->entities->push($entity);
            }
        }

        return $this->entities;
    }

    /**
     * Sets the calculated time on an Entity.
     *
     * @param Athlete $entity
     * @param $property
     * @param $time
     * @return Athlete
     */
    public function setCalculatedTimeForEntity(Athlete $entity, $property, $time): Athlete
    {
        $this->propertyAccessor->setValue($entity, $property, $time);

        return $entity;
    }
}
