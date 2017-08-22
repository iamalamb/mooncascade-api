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
     * @return mixed
     */
    public function configureParams()
    {
        // TODO: Implement configureParams() method.
    }


    /**
     * @param array $params
     * @return boolean
     */
    public function execute(array $params)
    {
        return $this->generator->boolean;
    }
}
