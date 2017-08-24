<?php

namespace Mooncascade\Strategies;

use Mooncascade\Entities\Athlete;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\PropertyAccess\PropertyAccessor;

/**
 * Class AbstractTimeCalculationStrategy
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
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
    public function getMinThreshold()
    {
        return $this->minThreshold;
    }

    /**
     * @param $minThreshold
     * @return $this
     */
    public function setMinThreshold($minThreshold)
    {
        $this->minThreshold = $minThreshold;

        return $this;
    }

    /**
     * @return int
     */
    public function getMaxThreshold()
    {
        return $this->maxThreshold;
    }

    /**
     * @param $maxThreshold
     * @return $this
     */
    public function setMaxThreshold($maxThreshold)
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

    public function checkIfCalculationNeeded($entities)
    {
        if (!$entities->count()) {
            return false;
        }

        return true;
    }

    public function setCalculatedTimeForEntity(Athlete $entity, $property, $time)
    {
        if($this->propertyAccessor->isWritable($entity, $property)) {

            $this->propertyAccessor->setValue($entity, $property, $time);
        }

        return $entity;
    }
}
