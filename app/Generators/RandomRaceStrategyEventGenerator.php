<?php

namespace Mooncascade\Generators;

use Illuminate\Support\Collection;
use Mooncascade\Factories\FactoryInterface;

/**
 * Class RandomRaceStrategyEventGenerator
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
class RandomRaceStrategyEventGenerator implements GeneratorInterface
{
    /**
     * @var Collection
     */
    protected $allowedStrategies;

    /**
     * @var FactoryInterface
     */
    protected $strategyFactory;

    /**
     * @return Collection
     */
    public function getAllowedStrategies(): Collection
    {
        return $this->allowedStrategies;
    }

    /**
     * @param Collection $allowedStrategies
     * @return RandomRaceStrategyEventGenerator
     */
    public function setAllowedStrategies(Collection $allowedStrategies): RandomRaceStrategyEventGenerator
    {
        $this->allowedStrategies = $allowedStrategies;

        return $this;
    }

    /**
     * @return FactoryInterface
     */
    public function getStrategyFactory(): FactoryInterface
    {
        return $this->strategyFactory;
    }

    /**
     * @param FactoryInterface $strategyFactory
     * @return RandomRaceStrategyEventGenerator
     */
    public function setStrategyFactory(FactoryInterface $strategyFactory): RandomRaceStrategyEventGenerator
    {
        $this->strategyFactory = $strategyFactory;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function generate()
    {
        $key = $this->allowedStrategies->random(1);

        $strategy = $this->strategyFactory->create($key);

        return $strategy;
    }
}
