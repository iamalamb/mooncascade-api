<?php

namespace Tests\Unit;

use Mooncascade\Strategies\RangeCalculationStrategy;
use Tests\TestCase;
use Faker\Factory;

class RangeCalculationStrategyTest extends TestCase
{
    /**
     * @var RangeCalculationStrategy
     */
    protected $strategy;

    /**
     *
     */
    protected function setUp()
    {
        parent::setUp();

        $generator = Factory::create();
        $this->strategy = new RangeCalculationStrategy($generator);
    }

    /**
     * Test to ensure that the strategy can correctly sort
     * the min/max values to enforce that $min < $max
     *
     * @dataProvider rangeCalculationStrategyProvider
     * @return void
     */
    public function testThatRangeCalculationStrategyCorrectlySortsValues($min, $max)
    {
        $this->strategy->setMin($min)->setMax($max);

        $this->strategy->sort();

        $this->assertGreaterThanOrEqual($this->strategy->getMin(), (int) $min);
        $this->assertLessThanOrEqual($this->strategy->getMax(), (int) $max);
    }

    /**
     * Test to ensure that strategy ALWAYS returns a
     * valid integer value
     *
     * @dataProvider rangeCalculationStrategyProvider
     * @return void
     */
    public function testThatRangeCalculationStrategyReturnsInteger($min, $max)
    {
        $this
            ->strategy
            ->setMin($min)
            ->setMax($max);

        $value = $this->strategy->execute();

        $this->assertInternalType('integer', $value);
    }

    /**
     * Test to ensure that strategy ALWAYS returns a
     * an integer within the predefined range
     *
     * @dataProvider rangeCalculationStrategyProvider
     * @return void
     */
    public function testThatRangeCalculationStrategyReturnsIntegerWithinRange($min, $max)
    {
        $this
            ->strategy
            ->setMin($min)
            ->setMax($max);

        $value = $this->strategy->execute();

        $this->assertGreaterThanOrEqual($this->strategy->getMin(), $value);
        $this->assertLessThanOrEqual($this->strategy->getMax(), $value);
    }

    /**
     * @return array
     */
    public function rangeCalculationStrategyProvider()
    {
        return [
            [1, 20],
            [2, 10],
            [4, 15],
            [4.5, 15.4],
            [-4.5, 15.4],
            [5, 2],
        ];
    }

}
