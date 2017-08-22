<?php

namespace Mooncascade\Strategies;

use Faker\Generator;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
     * @var OptionsResolver
     */
    protected $optionsResolver;

    /**
     * RangeCalculationStrategy constructor.
     * @param Generator $generator
     * @param OptionsResolver $optionsResolver
     */
    public function __construct(Generator $generator, OptionsResolver $optionsResolver)
    {
        $this->generator = $generator;
        $this->optionsResolver = $optionsResolver;
    }

    /**
     * Use an OptionsResolver in order to ensure the correct params
     * are passed.
     */
    public function configureParams()
    {
        $required = [
            'min',
            'max',
        ];

        // Set the required values
        $this->optionsResolver->setRequired($required);

        // Set the allowed types
        $this->optionsResolver->setAllowedTypes('min', 'integer');
        $this->optionsResolver->setAllowedTypes('max', 'integer');
    }

    /**
     * Used to provide a VERY basic range calculation
     * using Faker.
     *
     * @param array
     * @return mixed
     */
    public function execute(array $params): int
    {
        // First configure/check our options
        $this->configureParams();

        return $this->generator->numberBetween($params['min'], $params['min']);
    }
}
