<?php

namespace Tests\Unit;

use Mooncascade\Factories\FactoryItemInterface;
use Mooncascade\Factories\AthleteRaceStrategyFactory;
use Mooncascade\Strategies\OvertakeAthleteRaceStrategy;
use Mooncascade\Strategies\SequentialAthleteRaceStrategy;
use Mooncascade\Strategies\TieAthleteRaceStrategy;
use Tests\TestCase;

/**
 * Class AthleteRaceStrategyFactoryTest
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
class AthleteRaceStrategyFactoryTest extends TestCase
{
    /**
     * @var array
     */
    protected $strategies;

    /**
     * @var AthleteRaceStrategyFactory
     */
    protected $factory;

    /**
     * @inheritDoc
     */
    protected function setUp()
    {
        parent::setUp();

        $overTakeStrategy = $this->getMockBuilder(OvertakeAthleteRaceStrategy::class)
            ->disableOriginalConstructor()
            ->getMock();

        $sequentialStrategy = $this->getMockBuilder(SequentialAthleteRaceStrategy::class)
            ->disableOriginalConstructor()
            ->getMock();


        $tieStrategy = $this->getMockBuilder(TieAthleteRaceStrategy::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->strategies = [
            'overtake'   => $overTakeStrategy,
            'sequential' => $sequentialStrategy,
            'tie'        => $tieStrategy,
        ];

        $this->factory = new AthleteRaceStrategyFactory($this->strategies);
    }


    /**
     * @param $key
     * @param $instance
     * @dataProvider factoryProvider
     */
    public function testCreateMethodExecutesAndRetreivesTheCorrectStrategy($key, $instance)
    {
        $strategy = $this->factory->create($key);

        $this->assertInstanceOf($instance, $strategy);
        $this->assertInstanceOf(FactoryItemInterface::class, $strategy);
    }

    public function testCreateMethodThowsInvalidArgumentException()
    {
        $this->expectException(\InvalidArgumentException::class);

        $key = 'foo';

        $this->factory->create($key);
    }

    /**
     * @return array
     */
    public function factoryProvider()
    {
        return [
            ['overtake', OvertakeAthleteRaceStrategy::class],
            ['sequential', SequentialAthleteRaceStrategy::class],
            ['tie', TieAthleteRaceStrategy::class],
        ];
    }
}
