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
