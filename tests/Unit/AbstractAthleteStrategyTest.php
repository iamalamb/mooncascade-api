<?php

namespace Tests\Unit;

use function foo\func;
use Illuminate\Support\Collection;
use Mooncascade\Entities\Athlete;
use Mooncascade\Generators\RandomIntegerGenerator;
use Mooncascade\Strategies\AbstractAthleteRaceStrategy;
use Symfony\Component\PropertyAccess\PropertyAccessor;
use Tests\TestCase;

class AbstractAthleteStrategyTest extends TestCase
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
     * @var AbstractAthleteRaceStrategy
     */
    protected $strategy;

    /**
     * @inheritDoc
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
            ->getMockForAbstractClass(AbstractAthleteRaceStrategy::class);

        $this->strategy
            ->setIntegerGenerator($this->integerGenerator)
            ->setMin(1)
            ->setMax(10)
            ->setProperty('timeAtGate')
            ->setPropertyAccessor($this->propertyAccessor);
    }

    /**
     * Test to ensure that the calculateTime function
     * executes as expected. It should simply return a
     * microtime value as a float.
     *
     * Eg: microtime(true)
     */
    public function testCalculateTimeFunction()
    {
        $time = $this->strategy->calculateTime();

        $this->assertInternalType('float', $time);
    }

    /**
     * Test to ensure that checkIfCalculationNeeded function
     * will return a boolean value which determines if
     * the strategy should continue to calculate the time.
     */
    public function testCheckIfCalculationNeededFunctionReturnsFalseIfEmpty()
    {
        $this->strategy->setEntities(new Collection());

        $result = $this->strategy->checkIfCalculationNeeded();

        $this->assertInternalType('boolean', $result);
        $this->assertEquals(false, $result);
    }

    /**
     * Test to ensure that checkIfCalculationNeeded function
     * will return a boolean value which determines if
     * the strategy should continue to calculate the time.
     */
    public function testCheckIfCalculationNeededFunctionReturnsTrueIfNotEmpty()
    {
        $entity = new Athlete();

        $collection = new Collection();
        $collection->push($entity);

        $this->strategy->setEntities($collection);

        $result = $this->strategy->checkIfCalculationNeeded();

        $this->assertInternalType('boolean', $result);
        $this->assertEquals(true, $result);
    }

    /**
     * Test to ensure that setCalculatedTimeForEntity correctly
     * sets the time on a dynamic property as passed by the params.
     */
    public function testSetCalculatedTimeForEntityExecutesCorrectly()
    {
        $entity = new Athlete();

        $time = $this->strategy->calculateTime();

        $entity = $this->strategy->setCalculatedTimeForEntity($entity, 'timeAtGate', $time);

        $this->assertInstanceOf(Athlete::class, $entity);
        $this->assertInternalType('float', $entity->getTimeAtGate());
    }

    /**
     * Test to ensure that the abstract implementation of
     * execute runs as expected.
     */
    public function testExecuteFunctionExecutesCorrectly()
    {
        $entity = new Athlete();

        $collection = new Collection();
        $collection->push($entity);

        $this->strategy->setEntities($collection);

        $result = $this->strategy->execute();

        $this->assertInstanceOf(Collection::class, $result);

        $this->assertInternalType('float', $this->strategy->getEntities()->shift()->getTimeAtGate());

        $collection = new Collection();

        $entity = new Athlete();
        $collection->push($entity);

        $entity = new Athlete();
        $collection->push($entity);

        $this->strategy->setEntities($collection);

        $result = $this->strategy->execute();

        $this->strategy->getEntities()->each(
            function ($entity) {
                $this->assertNull($entity->getTimeAtGate());
            }
        );

    }
}
