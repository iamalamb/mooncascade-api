<?php

namespace Mooncascade\Generators;

/**
 * Class RandomIntegerGenerator
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
class RandomIntegerGenerator extends AbstractBaseGenerator
{
    /**
     * @var integer
     */
    protected $min;

    /**
     * @var integer
     */
    protected $max;

    /**
     * @return int
     */
    public function getMin(): int
    {
        return $this->min;
    }

    /**
     * @param int $min
     * @return GeneratorInterface
     */
    public function setMin(int $min): GeneratorInterface
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
     * @return GeneratorInterface
     */
    public function setMax(int $max): GeneratorInterface
    {
        $this->max = $max;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function generate()
    {
        return $this->generator->numberBetween($this->min, $this->max);
    }
}
