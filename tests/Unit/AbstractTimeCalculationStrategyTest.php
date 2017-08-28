<?php

namespace Tests\Unit;

use Illuminate\Support\Collection;
use Mooncascade\Entities\Athlete;
use Mooncascade\Strategies\AbstractAthleteRaceStrategy;
use Mooncascade\Strategies\RangeCalculationStrategy;
use Symfony\Component\OptionsResolver\Exception\InvalidOptionsException;
use Symfony\Component\OptionsResolver\Exception\MissingOptionsException;
use Symfony\Component\PropertyAccess\PropertyAccessor;
use Tests\TestCase;
use Mooncascade\Strategies\TieAthleteRaceStrategy;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class AbstractTimeCalculationStrategyTest
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
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
     * @var TieAthleteRaceStrategy
     */
    protected $strategy;

    /**
     * Setup function to be called
     * each time a test is run.
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
            ->getMockBuilder(AbstractAthleteRaceStrategy::class)
            ->setConstructorArgs($args)
            ->getMockForAbstractClass(AbstractAthleteRaceStrategy::class);

        $this->strategy
            ->setMinThreshold(2)
            ->setMaxThreshold(10);
    }

    /**
     * Test to ensure that the calculateTime function
     * executes as expected. It should simply return a
     * microtime value as a float.
     *
     * Eg: microtime(true)
     */
    public function testCalculateTimeExecutesCorrectly()
    {

        $time = $this->strategy->calculateTime();

        $this->assertInternalType('float', $time);
    }

    /**
     * Test to ensure that checkIfCalculationNeeded function
     * will return a boolean value which determines if
     * the strategy should continue to calculate the time.
     */
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
        $params = [
            'entities' => collect([]),
            'property' => 'timeAtGate',
        ];

        $result = $this->strategy->execute($params);

        $this->assertInternalType('bool', $result);
        $this->assertEquals(false, $result);

        $athlete = new Athlete();

        $params['entities'] = collect([$athlete]);

        $result = $this->strategy->execute($params);

        $this->assertInstanceOf(Collection::class, $result);
    }

    /**
     * Ensure that the configureParams function
     * runs correctly and throws the appropriate execeptions
     * if required.
     */
    public function testConfigureParamsExecutesCorrectly()
    {
        $params = [
            'entities' => collect([]),
            'property' => 'timeAtGate',
        ];

        $this->strategy->configureParams($params);
        $this->assertTrue(true);

        $params = [
            'property' => 'timeAtGate',
        ];

        $this->expectException(MissingOptionsException::class);
        $this->strategy->configureParams($params);

        $params = [
            'entities' => collect([]),
        ];

        $this->strategy->configureParams($params);

        $params = [
            'entities' => 1,
            'property' => 1,
        ];

        $this->expectException(InvalidOptionsException::class);

        $this->strategy->configureParams($params);
    }
}
