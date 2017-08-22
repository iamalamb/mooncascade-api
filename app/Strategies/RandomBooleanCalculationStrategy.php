<?php

namespace Mooncascade\Strategies;

use Faker\Generator;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
     * @var OptionsResolver
     */
    protected $optionsResolver;

    /**
     * RandomBooleanCalculationStrategy constructor.
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
     */
    public function configureParams(array $params)
    {
        $required = [
            'chance'
        ];

        // Set the required values
        $this->optionsResolver->setRequired($required);

        // Set the allowed type
        $this->optionsResolver->setAllowedTypes('chance', ['integer', 'double']);
    }


    /**
     * @param array $params
     * @return boolean
     */
    public function execute(array $params)
    {
        // First configure/check our options
        $this->configureParams($params);

        return $this->generator->boolean;
    }
}
