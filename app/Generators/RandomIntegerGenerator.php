<?php

namespace Mooncascade\Generators;

use Faker\Generator;
use Mooncascade\Contracts\Generators\Generator as Contract;

/**
 * Class RandomIntegerGenerator
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
class RandomIntegerGenerator implements Contract
{
    /**
     * Faker Generator used to help
     * return the random number
     *
     * @var Generator
     */
    protected $generator;

    /**
     * Reference to the minimum
     * number to return
     *
     * @var integer
     */
    protected $min;

    /**
     * Reference to the maximum
     * number to return
     *
     * @var integer
     */
    protected $max;

    /**
     * RandomIntegerGenerator constructor.
     * @param Generator $generator
     */
    public function __construct(Generator $generator)
    {
        $this->generator = $generator;
    }

    /**
     * @return int
     */
    public function getMin(): int
    {
        return $this->min;
    }

    /**
     * @param int $min
     * @return RandomIntegerGenerator
     */
    public function setMin(int $min): RandomIntegerGenerator
    {
        $this->min = $min;

        return $this;
    }

    /**
     * @return int
     */
    public function getMax(): int
    {
        return $this->max;
    }

    /**
     * @param int $max
     * @return RandomIntegerGenerator
     */
    public function setMax(int $max): RandomIntegerGenerator
    {
        $this->max = $max;

        return $this;
    }

    /**
     * Generates a random integer between
     * $min and $max
     */
    public function generate()
    {
        return $this->generator->numberBetween($this->min, $this->max);
    }
}
