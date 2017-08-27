<?php

namespace Mooncascade\Generators;

use Faker\Generator;

/**
 * Class AbstractBaseGenerator
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
abstract class AbstractBaseGenerator implements GeneratorInterface
{
    /**
     * @var Generator
     */
    protected $generator;

    /**
     * @return Generator
     */
    public function getGenerator(): Generator
    {
        return $this->generator;
    }

    /**
     * @param Generator $generator
     * @return AbstractBaseGenerator
     */
    public function setGenerator(Generator $generator): AbstractBaseGenerator
    {
        $this->generator = $generator;

        return $this;
    }
}
