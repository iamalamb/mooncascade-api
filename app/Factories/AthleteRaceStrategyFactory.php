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
     * @param array $strategies
     */
    public function __construct(array $strategies)
    {
        $this->strategies = $strategies;
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
