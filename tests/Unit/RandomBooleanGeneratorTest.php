<?php

namespace Tests\Unit;

use Faker\Factory;
use Faker\Generator;
use Mooncascade\Generators\RandomBooleanGenerator;
use Tests\TestCase;

class RandomBooleanGeneratorTest extends TestCase
{
    /**
     * @var RandomBooleanGenerator
     */
    protected $booleanGenerator;

    /**
     * @var integer
     */
    protected $chance = 50;

    /**
     * @var Generator
     */
    protected $generator;

    /**
     * @inheritDoc
     */
    protected function setUp()
    {
        parent::setUp();

        $this->generator = Factory::create();
        $this->booleanGenerator = new RandomBooleanGenerator();

        $this->booleanGenerator
            ->setChance($this->chance)
            ->setGenerator($this->generator);
    }

    /**
     * A basic test example.
     *
     * @dataProvider booleanGeneratorProvider
     * @return bool
     */
    public function testRandomBooleanGeneratorGenerateFunction($chance)
    {
        $this->booleanGenerator->setChance($chance);

        $result = $this->booleanGenerator->generate();
        $this->assertInternalType('bool', $result);

        return $result;
    }

    /**
     * Data provider for tests to ensure
     * that the generator returns false
     *
     * @return array
     */
    public function booleanGeneratorProvider()
    {
        $range = range(0, 49);
        $data = [];

        $total = count($range);
        for ($i = 0; $i < $total; $i++) {
            $data[] = [$range[$i]];
        }

        return $data;
    }

}
