<?php

namespace Tests\Unit;

use Mooncascade\Factories\FactoryItemInterface;
use Mooncascade\Factories\TimeRetrievalStrategyFactory;
use Mooncascade\Strategies\OvertakeAthleteStrategy;
use Mooncascade\Strategies\SequentialAthleteStrategy;
use Mooncascade\Strategies\TieAthleteStrategy;
use Tests\TestCase;

/**
 * Class TimeRetrievalStrategyFactoryTest
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
class TimeRetrievalStrategyFactoryTest extends TestCase
{
    /**
     * @var array
     */
    protected $strategies;

    /**
     * @var TimeRetrievalStrategyFactory
     */
    protected $factory;

    /**
     * @inheritDoc
     */
    protected function setUp()
    {
        parent::setUp();

        $overTakeStrategy = $this->getMockBuilder(OvertakeAthleteStrategy::class)
            ->disableOriginalConstructor()
            ->getMock();

        $sequentialStrategy = $this->getMockBuilder(SequentialAthleteStrategy::class)
            ->disableOriginalConstructor()
            ->getMock();


        $tieStrategy = $this->getMockBuilder(TieAthleteStrategy::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->strategies = [
            'overtake'   => $overTakeStrategy,
            'sequential' => $sequentialStrategy,
            'tie'        => $tieStrategy,
        ];

        $this->factory = new TimeRetrievalStrategyFactory($this->strategies);
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
            ['overtake', OvertakeAthleteStrategy::class],
            ['sequential', SequentialAthleteStrategy::class],
            ['tie', TieAthleteStrategy::class],
        ];
    }
}
