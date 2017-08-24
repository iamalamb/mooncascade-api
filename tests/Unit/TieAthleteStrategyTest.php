<?php

namespace Tests\Unit;

use Mooncascade\Strategies\RandomBooleanCalculationStrategy;
use Mooncascade\Strategies\TieAthleteStrategy;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Tests\TestCase;

class TieAthleteStrategyTest extends TestCase
{
    /**
     * @var RandomBooleanCalculationStrategy
     */
    protected $booleanCalculationStrategy;

    /**
     * @var OptionsResolver
     */
    protected $optionsResolver;

    /**
     * @var TieAthleteStrategy
     */
    protected $strategy;

    /**
     *
     */
    protected function setUp()
    {
        parent::setUp();

        $this->booleanCalculationStrategy = $this
            ->getMockBuilder(RandomBooleanCalculationStrategy::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->optionsResolver = $this->getMockBuilder(OptionsResolver::class);

        $this->strategy = new TieAthleteStrategy($this->booleanCalculationStrategy, $this->optionsResolver);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testThatTieAthleteStrategySetsSameValueWhenRequired()
    {
        $this->booleanCalculationStrategy
            ->expects($this->once())
            ->method('execute')
            ->willReturn(true);

        $this->assertTrue(true);
    }
}
