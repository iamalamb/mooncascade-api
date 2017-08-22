<?php

namespace Tests\Unit;

use Mooncascade\Strategies\RandomBooleanCalculationStrategy;
use Tests\TestCase;
use Faker\Factory;

class RandomBooleanCalculationStrategyTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRandomBooleanCalculationStrategyReturnsBoolean()
    {
        $total = 20;

        $generator = Factory::create();
        $strategy = new RandomBooleanCalculationStrategy($generator);

        for($i = 0; $i < $total; $i++) {
            $this->assertInternalType('boolean', $strategy->execute());
        }
    }
}
