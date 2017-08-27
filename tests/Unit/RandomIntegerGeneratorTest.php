<?php

namespace Tests\Unit;

use Faker\Factory;
use Faker\Generator;
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
     * @var Generator
     */
    protected $generator;

    /**
     * @var RandomIntegerGenerator
     */
    protected $integerGenerator;

    /**
     * @inheritDoc
     */
    protected function setUp()
    {
        parent::setUp();

        $this->generator = Factory::create();

        $this->integerGenerator = new RandomIntegerGenerator();

        $this->integerGenerator->setGenerator($this->generator);
    }

    /**
     * A basic test example.
     *
     * @dataProvider randomIntegerGeneratorProvider
     */
    public function testRandomIntegerGeneratorGenerateFunctionReturnsInteger($min, $max)
    {
        $this->integerGenerator
            ->setMin($min)
            ->setMax($max);

        $value = $this->integerGenerator->generate();

        $this->assertInternalType('int', $value);

        $this->assertGreaterThanOrEqual($min, $value);
        $this->assertLessThanOrEqual($max, $value);
    }

    /**
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
