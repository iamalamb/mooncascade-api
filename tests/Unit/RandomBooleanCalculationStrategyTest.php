<?php

namespace Tests\Unit;

use Mooncascade\Strategies\RandomBooleanCalculationStrategy;
use Symfony\Component\OptionsResolver\OptionsResolver;
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
        $optionsResolver = new OptionsResolver();

        $strategy = new RandomBooleanCalculationStrategy($generator, $optionsResolver);

        for($i = 0; $i < $total; $i++) {

            $params = [
                'chance' => $generator->numberBetween(5, 100)
            ];

            $this->assertInternalType('boolean', $strategy->execute($params));
        }
    }
}
