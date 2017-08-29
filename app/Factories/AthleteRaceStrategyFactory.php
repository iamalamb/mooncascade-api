<?php

namespace Mooncascade\Factories;


/**
 * Class AthleteRaceStrategyFactory
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
class AthleteRaceStrategyFactory implements FactoryInterface
{
    protected $strategies = [];

    /**
     * AthleteRaceStrategyFactory constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return array
     */
    public function getStrategies(): array
    {
        return $this->strategies;
    }

    /**
     * @param array $strategies
     * @return AthleteRaceStrategyFactory
     */
    public function setStrategies(array $strategies): AthleteRaceStrategyFactory
    {
        $this->strategies = $strategies;

        return $this;
    }


    /**
     * @inheritDoc
     */
    public function create($key): FactoryItemInterface
    {
        if (array_has($this->strategies, $key)) {
            return $this->strategies[$key];
        } else {
            throw new \InvalidArgumentException();
        }
    }


}
