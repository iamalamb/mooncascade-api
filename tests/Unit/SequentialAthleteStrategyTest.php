<?php

namespace Tests\Unit;

use Illuminate\Support\Collection;
use Mooncascade\Entities\Athlete;
use Mooncascade\Strategies\RangeCalculationStrategy;
use Tests\TestCase;
use Mooncascade\Strategies\SequentialAthleteRaceStrategy;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\PropertyAccess\PropertyAccessor;

class SequentialAthleteStrategyTest extends TestCase
{


    /**
     * @var RangeCalculationStrategy
     */
    protected $rangeCalculationStrategy;

    /**
     * @var OptionsResolver
     */
    protected $optionsResolver;

    /**
     * @var TieAthleteStrategy
     */
    protected $strategy;

    /**
     *
     */
    protected function setUp()
    {
        parent::setUp();

        $this->rangeCalculationStrategy = $this
            ->getMockBuilder(RangeCalculationStrategy::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->rangeCalculationStrategy
            ->expects($this->any())
            ->method('execute')
            ->willReturn(1);


        $this->optionsResolver = new OptionsResolver();

        $this->propertyAccessor = new PropertyAccessor();

        $args = [
            $this->optionsResolver,
            $this->propertyAccessor,
            $this->rangeCalculationStrategy,
        ];

        $this->strategy = $this
            ->getMockBuilder(SequentialAthleteRaceStrategy::class)
            ->setConstructorArgs($args)
            ->getMockForAbstractClass(SequentialAthleteRaceStrategy::class);

        $this->strategy
            ->setMinThreshold(2)
            ->setMaxThreshold(10);
    }

    /**
     * Test to ensure that execute is overloaded correctly.
     * All entities should have the exact same time
     *
     * @return void
     */
    public function testExecuteFunctionExecutesCorrectly()
    {
        $params = [
            'property' => 'timeAtGate',
            'entities' => collect([]),
        ];

        $total = 5;

        for ($i = 0; $i < $total; $i++) {

            $params['entities']->push(new Athlete);
        }

        $entities = $this->strategy->execute($params);

        $this->assertInstanceOf(Collection::class, $entities);

        $times = [];
        $entities = $entities->toArray();
        foreach ($entities as $entity) {
            $times[] = $entity->getTimeAtGate();
        }

        $this->assertCount(5, $times);
        $times = array_unique($times);
        $this->assertCount(5, $times);

        $params['entities'] = collect([]);

        $entities = $this->strategy->execute($params);

        $this->assertInternalType('bool', $entities);
    }
}
