<?php

namespace Tests\Unit;

use Faker\Factory;
use Mooncascade\Generators\RandomIntegerGenerator;
use Tests\TestCase;

/**
 * Class RandomIntegerGeneratorTest
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
class RandomIntegerGeneratorTest extends TestCase
{

    /**
     * Test to ensure that generator
     * always returns an integer value.
     *
     * @param $min
     * @param $max
     * @dataProvider randomIntegerGeneratorProvider
     * @return int
     */
    public function testGeneratorReturnsInteger($min, $max): int
    {
        $generator = new RandomIntegerGenerator(Factory::create(), $min, $max);

        $value = $generator->generate();

        $this->assertInternalType('int', $value);

        return $value;
    }

    /**
     * Test to ensure that the generated value is within $min and $max.
     *
     * @param $min
     * @param $max
     * @dataProvider randomIntegerGeneratorProvider
     */
    public function testGeneratorReturnsIntegerInRange($min, $max)
    {
        $generator = new RandomIntegerGenerator(Factory::create(), $min, $max);

        $value = $generator->generate();

        $this->assertGreaterThanOrEqual($min, $value);
        $this->assertLessThanOrEqual($max, $value);
    }

    /**
     * General data provider
     *
     * @return array
     */
    public function randomIntegerGeneratorProvider(): array
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
