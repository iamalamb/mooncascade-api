<?php

namespace Mooncascade\Handlers;

use Illuminate\Support\Collection;
use Mooncascade\Factories\AthleteRaceStrategyFactory;
use Mooncascade\Generators\RandomRaceStrategyEventGenerator;

/**
 * Class BatchEntityCollectionHandler
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
class BatchEntityCollectionHandler implements BatchEntityCollectionHandlerInterface
{
    /**
     * @var array
     */
    protected $allowedStrategies;

    /**
     * @var AthleteRaceStrategyFactory
     */
    protected $athleteRaceStrategyFactory;

    /**
     * @var RandomRaceStrategyEventGenerator
     */
    protected $randomRaceStrategyEventGenerator;

    /**
     * @return array
     */
    public function getAllowedStrategies(): array
    {
        return $this->allowedStrategies;
    }

    /**
     * @param array $allowedStrategies
     * @return BatchEntityCollectionHandler
     */
    public function setAllowedStrategies(array $allowedStrategies): BatchEntityCollectionHandler
    {
        $this->allowedStrategies = $allowedStrategies;

        return $this;
    }

    /**
     * @return AthleteRaceStrategyFactory
     */
    public function getAthleteRaceStrategyFactory(): AthleteRaceStrategyFactory
    {
        return $this->athleteRaceStrategyFactory;
    }

    /**
     * @param AthleteRaceStrategyFactory $athleteRaceStrategyFactory
     * @return BatchEntityCollectionHandler
     */
    public function setAthleteRaceStrategyFactory(AthleteRaceStrategyFactory $athleteRaceStrategyFactory
    ): BatchEntityCollectionHandler {
        $this->athleteRaceStrategyFactory = $athleteRaceStrategyFactory;

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
    }
}
