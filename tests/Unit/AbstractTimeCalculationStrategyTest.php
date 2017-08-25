<?php

namespace Tests\Unit;

use Mooncascade\Entities\Athlete;
use Mooncascade\Strategies\AbstractTimeCalculationStrategy;
use Mooncascade\Strategies\RangeCalculationStrategy;
use Symfony\Component\PropertyAccess\PropertyAccessor;
use Tests\TestCase;
use Mooncascade\Strategies\TieAthleteStrategy;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AbstractTimeCalculationStrategyTest extends TestCase
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
     * @var PropertyAccessor
     */
    protected $propertyAccessor;

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


        $this->optionsResolver = $this
            ->getMockBuilder(OptionsResolver::class)
            ->getMock();

        $this->propertyAccessor = new PropertyAccessor();

        $args = [
            $this->optionsResolver,
            $this->propertyAccessor,
            $this->rangeCalculationStrategy,
        ];

        $this->strategy = $this
            ->getMockBuilder(AbstractTimeCalculationStrategy::class)
            ->setConstructorArgs($args)
            ->getMockForAbstractClass(AbstractTimeCalculationStrategy::class);

        $this->strategy
            ->setMinThreshold(2)
            ->setMaxThreshold(10);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCalculateTimeExecutesCorrectly()
    {

        $time = $this->strategy->calculateTime();

        $this->assertInternalType('float', $time);
    }

    public function testCheckIfCalculationNeededExecutesCorrectly()
    {
        $result = $this->strategy->checkIfCalculationNeeded(collect([]));

        $this->assertInternalType('boolean', $result);
        $this->assertEquals(false, $result);

        $entity = new Athlete();
        $result = $this->strategy->checkIfCalculationNeeded(collect([$entity]));

        $this->assertInternalType('boolean', $result);
        $this->assertEquals(true, $result);
    }

    public function testSetCalculatedTimeForEntityExecutesCorrectly()
    {
        $entity = new Athlete();

        $time = $this->strategy->calculateTime();

        $entity = $this->strategy->setCalculatedTimeForEntity($entity, 'timeAtGate', $time);

        $this->assertInstanceOf(Athlete::class, $entity);
        $this->assertInternalType('float', $entity->getTimeAtGate());
    }
}
