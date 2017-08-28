<?php

namespace Tests\Unit;

use Mooncascade\Factories\AthleteRaceStrategyFactory;
use Mooncascade\Factories\FactoryInterface;
use Mooncascade\Generators\RandomRaceStrategyEventGenerator;
use Mooncascade\Strategies\AthleteRaceStrategyInterface;
use Mooncascade\Strategies\OvertakeAthleteRaceStrategy;
use Mooncascade\Strategies\SequentialAthleteRaceStrategy;
use Mooncascade\Strategies\StrategyInterface;
use Mooncascade\Strategies\TieAthleteRaceStrategy;
use Tests\TestCase;

class RandomRaceStrategyEventGeneratorTest extends TestCase
{
    /**
     * @var AthleteRaceStrategyFactory
     */
    protected $factory;

    /**
     * @var RandomRaceStrategyEventGenerator
     */
    protected $generator;

    /**
     * @inheritDoc
     */
    protected function setUp()
    {
        parent::setUp();

        $overTakeStrategy = new OvertakeAthleteRaceStrategy;

        $sequentialStrategy = new SequentialAthleteRaceStrategy;

        $tieStrategy = new TieAthleteRaceStrategy;

        $this->strategies = [
            'overtake'   => $overTakeStrategy,
            'sequential' => $sequentialStrategy,
            'tie'        => $tieStrategy,
        ];

        $this->factory = new AthleteRaceStrategyFactory($this->strategies);

        $this->generator = new RandomRaceStrategyEventGenerator();

        $allowedEvents = [
            'sequential',
            'tie',
        ];

        $allowedEvents = collect($allowedEvents);

        $this->generator
            ->setAllowedStrategies($allowedEvents)
            ->setStrategyFactory($this->factory);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGenerateFunction()
    {
        $result = $this->generator->generate();

        $this->assertInstanceOf(AthleteRaceStrategyInterface::class, $result);
        $this->assertInstanceOf(StrategyInterface::class, $result);
        $this->assertNotInstanceOf(OvertakeAthleteRaceStrategy::class, $result);
    }
}
