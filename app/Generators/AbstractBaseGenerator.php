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
     * AbstractBaseGenerator constructor.
     * @param Generator $generator
     */
    public function __construct(Generator $generator)
    {
        $this->generator = $generator;
    }
}
