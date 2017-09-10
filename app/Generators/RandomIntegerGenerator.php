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
     * @param int $min
     * @param int $max
     */
    public function __construct(Generator $generator, $min, $max)
    {
        $this->generator = $generator;
        $this->min = $min;
        $this->max = $max;
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
