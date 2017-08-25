<?php

namespace Mooncascade\Strategies;

use Illuminate\Support\Collection;
use Mooncascade\Entities\Athlete;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\PropertyAccess\PropertyAccessor;

abstract class AbstractTimeCalculationStrategy implements TimeCalculationStrategyInterface
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
     * @return int
     */
    public function getMinThreshold(): int
    {
        return $this->minThreshold;
    }

    /**
     * @param int $minThreshold
     * @return AbstractTimeCalculationStrategy
     */
    public function setMinThreshold(int $minThreshold): AbstractTimeCalculationStrategy
    {
        $this->minThreshold = $minThreshold;

        return $this;
    }

    /**
     * @return int
     */
    public function getMaxThreshold(): int
    {
        return $this->maxThreshold;
    }

    /**
     * @param int $maxThreshold
     * @return AbstractTimeCalculationStrategy
     */
    public function setMaxThreshold(int $maxThreshold): AbstractTimeCalculationStrategy
    {
        $this->maxThreshold = $maxThreshold;

        return $this;
    }

    /**
     * @return mixed
     */
    public function calculateTime()
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
    }

    /**
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
