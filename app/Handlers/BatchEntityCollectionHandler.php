<?php

namespace Mooncascade\Handlers;

use Illuminate\Support\Collection;
use Mooncascade\Generators\RandomRaceStrategyEventGenerator;

/**
 * Class BatchEntityCollectionHandler
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
class BatchEntityCollectionHandler implements BatchEntityCollectionHandlerInterface
{
    /**
     * @var string
     */
    protected $property;

    /**
     * @var RandomRaceStrategyEventGenerator
     */
    protected $randomRaceStrategyEventGenerator;

    /**
     * @return string
     */
    public function getProperty(): string
    {
        return $this->property;
    }

    /**
     * @param string $property
     * @return BatchEntityCollectionHandler
     */
    public function setProperty(string $property): BatchEntityCollectionHandler
    {
        $this->property = $property;

        return $this;
    }

    /**
     * @return RandomRaceStrategyEventGenerator
     */
    public function getRandomRaceStrategyEventGenerator(): RandomRaceStrategyEventGenerator
    {
        return $this->randomRaceStrategyEventGenerator;
    }

    /**
     * @param RandomRaceStrategyEventGenerator $randomRaceStrategyEventGenerator
     * @return BatchEntityCollectionHandler
     */
    public function setRandomRaceStrategyEventGenerator(
        RandomRaceStrategyEventGenerator $randomRaceStrategyEventGenerator
    ): BatchEntityCollectionHandler {
        $this->randomRaceStrategyEventGenerator = $randomRaceStrategyEventGenerator;

        return $this;
    }

    /**
     * @param Collection $entites
     */
    public function handle(Collection $entites)
    {
        $strategy = $this->randomRaceStrategyEventGenerator->generate();

        $strategy
            ->setProperty($this->property)
            ->setEntities($entites)
            ->execute();

    }
}
