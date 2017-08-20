<?php

namespace Mooncascade\Strategies;

use Faker\Generator;

/**
 * Class RangeCalculationStrategy
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
class RangeCalculationStrategy implements StrategyInterface
{
    /**
     * @var Generator
     */
    protected $generator;

    /**
     * @var integer
     */
    protected $min;

    /**
     * @var integer
     */
    protected $max;

    /**
     * SimpleTimeCalculationStrategy constructor.
     * @param Generator $generator
     */
    public function __construct(Generator $generator)
    {
        $this->generator = $generator;
    }

    /**
     * @return Generator
     */
    public function getGenerator(): Generator
    {
        return $this->generator;
    }

    /**
     * @param Generator $generator
     * @return RangeCalculationStrategy
     */
    public function setGenerator(Generator $generator): RangeCalculationStrategy
    {
        $this->generator = $generator;

        return $this;
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
     * @return RangeCalculationStrategy
     */
    public function setMin(int $min): RangeCalculationStrategy
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
     * @return RangeCalculationStrategy
     */
    public function setMax(int $max): RangeCalculationStrategy
    {
        $this->max = $max;

        return $this;
    }

    /**
     * Used to provide a VERY basic range calculation
     * using Faker.
     *
     * @return mixed
     */
    public function execute(): int
    {
        $this->sort();

        return $this
            ->generator
            ->numberBetween($this->min, $this->max);
    }

    /**
     * Ensures that the min/max values are not
     * switched. IE: $min > $max.
     */
    public function sort()
    {
        $values = [
            $this->getMin(),
            $this->getMax(),
        ];

        sort($values, SORT_NUMERIC);

        $this->setMin($values[0]);
        $this->setMax($values[1]);
    }
}
