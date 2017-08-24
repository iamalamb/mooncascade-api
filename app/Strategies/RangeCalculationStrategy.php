<?php

namespace Mooncascade\Strategies;

use Faker\Generator;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class RangeCalculationStrategy
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
class RangeCalculationStrategy extends AbstractStrategy
{
    /**
     * Use an OptionsResolver in order to ensure the correct params
     * are passed.
     *
     * @param array $params
     */
    public function configureParams(array $params)
    {
        $required = [
            'min',
            'max',
        ];

        // Set the required values
        $this->optionsResolver->setRequired($required);

        // Set the allowed types
        $this->optionsResolver->setAllowedTypes('min', ['integer', 'double']);
        $this->optionsResolver->setAllowedTypes('max', ['integer', 'double']);

        $this->optionsResolver->resolve($params);
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
        parent::execute($params);

        return $this->generator->numberBetween($params['min'], $params['max']);
    }
}
