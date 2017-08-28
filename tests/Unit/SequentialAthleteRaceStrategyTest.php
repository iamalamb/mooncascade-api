<?php

namespace Tests\Unit;

use Illuminate\Support\Collection;
use Mooncascade\Entities\Athlete;
use Mooncascade\Generators\RandomIntegerGenerator;
use Tests\TestCase;
use Mooncascade\Strategies\SequentialAthleteRaceStrategy;
use Symfony\Component\PropertyAccess\PropertyAccessor;

class SequentialAthleteRaceStrategyTest extends TestCase
{
    /**
     * @var RandomIntegerGenerator
     */
    protected $integerGenerator;

    /**
     * @var PropertyAccessor
     */
    protected $propertyAccessor;

    /**
     * @var SequentialAthleteRaceStrategy
     */
    protected $strategy;

    /**
     *
     */
    protected function setUp()
    {
        parent::setUp();

        $this->integerGenerator = $this
            ->getMockBuilder(RandomIntegerGenerator::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->integerGenerator
            ->expects($this->any())
            ->method('generate')
            ->willReturn(1);

        $this->propertyAccessor = new PropertyAccessor();

        $this->strategy = $this
            ->getMockForAbstractClass(SequentialAthleteRaceStrategy::class);

        $this->strategy
            ->setIntegerGenerator($this->integerGenerator)
            ->setMin(1)
            ->setMax(10)
            ->setProperty('timeAtGate')
            ->setPropertyAccessor($this->propertyAccessor);
    }

    /**
     * Test to ensure that execute is overloaded correctly.
     * All entities should have the exact same time
     *
     * @return void
     */
    public function testExecuteFunctionExecutesCorrectly()
    {
        $collection = new Collection();

        $total = 5;

        for ($i = 0; $i < $total; $i++) {

            $athlete = new Athlete();
            $athlete->setStartNumber($i + 1);

            $collection->push($athlete);
        }

        $this->strategy->setEntities($collection);

        $entities = $this->strategy->execute();

        $this->assertInstanceOf(Collection::class, $entities);

        $times = [];
        $entities = $entities->toArray();
        foreach ($entities as $entity) {
            $times[] = $entity->getTimeAtGate();
        }

        $this->assertCount(5, $times);
        $times = array_unique($times);
        $this->assertCount(5, $times);
    }
}
