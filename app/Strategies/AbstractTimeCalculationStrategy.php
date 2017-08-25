<?php

namespace Mooncascade\Strategies;

use Illuminate\Support\Collection;
use Mooncascade\Entities\Athlete;
use Mooncascade\Factories\FactoryItemInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\PropertyAccess\PropertyAccessor;

abstract class AbstractTimeCalculationStrategy implements TimeCalculationStrategyInterface, FactoryItemInterface
{
    /**
     * @var integer
     */
    protected $minThreshold;

    /**
     * @var integer
     */
    protected $maxThreshold;

    /**
     * @var OptionsResolver
     */
    protected $optionsResolver;

    /**
     * @var PropertyAccessor
     */
    protected $propertyAccessor;

    /**
     * @var RangeCalculationStrategy
     */
    protected $rangeCalculationStrategy;

    /**
     * AbstractTimeCalculationStrategy constructor.
     * @param OptionsResolver $optionsResolver
     * @param PropertyAccessor $propertyAccessor
     * @param RangeCalculationStrategy $rangeCalculationStrategy
     */
    public function __construct(
        OptionsResolver $optionsResolver,
        PropertyAccessor $propertyAccessor,
        RangeCalculationStrategy $rangeCalculationStrategy
    ) {
        $this->optionsResolver = $optionsResolver;
        $this->propertyAccessor = $propertyAccessor;
        $this->rangeCalculationStrategy = $rangeCalculationStrategy;
    }

    /**
     * Get the minimum time threshold when calculating a
     * dynamic time
     *
     * @return int
     */
    public function getMinThreshold(): int
    {
        return $this->minThreshold;
    }

    /**
     * Set the minimum threshold when
     * calculating a dynamic time.
     *
     * @param int $minThreshold
     * @return TimeCalculationStrategyInterface
     */
    public function setMinThreshold(int $minThreshold): TimeCalculationStrategyInterface
    {
        $this->minThreshold = $minThreshold;

        return $this;
    }

    /**
     * Get the maximum time threshold when calculating a
     * dynamic time
     *
     * @return int
     */
    public function getMaxThreshold(): int
    {
        return $this->maxThreshold;
    }

    /**
     * Set the maximum threshold when
     * calculating a dynamic time.
     *
     * @param int $maxThreshold
     * @return TimeCalculationStrategyInterface
     */
    public function setMaxThreshold(int $maxThreshold): TimeCalculationStrategyInterface
    {
        $this->maxThreshold = $maxThreshold;

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
        $params = [
            'min' => $this->minThreshold,
            'max' => $this->maxThreshold,
        ];


        $time = $this->rangeCalculationStrategy->execute($params);
        sleep($time);

        return microtime(true);
    }

    /**
     * Configure params function used to ensure
     * that the correct parameters are available.
     *
     * @param array $params
     */
    public function configureParams(array $params)
    {
        $required = [
            'entities',
            'property',
        ];

        $this->optionsResolver->setRequired($required);

        $this->optionsResolver->setAllowedTypes('entities', [Collection::class]);
        $this->optionsResolver->setAllowedTypes('property', ['string']);

        $this->optionsResolver->resolve($params);
    }

    /**
     * Simply checks that we have entities to work on.
     *
     * @param Collection $entities
     * @return bool
     */
    public function checkIfCalculationNeeded(Collection $entities): bool
    {
        if (!$entities->count()) {
            return false;
        }

        return true;
    }

    /**
     * Initial execute function intended for
     * overloading by concrete implementations.
     *
     * @param array $params
     * @return mixed
     */
    public function execute(array $params)
    {
        $this->configureParams($params);

        if (!$this->checkIfCalculationNeeded($params['entities'])) {
            return false;
        }

        return $params['entities'];
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
