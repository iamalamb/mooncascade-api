<?php

namespace Mooncascade\Generators;

/**
 * Class RandomBooleanGenerator
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
class RandomBooleanGenerator extends AbstractBaseGenerator
{
    /**
     * Used to set a threshold on the likelihood
     * that the generator will return true
     *
     * @var integer
     */
    protected $chance;

    /**
     * @return int
     */
    public function getChance(): int
    {
        return $this->chance;
    }

    /**
     * @param int $chance
     * @return GeneratorInterface
     */
    public function setChance(int $chance): GeneratorInterface
    {
        $this->chance = $chance;

        return $this;
    }

    /**
     * Simply returns a boolean value
     */
    public function generate()
    {
        return $this->generator->boolean($this->chance);
    }
}
