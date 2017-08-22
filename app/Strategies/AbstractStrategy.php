<?php

namespace Mooncascade\Strategies;

use Faker\Generator;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class AbstractStrategy
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
abstract class AbstractStrategy implements StrategyInterface
{
    /**
     * @var Generator
     */
    protected $generator;

    /**
     * @var OptionsResolver
     */
    protected $optionsResolver;

    /**
     * AbstractStrategy constructor.
     * @param Generator $generator
     * @param OptionsResolver $optionsResolver
     */
    public function __construct(Generator $generator, OptionsResolver $optionsResolver)
    {
        $this->generator = $generator;
        $this->optionsResolver = $optionsResolver;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function execute(array $params)
    {
        $this->configureParams($params);
    }
}
