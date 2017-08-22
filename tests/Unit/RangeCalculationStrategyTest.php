<?php

namespace Tests\Unit;

use Mooncascade\Strategies\RangeCalculationStrategy;
use Symfony\Component\OptionsResolver\OptionsResolver;
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
        $optionsResolver = new OptionsResolver();
        $this->strategy = new RangeCalculationStrategy($generator, $optionsResolver);
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
        $params = [
            'min' => $min,
            'max' => $max,
        ];

        $value = $this->strategy->execute($params);

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
        $params = [
            'min' => $min,
            'max' => $max,
        ];

        $value = $this->strategy->execute($params);

        $this->assertGreaterThanOrEqual((int) $params['min'], $value);
        $this->assertLessThanOrEqual((int) $params['max'], $value);
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
        ];
    }

}
