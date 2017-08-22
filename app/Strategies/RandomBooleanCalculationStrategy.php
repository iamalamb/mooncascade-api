<?php

namespace Mooncascade\Strategies;

use Faker\Generator;

/**
 * Class RandomBooleanCalculationStrategy
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
class RandomBooleanCalculationStrategy implements StrategyInterface
{
    /**
     * @var Generator
     */
    protected $generator;

    /**
     * RandomBooleanCalculationStrategy constructor.
     * @param Generator $generator
     */
    public function __construct(Generator $generator)
    {
        $this->generator = $generator;
    }

    /**
     * @return boolean
     */
    public function execute()
    {
        return $this->generator->boolean;
    }
}
